@extends('layout.client.master')
@section('content')
    <main>
        <article>
            {{-- @if (session()->has('level'))
                <h1>{{ session()->get('fullname') }}</h1>
            @endif --}}
            {{-- @if ($user)
                <h1>{{ $user['username'] }}</h1>
            @endif --}}
            <section class="section banner">
                <img class="banner-img" src="https://cdn.shopify.com/s/files/1/0324/2334/6235/files/slide1.3.jpg?v=1613757500"
                    alt="">
                <div class="banner-content">
                    <div class="banner-wrap">
                        <h1 class="banner__title">Famipet Shop</h1>
                        <h3 class="banner__subtitle">Everything For Pets</h2>
                    </div>
                    <button class="banner__button">Shop Now</button>
                </div>
            </section>

            <section class="section product" id="products">
                <h1 class="heading-section product__title">New Arrivals</h1>
                <div class="product-list">
                    @foreach ($products as $item)
                        <a href="{{ route('view-product', $item) }}" id="item-1" class="product-item">
                            <img src="{{ asset('storage'.'/'.$item->image) }}" class="product-item__img" alt="">
                            <div class="product-item__info">
                                <h3 class="product-name">{{ $item->name }}</h3>
                                <h4 class="product-price">{{ $item->currency }}đ</h4>
                            </div>
                        </a>
                    @endforeach
                    
                </div>
                {{-- <ul class="pagination">
                    <li class="pagination-item"><a href="">Pre</a></li>
                    <li class="pagination-item"><a href="">1</a></li>
                    <li class="pagination-item"><a href="">2</a></li>
                    <li class="pagination-item"><a href="">3</a></li>
                    <li class="pagination-item"><a href="">Next</a></li>
                </ul> --}}
                {{ $products->links() }}
            </section>

            <section class="section promotion">
                <img src="{{ asset('images/promotion/img_countdown.png') }}" alt="" class="promotion__img">
                <div class="promotion-content">
                    <h1 class="promotion-content__title">Keep Your Pets Pleasure</h1>
                    <div class="promotion-content-discount">
                        <h3 class="promotion-content-discount__nosale">$34.90</h3>
                        <h3 class="promotion-content-discount__sale">$33.90</h3>
                    </div>
                    <div class="promotion-content__label">
                        <span>With the dogs on a mission to create a serum that would eliminate the canine allergies
                            among the humans, their feline foes are on their paws hatching plans to obstruct the top
                            secret canine project.</span>
                    </div>
                    <div class="promotion-countdown">
                        <ul class="promotion-countdown__list">
                            <li class="promotion-countdown__item">
                                <p class="promotion-countdown__label promotion-countdown__day-number">46</p>
                                <p class="promotion-countdown__day-text">DAY</p>
                            </li>
                            <li class="promotion-countdown__item">
                                <p class="promotion-countdown__label promotion-countdown__hour-number">13</p>
                                <p class="promotion-countdown__hour-text">HOURS</p>
                            </li>
                            <li class="promotion-countdown__item">
                                <p class="promotion-countdown__label promotion-countdown__min-number">51</p>
                                <p class="promotion-countdown__min-text">MINS</p>
                            </li>
                            <li class="promotion-countdown__item">
                                <p class="promotion-countdown__label promotion-countdown__sec-number">51</p>
                                <p class="promotion-countdown__sec-text">SECS</p>
                            </li>
                            <!-- <li class="promotion-countdown__item"></li> -->
                        </ul>
                    </div>
                    <button class="promotion-content__button"><a href="#products">SHOP NOW</a></button>
                </div>
            </section>

            <section class="section get-update">
                <div class="get-update-container">
                    <h1>GET UPDATE</h1>
                    <h4>Subscribe our newsletter and get discount 30% off</h4>
                    <div class="get-update__box">
                        <input placeholder="Enter your email" type="text" class="get-update__input">
                        <button>SIGN UP</button>
                    </div>
                </div>
            </section>
            <section class="section social-shop">
                <h1 class="heading-section">Instagram Shop</h1>
                <h4>@Family pet</h4>
                <div class="social-shop__img-wrap">
                    <img src="{{ asset('images/social/1.png') }}" alt="" class="social-shop__img-item">
                    <img src="{{ asset('images/social/2.png') }}" alt="" class="social-shop__img-item">
                    <img src="{{ asset('images/social/3.png') }}" alt="" class="social-shop__img-item">
                    <img src="{{ asset('images/social/4.png') }}" alt="" class="social-shop__img-item">
                </div>
            </section>
        </article>
    </main>
@endsection
