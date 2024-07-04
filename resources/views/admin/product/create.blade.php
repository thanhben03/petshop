@extends('layout.admin.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <h3 class="page-title">Edit</h3>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="alert alert-danger" style="display: none">
                <ul class="error-create-product">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        {{-- @endif --}}
        <div class="card-body">
            <form action="{{ route('product.store') }}" method="POST" id="form-create-product"
                enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Name</label>
                    <input type="text" class="form-control" id="" value="" name="name">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Description</label>
                    <input type="text" class="form-control" id="" value="" name="desc">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Image</label>
                    <input type="file" class="form-control" id="" value="" name="image">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Category</label>

                    <select name="category_id" id="">
                        @foreach ($category as $item)
                            <option @if ($loop->first) selected @endif value="{{ $item->id }}">
                                {{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Inventory</label>
                    {{-- <input type="text" class="form-control" data-inventory_i>id }} id=""
                        value>quantity }}" name="inventory_id"> --}}
                    <select name="inventory_id" id="">
                        @foreach ($inventory as $item)
                            <option @if ($loop->first) selected @endif value="{{ $item->id }}">
                                {{ $item->quantity }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Discount</label>
                    <select name="discount_id" id="">
                        @foreach ($discount as $item)
                            <option @if ($loop->first) selected @endif value="{{ $item->id }}">
                                {{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Price</label>
                    <input type="text" class="form-control" id="" value="" name="price">
                </div>
                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $("#form-create-product").submit(function(e) {
            e.preventDefault();
            // let formData = new FormData($(this));
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: new FormData(this),
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.status == 'success') {
                        toastr.success(res.msg, 'success!');
                        window.location.reload()
                    }
                },
                error: function(res) {
                    let arrErr = Object.entries(res.responseJSON.errors);
                    let html = '';
                    arrErr.forEach(err => {
                        html += `<li>${err[1][0]}</li>`;
                    });
                    $(".error-create-product").html(html);
                    $(".error-create-product").parent()[0].style.display = 'block';
                    console.log(res);
                    toastr.error('Đã xảy ra lỗi!', 'error!')
                }
            });
        })
    </script>
@endpush
