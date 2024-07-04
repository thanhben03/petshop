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
            <form action="{{ route('order.update', $data) }}" method="POST" id="form-edit-order">
                {{-- @csrf --}}
                @method('PUT')
                {{-- <input type="text" name="_token" value="@csrf" hidden> --}}
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Trạng thái</label>
                    <select name="status" id="">
                        <option @if ($data->status == 0) selected @endif value="0">
                            Chờ duyệt</option>
                        <option @if ($data->status == 1) selected @endif value="1">
                            Đã duyệt</option>

                    </select>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Tổng tiền</label>
                    <input type="text" class="form-control" id="" value="{{ $data->total }}" name="total">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Số lượng</label>
                    <input type="text" class="form-control" id="" value="{{ $data->quantity }}" name="quantity">
                    {{-- <img style="width: 100px" src="{{ asset('storage').'/'.$data->image }}" alt=""> --}}
                </div>
                {{-- <div class="mb-3">
                    <label for="" class="form-label">Image</label>
                    <input type="file" class="form-control" id="" name="image">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Total</label>
                    <input type="text" class="form-control" id=""
                        value="{{ $data->inventory->quantity }}" name="total">
                    
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Quantity</label>
                    <input type="text" class="form-control" id="" value="{{ $data->price }}" name="quantity">
                    
                </div> --}}

                <button class="btn btn-primary">Chỉnh sửa</button>
            </form>

        </div>
    </div>
@endsection
@push('js')
    <script>
        $("#form-edit-order").submit(function(e) {
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
                        // setTimeout(() => {
                        //     window.location.reload()

                        // }, 1200);
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
