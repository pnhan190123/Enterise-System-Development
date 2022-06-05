<?php

use Illuminate\Support\Facades\Auth;



?>

<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
    <base href="/public">
    <meta charset="utf-8" />
    {{-- Ngày Mới Express -  --}}
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>@yield('title') </title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="telephone=no" name="format-detection" />
    <meta name="HandheldFriendly" content="true" />
    <link rel="stylesheet" href="assets/css/master.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <!-- SWITCHER-->
    <link href="assets/plugins/switcher/css/switcher.css" rel="stylesheet" id="switcher-css" media="all" />
    <link href="assets/plugins/switcher/css/color1.css" rel="alternate stylesheet" title="color1" media="all" />
    <link href="assets/plugins/switcher/css/color2.css" rel="alternate stylesheet" title="color2" media="all" />
    <link href="assets/plugins/switcher/css/color3.css" rel="alternate stylesheet" title="color3" media="all" />
    <link href="assets/plugins/switcher/css/color4.css" rel="alternate stylesheet" title="color4" media="all" />
    <link href="assets/plugins/switcher/css/color5.css" rel="alternate stylesheet" title="color5" media="all" />
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <script>
        (function(H) {
            H.className = H.className.replace(/\bno-js\b/, 'js')
        })(document.documentElement)
    </script>
</head>

