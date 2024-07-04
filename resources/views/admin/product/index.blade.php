@extends('layout.admin.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <h3 class="page-title">Danh sách sản phẩm</h3>
            <a href="{{ route('product.create') }}" class="btn btn-primary m-1">Thêm mới</a>
        </div>
    </div>
    <div class="card">
        {{-- <div class="cart-title">
            <input type="text" name="" id="select-product">
        </div> --}}
        <div class="card-body">
            <table class="table table-striped" id="table-product-index">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Total</th>
                        <th>Discount</th>
                        <th>Price</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th class="select-search">Name</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Total</th>
                        <th>Discount</th>
                        <th>Price</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#table-product-index tfoot .select-search').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" class="form-control" id="search-name" placeholder="Search ' + title + '" />');
            });
            let table = $('#table-product-index').DataTable({
                dom: 'Blrtip',
                select: true,
                processing: true,
                serverSide: true,
                initComplete: function() {
                    // Apply the search
                    this.api()
                        .columns()
                        .every(function() {
                            var that = this;

                            $('input', this.footer()).on('keyup change clear', function() {
                                if (that.search() !== this.value) {
                                    that.search(this.value).draw();
                                }
                            });
                        });
                },
                ajax: '{!! route('product.api') !!}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'desc',
                        name: 'description'
                    },
                    {
                        data: 'category_name',
                        name: 'category'
                    },
                    {
                        data: 'inventory_quantity',
                        name: 'total'
                    },
                    {
                        data: 'discount',
                        name: 'discount'
                    },

                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'edit',
                        targets: 7,
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
                        targets: 8,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return `<form action="${data}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type='button' class="btn-delete btn btn-danger">Delete</button>
                            </form>`;
                        }
                    },

                ]
            });
            // $("#search-name").on('keyup', function() {
            //     table.column(1).search(this.value).draw();

            // })
            $(document).on('click', '.btn-delete', function() {
                let check = confirm('Bạn có chắc chắn muốn xóa !');
                if (!check) {
                    return;
                }
                let form = $(this).parents('form');
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    dataType: 'json',
                    data: form.serialize(),
                    success: function(res) {
                        table.draw();
                        toastr.success(res.msg, 'success!');
                    },
                    error: function(res) {
                        toastr.error(res.msg, 'error!');
                    }
                });
            });
        });
    </script>
@endpush
