<!--
Thành viên thực hiện:
- La Vĩnh Hòa
- Trương Hoàng Duy
- Nguyễn Hồ Thanh Bền
 -->
<!DOCTYPE html>
<html lang="vi">
{{-- {{ dd(session()->get('cart')) }} --}}

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/3028/3028549.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css"
        href="http://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    <!-- <link rel="stylesheet" href="assets/css/fa6/all.min.css"> -->
    <title>Trang Chủ - Shop Pet</title>
</head>

<body>
    <div class="menu-mobile">
        <div class="menu-mobile__content">
            <div class="menu-mobile__head">
                <div class="menu-mobile__head-item menu-mobile__l">
                    <i class="fa-solid fa-list"></i>
                    <span>MENU</span>
                </div>
                <div class="menu-mobile__head-item menu-mobile__r">
                    <i class="fa-regular fa-user"></i>
                    <span><a href="login.html">LOGIN</a></span>

                </div>
                <div class="close-modal">
                    <i class="fa-solid fa-x"></i>
                </div>
            </div>
            <div class="menu-mobile__body">
                <ul class="menu-mobile__list">
                    <li class="menu-mobile__item">HOME <i class="fa-solid fa-angle-right"></i></li>
                    <li class="menu-mobile__item">SHOP <i class="fa-solid fa-angle-right"></i></li>
                    <li class="menu-mobile__item item-featured">
                        FEATURED <i class="fa-solid fa-angle-right"></i>
                        <div class="dropmenu-m">
                            <div class="menu-item">
                                <h5 class="menu-item__title">BLOG LAYOUTS</h5>
                                <div class="separate"></div>
                                <ul class="menu-item__list">
                                    <li class="menu-item__link">
                                        <a href="" class="menu-item__link-item">Blog Standar Sidebar Left</a>
                                    </li>
                                    <li class="menu-item__link">
                                        <a href="" class="menu-item__link-item">Blog Standar Sidebar Right</a>
                                    </li>
                                    <li class="menu-item__link">
                                        <a href="" class="menu-item__link-item">Blog Grid Sidebar LeftNEW</a>
                                    </li>
                                    <li class="menu-item__link">
                                        <a href="" class="menu-item__link-item">Blog Grid No SidebarNEW</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="menu-item">
                                <h5 class="menu-item__title">PRODUCT LAYOUTS</h5>
                                <div class="separate"></div>
                                <ul class="menu-item__list">
                                    <li class="menu-item__link">
                                        <a href="" class="menu-item__link-item">Product Large ImagesNEW</a>
                                    </li>
                                    <li class="menu-item__link">
                                        <a href="" class="menu-item__link-item">Product Extended</a>
                                    </li>
                                    <li class="menu-item__link">
                                        <a href="" class="menu-item__link-item">Product Gallery</a>
                                    </li>
                                    <li class="menu-item__link">
                                        <a href="" class="menu-item__link-item">Product StickyHOT</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="menu-item">
                                <h5 class="menu-item__title">PRODUCT TYPES</h5>
                                <div class="separate"></div>
                                <ul class="menu-item__list">
                                    <li class="menu-item__link">
                                        <a href="" class="menu-item__link-item">Variable</a>
                                    </li>
                                    <li class="menu-item__link">
                                        <a href="" class="menu-item__link-item">Video</a>
                                    </li>
                                    <li class="menu-item__link">
                                        <a href="" class="menu-item__link-item">Affiliate</a>
                                    </li>
                                    <li class="menu-item__link">
                                        <a href="" class="menu-item__link-item">Simple</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="arrow-up"></div>
                        </div>
                    </li>
                    <li class="menu-mobile__item">PAGES <i class="fa-solid fa-angle-right"></i></li>
                    <li class="menu-mobile__item">ELEMENT </li>
                </ul>
            </div>
            <!-- <div class="menu-mobile__footer">
                 
                 <span>CLOSE</span>
             </div> -->
        </div>
    </div>
    <header class="header">

        <div class="rp-navbar">
            <i class="rp-navbar__icon fa-solid fa-bars"></i>
        </div>
        <div class="header-logo">
            <a class="header-logo__link" href="/">
                <img class="header-logo__image"
                    src="https://cdn.shopify.com/s/files/1/0324/2334/6235/files/logo.png?v=1613757546" alt="">
            </a>
        </div>
        <nav class="nav">
            <ul class="nav-list-center">
                <li class="nav-item"><a href="/">Home</a></li>
                <li class="nav-item">Shop</li>
                <li class="nav-item item-hover">
                    <div class="nav-item__notify cl-red">
                        <span class="nav-item__notify--hot">HOT</span>
                    </div>
                    Featured
                    <div class="dropmenu">
                        <div class="menu-item">
                            <h5 class="menu-item__title">BLOG LAYOUTS</h5>
                            <div class="separate"></div>
                            <ul class="menu-item__list">
                                <li class="menu-item__link">
                                    <a href="" class="menu-item__link-item">Blog Standar Sidebar Left</a>
                                </li>
                                <li class="menu-item__link">
                                    <a href="" class="menu-item__link-item">Blog Standar Sidebar Right</a>
                                </li>
                                <li class="menu-item__link">
                                    <a href="" class="menu-item__link-item">Blog Grid Sidebar LeftNEW</a>
                                </li>
                                <li class="menu-item__link">
                                    <a href="" class="menu-item__link-item">Blog Grid No SidebarNEW</a>
                                </li>
                            </ul>
                        </div>
                        <div class="menu-item">
                            <h5 class="menu-item__title">PRODUCT LAYOUTS</h5>
                            <div class="separate"></div>
                            <ul class="menu-item__list">
                                <li class="menu-item__link">
                                    <a href="" class="menu-item__link-item">Product Large ImagesNEW</a>
                                </li>
                                <li class="menu-item__link">
                                    <a href="" class="menu-item__link-item">Product Extended</a>
                                </li>
                                <li class="menu-item__link">
                                    <a href="" class="menu-item__link-item">Product Gallery</a>
                                </li>
                                <li class="menu-item__link">
                                    <a href="" class="menu-item__link-item">Product StickyHOT</a>
                                </li>
                            </ul>
                        </div>
                        <div class="menu-item">
                            <h5 class="menu-item__title">PRODUCT TYPES</h5>
                            <div class="separate"></div>
                            <ul class="menu-item__list">
                                <li class="menu-item__link">
                                    <a href="" class="menu-item__link-item">Variable</a>
                                </li>
                                <li class="menu-item__link">
                                    <a href="" class="menu-item__link-item">Video</a>
                                </li>
                                <li class="menu-item__link">
                                    <a href="" class="menu-item__link-item">Affiliate</a>
                                </li>
                                <li class="menu-item__link">
                                    <a href="" class="menu-item__link-item">Simple</a>
                                </li>
                            </ul>
                        </div>
                        <div class="arrow-up"></div>
                    </div>
                </li>
                <li class="nav-item">
                    Page
                    <div class="nav-item__notify cl-blue">
                        <span class="nav-item__notify--new">NEW</span>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="header-right">
            <ul class="nav-list-right">
                <li class="nav-item nav-item-r">
                    <input placeholder="Search anything" type="search" name="search" class="search">
                    <i class="fa-solid btn-search fa-magnifying-glass"></i>
                </li>
                <li class="nav-item nav-item-r">
                    <a href="{{route('login')}}"><i class="fa-regular fa-user"></i></a>
                    @if (session()->has('level'))
                        <ul class="dropdown-menu-account">
                            <li><a href="{{ route('password') }}">Change Password</a></li>
                            <li><a href="{{ route('address') }}">Billing Address</a></li>
                            <li><a href="{{ route('wishlist') }}">WhistList</a></li>
                            <li><a href="{{ route('logout') }}">Logout</a></li>
                            <div class="arrow-up2"></div>

                        </ul>
                    @endif
                </li>
                <li class="nav-item nav-item-r">
                    <a href="{{ route('cart') }}"><i class="fa-solid fa-cart-shopping"></i></a>
                    <div class="total-cart">
                        <span class="total-cart__number">{{ session()->get('cart')->totalQuantity ?? 0 }}</span>
                    </div>
                </li>
                <li>
                    @if (session()->has('fullname'))
                        <p>Chào,<b>{{ session()->get('fullname') }}</b></p>
                    @endif
                </li>
            </ul>
        </div>
    </header>

    @yield('content')

    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h3 class="footer-section__title">HELP & INFOMATION</h3>
                <ul class="footer-section__list">
                    <li class="footer-section__item">Help</li>
                    <li class="footer-section__item">Track Order</li>
                    <li class="footer-section__item">Delivery & Returns</li>
                    <li class="footer-section__item">10% Member Discount</li>
                </ul>
            </div>
            <div class="footer-section">
                <h3 class="footer-section__title">ABOUT US</h3>
                <ul class="footer-section__list">
                    <li class="footer-section__item">Careers at Famipet</li>
                    <li class="footer-section__item">Corporate Responsibility</li>
                    <li class="footer-section__item">Investors Site</li>
                    <li class="footer-section__item">Contact Us</li>
                </ul>
            </div>
            <div class="footer-section">
                <h3 class="footer-section__title">CATEGORIES</h3>
                <ul class="footer-section__list">
                    <li class="footer-section__item">High-Quality Meat</li>
                    <li class="footer-section__item">Limited-Ingredient Diet</li>
                    <li class="footer-section__item">Care and Feeding</li>
                    <li class="footer-section__item">Commitment to Safety</li>
                </ul>
            </div>
            <div class="footer-section">
                <h3 class="footer-section__title">HELP & INFOMATION</h3>
                <p>News & updates from FamipetStore.
                    No spam, we promise.</p>
                <div class="footer-section__form">
                    <input type="text">
                    <button>SIGN UP</button>
                </div>
            </div>
        </div>

    </footer>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

    <script src="{{ asset('js/common.js') }}"></script>

    <script src="{{ asset('js/main.js') }}"></script>
    @stack('js')
</body>

</html>
