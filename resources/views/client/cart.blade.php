{{-- {{ dd($carts->products) }} --}}

@extends('layout.client.master')
@section('content')
    <div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xác nhận địa chỉ thanh toán</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="fullname" class="col-form-label">Full Name:</label>
                            <input type="text" class="form-control" value="{{ $address_payment->fullname ?? '' }}"
                                name="fullname" id="fullname">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Address:</label>
                            <input type="text" value="{{ $address_payment->address ?? '' }}" class="form-control"
                                placeholder="Ex: An Thạnh Trung, Chợ Mới, An Giang" name="address" id="address">

                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Phone Number:</label>
                            <input type="text" value="{{ $address_payment->phone ?? '' }}" class="form-control"
                                name="phone" id="phone">

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="save-address" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
    <main>
        <article class="wrap-cart">
            <section class="section section-cart">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="{{ route('cart') }}" class="btn btn-secondary">Giỏ Hàng</a>
                    <a href="{{ route('purchased') }}" class="btn btn-secondary ml-2">Lịch sử mua hàng</a>
                </div>
                <table class="section-cart__wrap cart-d">
                    <thead>
                        <tr>
                            <th colspan="2">PRODUCT NAME</th>
                            <th>PRICE</th>
                            <th>QUANTITY</th>
                            <th>TOTAL</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="contain-cart">
                        @if (session()->has('cart'))
                            @foreach ($carts->products as $item)
                                <tr>
                                    <td colspan="2" id="test">
                                        <div class="cart">
                                            <img src="{{ asset('storage/' . $item['product_info']->image) }}" alt=""
                                                class="cart-info__img">
                                            <h3 class="cart-info__name">{{ $item['product_info']->name }}</h3>

                                        </div>
                                    </td>
                                    <td class="cart-line-2">
                                        <p class="cart-price-label mgl-8">Price: </p>
                                        <span
                                            class="cart-price-value">{{ number_format($item['product_info']->price) }}đ</span>
                                        <div class="product-info__quantity product-info__quantity-m">
                                            <span
                                                class="product-info__quantity-number number-13">{{ $item['quantity'] }}</span>
                                            <div class="product-info__volume">
                                                <i id="13" class="fa-solid fa-caret-up increase increase-up-13"></i>
                                                <i id="13"
                                                    class="fa-solid fa-caret-down decrease decrease-down-13"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="product-info__quantity">
                                            <span
                                                class="product-info__quantity-number number-13">{{ $item['quantity'] }}</span>
                                            <div class="product-info__volume">
                                                <i data-id="{{ $item['product_info']->id }}"
                                                    class="fa-solid fa-caret-up increase increase-up-13"></i>
                                                <i data-id="{{ $item['product_info']->id }}"
                                                    class="fa-solid fa-caret-down decrease decrease-down-13"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart-total-wrap">
                                        <p class="cart-price-label mgl-8">Total: {{ number_format($item['price']) }}đ</p>
                                        <span class="cart-total-m"></span>
                                        <i id="13" class="fa-solid fa-trash btnDelete btnDelete-m"></i>
                                    </td>
                                    <td class="btnDelete" onclick="deleteCart({{ $item['product_info']->id }})"
                                        data-id="13">
                                        <i class="fa-solid fa-trash"></i>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td>Chưa có sản phẩm</td>
                        @endif
                    </tbody>
                </table>
            </section>
            @if (session()->has('cart'))
                <section class="section section-total">
                    <form action="{{ route('payment.pay') }}" method="post" id="form-submit-payment">
                        @csrf
                        <div class="section-total-wrap">
                            <!-- <h2>CART TOTAL</h2> -->
                            <div class="section-total__middle">
                                <h3 class="section-total__label">Total</h3>
                                <hr>
                                <input hidden name="totalPrice" id="totalPrice-input" value="{{$carts->totalPrice}}">
                                
                                <h3 class="section-total__amount">{{ number_format($carts->totalPrice) }}đ</h3>
                            </div>
                            <div class="button-payment">
                                <button type="button" class="confirmAddress" data-toggle="modal"
                                    data-target=".bd-example-modal-lg">Chọn địa chỉ thanh toán</button>

                                <button class="paymentBtn">Thanh Toán</button>
                            </div>
                        </div>
                    </form>
                </section>
            @endif
        </article>
    </main>
@endsection
@push('js')
    <script>
        $(".confirmAddress").on('click', function() {
            $("#myModal").modal('show');
        })

        function deleteCart(idProduct) {
            $.ajax({
                type: "GET",
                url: "/product/delete/" + idProduct,
                // data: {},
                // contentType: false,
                // processData: false,
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if (response.status == 'success') {
                        toastr.success(response.msg, 'success!')
                        setTimeout(() => {
                            window.location.reload();
                        }, 1300);
                    }
                }
            });
        }

        $(".product-info__volume").on('click', '.increase', function() {
            let idProduct = $(this).data('id');
            $.ajax({
                type: "GET",
                url: "/product/update/" + idProduct + "/up",
                // data: "data",
                dataType: "json",
                success: function(response) {
                    if (response.status == 'success') {
                        toastr.success(response.msg, 'success!')
                        setTimeout(() => {
                            window.location.reload();

                        }, 1300);
                    }
                }
            });
        })

        $(".product-info__volume").on('click', '.decrease', function() {
            let idProduct = $(this).data('id');
            $.ajax({
                type: "GET",
                url: "/product/update/" + idProduct + "/down",
                // data: "data",
                dataType: "json",
                success: function(response) {
                    if (response.status == 'success') {
                        toastr.success(response.msg, 'success!')
                        setTimeout(() => {
                            window.location.reload();

                        }, 1300);
                    }
                }
            });
        })

        $(".paymentBtn").on('click', function(e) {
            e.preventDefault();
            let isAddress = checkExistAddress().responseJSON.status;
            if (!isAddress) {
                toastr.error('Vui lòng cập nhật địa chỉ trước khi thanh toán !')
                return;
            }
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Buy it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // $("#form-submit-payment").append($("#totalPrice-input").val());
                    $("#form-submit-payment").submit();
                    // $.ajax({
                    //     type: "GET",
                    //     url: "/cart/confirm_cart/",
                    //     dataType: "json",
                    //     success: function(response) {
                    //         if (response.status == 'success') {
                    //             toastr.success(response.msg, 'success!')
                    //             setTimeout(() => {
                    //                 window.location.reload();

                    //             }, 1300);
                    //         } else {
                    //             toastr.error(response.msg, 'error!')

                    //         }
                    //     }
                    // });
                }
            })
        })

        $("#save-address").on('click', function() {
            
            $.ajax({
                type: "POST",
                url: "{{ route('addAddress') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    fullname: $("#fullname").val(),
                    phone: $("#phone").val(),
                    address: $("#address").val(),
                },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if (response.status == 'success') {
                        toastr.success(response.msg, 'success!');
                    }
                }
            });
        })

        function checkExistAddress() {
            console.log('2');
            return $.ajax({
                type: "POST",
                url: "{{ route('checkExistAddress') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                async:false,
                dataType: "json",
                // success: function (response) {
                    
                // }
            });
        }
    </script>
@endpush
