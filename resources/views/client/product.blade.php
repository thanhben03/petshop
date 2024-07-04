@extends('layout.client.master')
@section('content')
    <main>
        <input type="text" hidden id="idProduct" data-id="{{$idProduct}}">
        <input hidden type="text" id="isLogin"
            @if (session()->has('level')) value="1"
        @else
            value="0" @endif>
        <article>
            <section class="section section-info-product product-deltail">
                <img src="{{ asset('storage') . '/' . $product->image }}" alt="" class="product-info__img">
                <div class="product-info__right">
                    <div class="product-info__rate">
                        <div class="product-info__star">
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                        <div class="product-info__text">
                            No reviews
                        </div>

                    </div>

                    <div class="product-info__intro">
                        <h2 class="product-info__intro-title">{{ $product->name }}</h2>
                        <h4 class="product-info__intro-price">{{ $product->currency }}đ</h4>
                    </div>

                    <div class="product-info__descript">
                        <p class="product-info__descript-text">
                            {{ $product->desc }}
                        </p>
                    </div>

                    <div class="product-info__action">
                        <form id="form-add-cart">
                            <button type="submit" class="product-info__add">ADD TO CART</button>
                            {{-- <div class="product-info__quantity">
                                <span class="product-info__quantity-number">1</span>
                                <div class="product-info__volume">
                                    <i class="fa-solid fa-caret-up increase"></i>
                                    <i class="fa-solid fa-caret-down decrease"></i>
                                </div>
                            </div> --}}
                        </form>
                    </div>

                    <div class="product-info__wishlist">
                        <div class="btn-wishlist">
                            <i class="fa-regular fa-heart"></i>
                            <span>ADD TO WISHLIST</span>
                        </div>
                    </div>

                    <ul class="product-info__list">
                        <li class="product-info__item">
                            <div class="product-info__item-product">
                                <span>Categories :</span>
                                <a href="" class="product-info__item-link">Best Selling</a>
                                <a href="" class="product-info__item-link">Home page</a>
                            </div>
                        </li>
                        <li class="product-info__item">
                            <div class="product-info__item-social">
                                <span>SHARE :</span>
                                <div class="product-info__item-social-icon">
                                    <a href="" class="product-info__item-link"><i
                                            class="fa-brands fa-twitter"></i></a>
                                    <a href="" class="product-info__item-link"><i
                                            class="fa-brands fa-facebook-f"></i></a>
                                    <a href="" class="product-info__item-link"><i
                                            class="fa-brands fa-pinterest-p"></i></a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>
            <h1 class="section-latest__title">Latest products</h1>
            <section class="section section-latest-products ">
                @foreach ($latest_product as $item)
                    <a href="{{ route('view-product', $item) }}" class="product-latest-item">
                        <div class="">
                            <img src="{{ asset('storage') . '/' . $item->image }}" class="product-item-latest__img"
                                alt="">
                            <div class="product-info-latest">
                                <h3 class="product-name-latest">{{ $item->name }}</h3>
                                <h4 class="product-price-latest">{{ $item->currency }}đ</h4>
                            </div>
                        </div>
                    </a>
                @endforeach

            </section>
        </article>
    </main>
@endsection
@push('js')
    <script>
        $("#form-add-cart").submit(function(e) {

            e.preventDefault();
            let isLogin = Boolean(Number($("#isLogin").val()));
            console.log(isLogin);
            if (!isLogin) {
                toastr.error('Vui lòng đăng nhập để thêm sản phẩm')
                setTimeout(() => {
                    window.location.href = "/login";
                }, 1500);
                return;
            }
            $.ajax({
                headers: {
                    "Access-Control-Allow-Origin": "*"
                },
                type: "POST",
                url: "{{ route('product.api.add') }}",
                data: {
                    id: {{ $product->id }},
                    _token: "{{ csrf_token() }}"
                },
                dataType: "json",
                success: function(response) {
                    showNoti()
                    if (response.status == 'success') {
                        toastr.success(response.msg, 'success!')
                    }
                }
            });
        });
        $(".btn-wishlist").on('click', function () {
            $.ajax({
                type: "GET",
                url: "/product/wishlist/"+ $("#idProduct").data('id'),
                data: "data",
                dataType: "dataType",
                success: function (response) {
                    
                }
            });
        })
    </script>
@endpush
