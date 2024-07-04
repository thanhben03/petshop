@extends('layout.admin.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <h3 class="page-title">Danh sách sản phẩm</h3>
            {{-- <a href="{{ route('product.create') }}" class="btn btn-primary m-1">Thêm mới</a> --}}
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped" id="table-order-index">
                <thead>
                    <tr>
                        {{-- <th>#</th> --}}
                        <th>HỌ TÊN</th>
                        <th>TÊN SP</th>
                        <th>ĐƠN GIÁ</th>
                        <th>SỐ LƯỢNG</th>
                        <th>TỔNG TIỀN</th>
                        <th>SỐ LƯỢNG</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            let table = $('#table-order-index').DataTable({
                dom: 'Blrtip',
                // select: true,
                processing: true,
                serverSide: true,
                ajax: '{!! route('order.api') !!}',
                // columnDefs: [{
                //     className: "not-export",
                //     "targets": [3]
                // }],
                columns: [{
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'total',
                        name: 'total'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },

                    {
                        data: 'edit',
                        targets: 6,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return `<a class="btn btn-primary" href="${data}">
                            Edit
                        </a>`;
                        }
                    },
                    {
                        data: 'destroy',
                        targets: 7,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return `<form action="${data}" method="post" id="form-delete-order">
                                @csrf
                                @method('DELETE')
                                <button type='submit' class="btn-delete btn btn-danger">Delete</button>
                            </form>`;
                        }
                    },

                ]
            });
            console.log(table.data);
            $("#form-delete-order").submit(function(e) {
                e.preventDefault();
                console.log('123');
            });
        });
    </script>
@endpush
