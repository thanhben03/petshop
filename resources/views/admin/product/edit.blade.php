@extends('layout.admin.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <h3 class="page-title">Edit</h3>
        </div>
    </div>
    <div class="card">
        @if ($errors->any())
            <div class="card-header">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <div class="card-body">
            <form action="{{ route('product.update', $data) }}" method="POST" id="form-edit-product" enctype="multipart/form-data">
                {{-- @csrf --}}
                @method('PUT')
                {{-- <input type="text" name="_token" value="@csrf" hidden> --}}
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Name</label>
                    <input type="text" class="form-control" id="" value="{{ $data->name }}" name="name">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Description</label>
                    <input type="text" class="form-control" id="" value="{{ $data->desc }}" name="desc">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Image</label>
                    <input type="file" class="form-control" id="" name="image">
                    <img style="width: 100px" src="{{ asset('storage').'/'.$data->image }}" alt="">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Category</label>
                    <select name="category_id" id="">
                        @foreach ($category as $item)
                            @if ($item->id == $data->category->id)
                                <option selected value="{{ $item->id }}">{{ $item->name }}</option>
                            @else
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Inventory</label>
                    {{-- <input type="text" class="form-control" data-inventory_id={{ $data->inventory->id }} id=""
                        value="{{ $data->inventory->quantity }}" name="inventory_id"> --}}
                    <select name="inventory_id" id="">
                        @foreach ($inventory as $item)
                            @if ($item->id == $data->inventory->id)
                                <option selected value="{{ $item->id }}">{{ $item->quantity }}</option>
                            @else
                                <option value="{{ $item->id }}">{{ $item->quantity }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Discount</label>
                    <select name="discount_id" id="">
                        @foreach ($discount as $item)
                            @if ($item->id == $data->discount->id)
                                <option selected value="{{ $item->id }}">{{ $item->name }}</option>
                            @else
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Price</label>
                    <input type="text" class="form-control" id="" value="{{ $data->price }}" name="price">
                </div>
                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $("#form-edit-product").submit(function(e) {
            e.preventDefault();
            toastr.options = {
                "progressBar": true
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // console.log($("#form-edit-product").serialize()); return;
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: new FormData(this),
                dataType: "json",
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status == 'success') {
                        toastr.success(response.msg, 'Success!')
                        window.location.reload()
                    }
                },
                error: function() {
                    console.log('2');
                    toastr.error('Chỉnh sửa thất bại !', 'Error!')
                }
            });
        });
    </script>
@endpush