<body>
    <!-- Loader-->
    <div id="page-preloader"><span class="spinner"></span></div>
    <!-- Loader end-->
    <div data-header="sticky" data-header-top="200" class="layout-theme animated-css">
        <!-- Start Switcher-->
        <div class="switcher-wrapper">
            <div class="demo_changer">
                <div class="demo-icon color_primary"><i class="fa fa-cog fa-spin fa-2x"></i></div>
                <div class="form_holder">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="predefined_styles">
                                <div class="skin-theme-switcher">
                                    <h4>Color</h4><a href="javascript:void(0);" data-switchcolor="color1"
                                        style="background-color:#df0001;" class="styleswitch"></a><a
                                        href="javascript:void(0);" data-switchcolor="color2"
                                        style="background-color:#86a800;" class="styleswitch"></a><a
                                        href="javascript:void(0);" data-switchcolor="color3"
                                        style="background-color:#00adb4;" class="styleswitch"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end switcher-->
        <div class="cd-main">
            <div class="wrap-content cd-section cd-selected">
                <header class="header header_mod-a">
                    <div class="top-header">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="top-header__link bg-primary">
                                        <div class="top-header__wrap-link">
                                            <ul class="social-links list-inline">
                                                <li><a href="twitter.com" class="social-links__item_link"><i
                                                            class="icon fa fa-twitter"></i></a></li>
                                                <li><a href="facebook.com" class="social-links__item_link"><i
                                                            class="icon fa fa-facebook"></i></a></li>
                                                <li><a href="instagram.com" class="social-links__item_link"><i
                                                            class="icon fa fa-instagram"></i></a></li>
                                                <li><a href="linkedin.com" class="social-links__item_link"><i
                                                            class="icon fa fa-linkedin"></i></a></li>
                                                <li><a href="pinterest.com" class="social-links__item_link"><i
                                                            class="icon fa fa-pinterest-p"></i></a></li>
                                                <li><a href="youtube.com" class="social-links__item_link"><i
                                                            class="GET INFORMED - GET RELAXEDicon fa fa-youtube-play"></i></a></li>
                                                <li><a href="rss.com" class="social-links__item_link"><i
                                                            class="icon fa fa-rss"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="header-main__links">
                                        <ul class="header-links list-inline">
                                        <li class="header-links__item"><a href="{{ url('site/lienhe') }}"
                                        class="header-links__link">Liên Hệ</a></li>

                                    <?php 
                                        if(Auth::id() != null){?>
                                                    <li class="header-links__item"><a href="/deposit"
                                                    class="header-links__link">Nạp tiền</a></li>
                                                    <li class="header-links__item"><a href="/quangcao"
                                                    class="header-links__link">Quảng Cáo</a></li>
                                                    @foreach($money as $value)
                                                    <li class="header-links__item"><a href="{{ url('site/') }}"
                                                    class="header-links__link">Số dư: {{$value->sodu}} $ </a></li>

                                                    @endforeach

                                      <?php  }else{?>
                                            <li class="header-links__item"><a href="/login"
                                                        class="header-links__link">Nạp tiền</a></li>
                                                        <li class="header-links__item"><a href="/login"
                                                        class="header-links__link">Quảng Cáo</a></li>
                                                        @foreach($money as $value)
                                                        <li class="header-links__item"><a href="{{ url('site/') }}"
                                                        class="header-links__link">Số dư: {{$value->sodu}} $ </a></li>

                                                        @endforeach
                                                
                                      <?php }
                                    
                                    
                                    
                                    ?>        
                                        @csrf
                                    
                                                

                                            @auth
                                             {{-- The user is login... --}}
                                             @php
                                                 $iduser = Auth::user()->idUser;
                                             @endphp
                                            <li class="header-link1s__item"><a href="{{ url('site/profile/user/' . $iduser) }}" class="header-links__link">{{ Auth::user()->hoten }}</a></li>
                                            <li class="header-link1s__item"><a href="/logout" class="header-links__link">Đăng xuất</a></li>
                                            @endauth

                                            @guest
                                             {{-- The user is not login... --}}
                                            <li class="header-links__item"><a href="/login" class="header-links__link">Đăng nhập</a></li>
                                            <li class="header-links__item"><a href="/register" class="header-links__link">Đăng ký</a></li>
                                            @endguest

                                        </ul><a href="#fakelink" class="search-open"><i
                                                class="icon pe-7s-search"></i></a><a href="#cd-nav"
                                            class="trigger cd-nav-trigger"><i class="icon pe-7s-menu"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="header-main">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4"><a href="/site" class="logo"><img style="width: 150px !important;"
                                            src="http://localhost:8080/php3/nhan/storage/app/public/photos/41/logo.png" alt="Logo"
                                            class="logo__img img-responsive" />
                                        <div class="logo__slogan">Nhanh chóng - Xác thực</div>
                                    </a></div>
                                <div class="col-md-8"><a href="/site" class="banner pull-right"><img style="height: 114px;object-fit: cover;"
                                            src="http://localhost:8080/php3/nhan/storage/app/public/photos/41/bannerheader.jpg" alt="foto"
                                            class="img-responsive" /></a></div>
                            </div>
                        </div>
                    </div>
                </header>
                @if (isset($isHome))
                    @include('site.nav')
                @else
                    @include('site.navseccond')
                @endif

                @if (session()->has('mess') && session()->has('mess') != '')
                    @php
                        $mess = session('mess');
                    @endphp
                    <div class="text-center" style="margin-top: 50px;">
                        <h3>{{ $mess }}</h3>
                    </div>
                    @php
                        session(['mess' => '']);
                    @endphp
                @endif

                @yield('main')

                {{-- <div class="container">
            <div class="row">
              <div class="col-xs-12">
                <section class="section-soc-slider wow">
                  <div class="wrap-title-bg wrap-title-bg_mod-a">
                    <h2 class="ui-title-bg">instagram images<span class="ui-title-bg__subtitle">follow us @ instagram</span></h2>
                  </div>
                  <div data-min480="1" data-min768="5" data-min992="5" data-min1200="5" data-pagination="false" data-navigation="true" data-auto-play="4000" data-stop-on-hover="true" class="owl-carousel owl-theme enable-owl-carousel"><a href="assets/media/content/social-slider/1.jpg" class="prettyPhoto"><img src="assets/media/content/social-slider/1.jpg" alt="foto" class="img-responsive"></a><a href="assets/media/content/social-slider/2.jpg" class="prettyPhoto"><img src="assets/media/content/social-slider/2.jpg" alt="foto" class="img-responsive"></a><a href="assets/media/content/social-slider/3.jpg" class="prettyPhoto"><img src="assets/media/content/social-slider/3.jpg" alt="foto" class="img-responsive"></a><a href="assets/media/content/social-slider/4.jpg" class="prettyPhoto"><img src="assets/media/content/social-slider/4.jpg" alt="foto" class="img-responsive"></a><a href="assets/media/content/social-slider/5.jpg" class="prettyPhoto"><img src="assets/media/content/social-slider/5.jpg" alt="foto" class="img-responsive"></a></div>
                </section>
              </div>
            </div>
          </div> --}}
                <footer class="footer">
                    <div class="container" style="margin-bottom: 70px;">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="footer__first-section"><a href="/site" class="footer__logo"><img style="width: 200px !important;"
                                            src="http://localhost:8080/php3/nhan/storage/app/public/photos/41/logofoot.png" alt="logo"
                                            class="img-responsive"></a>
                                    <div class="footer__info"><b>Báo tiếng Việt nhiều người xem nhất</b><br>
                                        Thuộc Bộ Khoa học Công nghệ
                                        Số giấy phép: 06/GP-BTTTT ngày 03/01/2014</div>
                                    <div class="decor-right decor-right_sm"></div>
                                    <div class="footer-contacts">
                                        <div class="footer-contacts__item"><i class="icon fa fa-location-arrow"></i>Tầng
                                            5, Tòa nhà FPT, 17 phố Duy Tân, Cầu Giấy, Hà Nội</div>
                                        <div class="footer-contacts__item"><i class="icon fa fa-phone"></i>0965.266.666
                                            / 0989.899.999</div>
                                        <div class="footer-contacts__item"><i
                                                class="icon fa fa-envelope"></i>ngaymoi.express@gmail.com</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="clearfix">
                                    <div class="footer-wrap-section">
                                        <section class="footer-section">
                                            <h3 class="footer__title ui-title-inner">Liên Hệ</h3>
                                            <div class="decor-right decor-right_sm bg-3"></div>
                                            <ul class="footer-list list list-mark-2">
                                                <li><a href="/site/lienhe">Liên hệ cho chúng tôi</a></li>
                                                <li><a href="/">Tải ứng dụng</a></li>
                                                <li><a href="/">Mạng Xã Hội</a></li>
                                                <li><a href="/">Đăng ký nhận thông tin</a></li>
                                                <li><a href="/">Truyền thông đại chúng</a></li>
                                            </ul>
                                        </section>
                                        
                                        <section class="footer-section">
                                            <h3 class="footer__title ui-title-inner">Thể Loại tin</h3>
                                            <div class="decor-right decor-right_sm bg-7"></div>
                                            <ul class="footer-list list list-mark-2">
                                                @foreach ($theloaiColumO as $cate)
                                                    <li><a href="{{ url('site/tin/theloai/' . $cate->slug_theloai) }}">{{ $cate->TenTL }}</a></li>
                                                @endforeach
                                            </ul>
                                        </section>
                                        <section class="footer-section" style="margin-top: 31px;">
                                            <div class="decor-right decor-right_sm bg-7"></div>

                                            <ul class="footer-list list list-mark-2">
                                                @foreach ($theloaiColumSc as $cateSC)
                                                    <li><a href="{{ url('site/tin/theloai/' . $cateSC->slug_theloai) }}">{{ $cateSC->TenTL }}</a></li>
                                                @endforeach
                                            </ul>
                                        </section>
                                    </div>
                                </div>
                                <form class="footer-form d-none" style="display: none;">
                                    <div class="form-group has-feedback">
                                        <input type="email" placeholder="Tìm kiếm tin" class="form-control">
                                        <button class="icon pe-7s-search form-control-feedback bg-primary"></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="footer-posts">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4">
                                    <section class="section-area">
                                        <h3 class="footer__title ui-title-inner">featured posts</h3>
                                        <div class="decor-right decor-right_sm"></div>
                                        <article class="post post-3 post-3_mod-b clearfix">
                                            <div class="entry-media"><a href="assets/media/content/post/100x100/16.jpg"
                                                    class="prettyPhoto"><img
                                                        src="assets/media/content/post/100x100/16.jpg" alt="Foto"
                                                        class="img-responsive"></a></div>
                                            <div class="entry-main">
                                                <div class="entry-header">
                                                    <h2 class="entry-title"><a href="news_details-1.html">Equip exea
                                                            comod rure nsew uat duis ipsum</a></h2>
                                                </div>
                                                <div class="entry-meta"><span
                                                        class="category color-4">entertainment</span><span
                                                        class="entry-meta__item"><i class="icon pe-7s-comment"></i><a
                                                            href="news_details-1.html"
                                                            class="entry-meta__link">34</a></span></div>
                                            </div>
                                        </article>
                                        <article class="post post-3 post-3_mod-b clearfix">
                                            <div class="entry-media"><a href="assets/media/content/post/100x100/17.jpg"
                                                    class="prettyPhoto"><img
                                                        src="assets/media/content/post/100x100/17.jpg" alt="Foto"
                                                        class="img-responsive"></a></div>
                                            <div class="entry-main">
                                                <div class="entry-header">
                                                    <h2 class="entry-title"><a href="news_details-1.html">Lorem ipsum
                                                            dolor sit amet elit sed do eiusmod</a></h2>
                                                </div>
                                                <div class="entry-meta"><span
                                                        class="category color-6">travel</span><span
                                                        class="entry-meta__item"><i class="icon pe-7s-comment"></i><a
                                                            href="news_details-1.html"
                                                            class="entry-meta__link">16</a></span></div>
                                            </div>
                                        </article>
                                        <article class="post post-3 post-3_mod-b clearfix">
                                            <div class="entry-media"><a href="assets/media/content/post/100x100/18.jpg"
                                                    class="prettyPhoto"><img
                                                        src="assets/media/content/post/100x100/18.jpg" alt="Foto"
                                                        class="img-responsive"></a></div>
                                            <div class="entry-main">
                                                <div class="entry-header">
                                                    <h2 class="entry-title"><a href="news_details-1.html">Exercitation
                                                            ullamco laboris nisi ut aliquip ex ea</a></h2>
                                                </div>
                                                <div class="entry-meta"><span
                                                        class="category color-1">politics</span><span
                                                        class="entry-meta__item"><i class="icon pe-7s-comment"></i><a
                                                            href="news_details-1.html"
                                                            class="entry-meta__link">89</a></span></div>
                                            </div>
                                        </article>
                                    </section>
                                </div>
                                <div class="col-md-4">
                                    <section class="section-area">
                                        <h3 class="footer__title ui-title-inner">twitter feed</h3>
                                        <div class="decor-right decor-right_sm"></div>
                                        <div class="social-feed">
                                            <div class="social-feed__icon fa fa-twitter"></div>
                                            <div class="social-feed__inner">
                                                <div class="social-feed__content">Elit sed eiusmod tempor incididunt
                                                    labore dolore magna aliqua enimad</div>
                                                <div class="social-feed__footer">
                                                    <cite><a href="home.html"
                                                            class="social-feed__author">@newsagency</a></cite>
                                                    <time datetime="2016-05-03T08:23:11+07:00"
                                                        class="social-feed__date">2 hours ago</time>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="social-feed">
                                            <div class="social-feed__icon fa fa-twitter"></div>
                                            <div class="social-feed__inner">
                                                <div class="social-feed__content">Lorem ipsum dolors amet consectetur
                                                    elit sed do eiusmod tempor incididunt.</div>
                                                <div class="social-feed__footer">
                                                    <cite><a href="home.html"
                                                            class="social-feed__author">@newsagency</a></cite>
                                                    <time datetime="2016-05-03T08:23:11+07:00"
                                                        class="social-feed__date">2 hours ago</time>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="social-feed">
                                            <div class="social-feed__icon fa fa-twitter"></div>
                                            <div class="social-feed__inner">
                                                <div class="social-feed__content">Elit sed eiusmod tempor incididunt
                                                    labore dolore magna aliqua enimad</div>
                                                <div class="social-feed__footer">
                                                    <cite><a href="home.html"
                                                            class="social-feed__author">@newsagency</a></cite>
                                                    <time datetime="2016-05-03T08:23:11+07:00"
                                                        class="social-feed__date">2 hours ago</time>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div class="col-md-4">
                                    <section class="section-area">
                                        <h3 class="footer__title ui-title-inner">recent reviews</h3>
                                        <div class="decor-right"></div>
                                        <article class="post post-3 post-3_mod-b clearfix">
                                            <div class="entry-media"><a href="assets/media/content/post/100x100/19.jpg"
                                                    class="prettyPhoto"><img
                                                        src="assets/media/content/post/100x100/19.jpg" alt="Foto"
                                                        class="img-responsive"></a></div>
                                            <div class="entry-main">
                                                <div class="entry-header">
                                                    <h2 class="entry-title"><a href="news_details-1.html">Equip exea
                                                            comod rure nsew uat duis ipsum</a></h2>
                                                </div>
                                                <div class="entry-meta"><span class="entry-meta__item">By<a
                                                            href="news_details-1.html" class="entry-meta__link"> john
                                                            sina</a></span><span class="entry-meta__item"><span
                                                            class="rainting"><i class="icon fa fa-star"></i><span
                                                                class="entry-meta__link">x 4</span></span></span></div>
                                            </div>
                                        </article>
                                        <article class="post post-3 post-3_mod-b clearfix">
                                            <div class="entry-media"><a href="assets/media/content/post/100x100/20.jpg"
                                                    class="prettyPhoto"><img
                                                        src="assets/media/content/post/100x100/20.jpg" alt="Foto"
                                                        class="img-responsive"></a></div>
                                            <div class="entry-main">
                                                <div class="entry-header">
                                                    <h2 class="entry-title"><a href="news_details-1.html">Lorem ipsum
                                                            dolor sit amet elit sed do eiusmod</a></h2>
                                                </div>
                                                <div class="entry-meta"><span class="entry-meta__item">By<a
                                                            href="news_details-1.html" class="entry-meta__link"> john
                                                            sina</a></span><span class="entry-meta__item"><span
                                                            class="rainting"><i class="icon fa fa-star"></i><span
                                                                class="entry-meta__link">x 5</span></span></span></div>
                                            </div>
                                        </article>
                                        <article class="post post-3 post-3_mod-b clearfix">
                                            <div class="entry-media"><a href="assets/media/content/post/100x100/21.jpg"
                                                    class="prettyPhoto"><img
                                                        src="assets/media/content/post/100x100/21.jpg" alt="Foto"
                                                        class="img-responsive"></a></div>
                                            <div class="entry-main">
                                                <div class="entry-header">
                                                    <h2 class="entry-title"><a href="news_details-1.html">Exercitation
                                                            ullamco laboris nisi ut aliquip ex ea</a></h2>
                                                </div>
                                                <div class="entry-meta"><span class="entry-meta__item">By<a
                                                            href="news_details-1.html" class="entry-meta__link"> john
                                                            sina</a></span><span class="entry-meta__item"><span
                                                            class="rainting"><i class="icon fa fa-star"></i><span
                                                                class="entry-meta__link">x 5</span></span></span></div>
                                            </div>
                                        </article>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="footer-bottom" style="background: #111;">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="footer-bottom__link bg-primary">
                                        <div class="footer-bottom__wrap-link">Ngày mới express<i
                                                class="icon fa fa-caret-right"></i></div>
                                    </div>
                                    <div class="footer-bottom__inner">
                                        Các nguồn kênh tin được cung cấp miễn phí cho các cá nhân và các tổ chức phi lợi
                                        nhuận.
                                    </div>
                                    <div class="copyright">© 2016 Toàn bộ bản quyền thuộc <a href="/"
                                            class="text-uppercase">NGÀY MỚI</a> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end wrap-content-->
            </div>
        </div>
    </div>

    @include('site.navhide')


    <script src="assets/js/main.js"></script>
    <script src="assets/js/separate-js/custom.js"></script>
    <script src="assets/plugins/3d-bold-navigation/main.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/slider-pro/jquery.sliderPro.js"></script>
    <script src="assets/plugins/owl-carousel/owl.carousel.min.js"></script>
    <script src="assets/plugins/isotope/isotope.pkgd.min.js"></script>
    <script src="assets/plugins/prettyphoto/jquery.prettyPhoto.js"></script>
    <script src="assets/plugins/bootstrap-select/bootstrap-select.js"></script>
    <script src="assets/plugins/rendro-easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="assets/plugins/doubletaptogo.js"></script>
    <script src="assets/plugins/waypoints.min.js"></script>
    <script src="assets/plugins/news-ticker/js/endlessRiver.js"></script>
    <script src="assets/plugins/datetimepicker/jquery.datetimepicker.js"></script>
    <script src="assets/plugins/flexslider/jquery.flexslider.js"></script>
    <script src="assets/plugins/jarallax/jarallax.js"></script>
    <script src="assets/plugins/scrollreveal/scrollreveal.js"></script>
    <script src="assets/plugins/classie.js"></script>
    <script src="assets/plugins/switcher/js/dmss.js"></script>
</body>

</html>
