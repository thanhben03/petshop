@extends('layout.client.master')
@section('content')
    <main>
        <article class="wrap-cart">
            <section class="section section-cart">

                <table class="section-cart__wrap cart-d">
                    <thead>
                        <tr>
                            <th colspan="2">PRODUCT NAME</th>
                            <th>PRICE</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="contain-cart">
                        @foreach ($list as $item)
                            <tr>
                                <td colspan="2" id="test">
                                    <div class="cart">
                                        <img src="{{ asset('storage/' . $item->product->image) }}" alt=""
                                            class="cart-info__img">
                                        <h3 class="cart-info__name">
                                            <a href="{{ route('view-product',$item->product->id) }}">{{ $item->product->name }}</a>
                                        </h3>

                                    </div>
                                </td>
                                <td class="cart-line-2">
                                    <p class="cart-price-label mgl-8">Price: </p>
                                    <span class="cart-price-value">{{ number_format($item->product->price) }}đ</span>
                                    <div class="product-info__quantity product-info__quantity-m">
                                        <span class="product-info__quantity-number number-13">{{ $item['quantity'] }}</span>
                                        <div class="product-info__volume">
                                            <i id="13" class="fa-solid fa-caret-up increase increase-up-13"></i>
                                            <i id="13" class="fa-solid fa-caret-down decrease decrease-down-13"></i>
                                        </div>
                                    </div>
                                </td>
                                
                               
                                <td class="btnDelete" onclick="deleteCart({{ $item->product->id }})" data-id="13">
                                    <i class="fa-solid fa-trash"></i>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>

        </article>
    </main>
@endsection
@push('js')
@endpush
