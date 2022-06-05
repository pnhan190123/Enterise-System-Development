<?php 

use Illuminate\Support\Facades\Auth;
?>
<div class="wrap-nav">
    <nav class="navbar yamm">

        @include('site.menu')

        <div class="header-search">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
                        <div class="navbar-search">
                            <form class="search-global" action="{{ route('tin.timkiem') }}" method="get">
                                @csrf
                                <input type="text" placeholder="Tìm kiếm" name="keyword" autocomplete="off" name="s" value=""
                                    class="search-global__input" />
                                <button class="search-global__btn" type="submit"><i class="icon fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="search-close close"><i class="fa fa-times"></i></button>
        </div>
    </nav>
    <div id="main-slider" data-slider-width="100%" data-slider-height="750" data-orientation="vertical"
        class="main-slider main-slider_mod-c main-slider_dark-2 text-center slider-pro">
        <div class="sp-slides">
            @foreach ($hotSlide as $hot)
            @php
                $classColor = 'bg-' . $loop->index + 1;
            @endphp
                <div class="sp-slide">
                    <img src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{ $hot->idUser }}/{{ $hot->urlHinh }}" alt="slider" class="sp-image" />
                    <div data-width="100%" data-show-transition="left" data-hide-transition="left"
                        data-show-duration="800" data-show-delay="400" data-hide-delay="400" class="sp-layer">
                        <div class="main-slider__wrap-title" style="padding: 0px 300px;">
                        
                        <?php
                                                if (Auth::id() != null) { ?>
                                                          <h2 class="main-slider__title" style="background: none;"><a class="color-white" style="color: white;" href="{{ url('site/tin/chitiet/' . $hot->slug_tin) }}">
                                <span style="line-height: 45px; color: white;">{{ $hot->TieuDe }}</span>
                                {{-- <span>{{ $hot->TenTL }}</span> --}}
                            </a></h2>
                                                <?php } else { ?>
                                                    <h2 class="main-slider__title" style="background: none;"><a class="color-white" style="color: white;" href="/login">
                                <span style="line-height: 45px; color: white;">{{ $hot->TieuDe }}</span>
                                {{-- <span>{{ $hot->TenTL }}</span> --}}
                            </a></h2>
                                                <?php  }
                                                ?>
                          
                        </div>
                    </div>
                    <div data-width="100%" data-show-transition="up" data-hide-transition="left"
                        data-show-duration="800" data-show-delay="1700" data-hide-delay="400" class="sp-layer">
                        <a href="{{ url('site/tin/theloai/loaitin/' . $hot->slug_loaitin) }}" class="main-slider__link {{ $classColor }} btn btn-xs btn-effect">{{ $hot->Ten }}</a>
                    </div>
                    <div data-width="100%" data-show-transition="right" data-hide-transition="left"
                        data-show-duration="800" data-show-delay="1200" data-hide-delay="400" class="sp-layer">
                        <div class="main-slider-meta">
                            <a href="{{ url('site/profile/user/' . $hot->idUser) }}"  style="color: white;" class="entry-meta__link">{{ $hot->hoten }}</a>
                            <span class="main-slider-meta__item" style="margin-left: 15px;">{{ $hot->Ngay }}</span>
                            <span class="main-slider-meta__item"><i class="icon pe-7s-comment"></i>{{ $hot->commentNum }}</span></div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <section class="section-type-a wow">
                <div class="wrap-title-bg">
                    <h2 class="ui-title-bg">Tin Mới Nhất Theo Danh Mục</h2>
                </div>
                <div data-min480="1" data-min768="2" data-min992="2" data-min1200="4" data-pagination="false"
                    data-navigation="true" data-auto-play="4000" data-stop-on-hover="true"
                    class="owl-carousel owl-theme enable-owl-carousel">
                    @foreach ($newsFromCategories as $lates)
                    @php
                        $classColor = 'bg-' . $loop->index + 1;
                    @endphp

                    <article class="post post-1 clearfix">
                        <div class="entry-media"><a href="http://localhost:8080/php3/nhan/storage/app/public/photos/{{ $lates->idUser }}/{{ $lates->urlHinh }}"
                                class="prettyPhoto"><img style="height: 300px;object-fit: cover;" src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$lates->idUser }}/{{ $lates->urlHinh }}" alt="Foto"
                                    class="img-responsive" /></a>
                                    
                                    <?php
                                                if (Auth::id() != null) { ?>
                                                                                    <a href="{{ url('site/tin/chitiet/' . $lates->slug_tin) }}"><h2 class="entry-title limit-content-2">{{ $lates->TieuDe }}</h2></a>

                                                <?php } else { ?>
                                                    <a href="/login"><h2 class="entry-title limit-content-2">{{ $lates->TieuDe }}</h2></a>

                                                <?php  }
                                                ?>
                        </div><a href="{{ url('site/tin/theloai/loaitin/' . $lates->slug_loaitin) }}"><span class="label {{ $classColor }}">{{ $lates->Ten }}</span></a>
                        <div class="entry-meta">
                            <span class="entry-meta__item"><a href="{{ url('site/profile/user/' . $lates->idUser) }}" class="entry-meta__link">{{ $lates->hoten }}</a></span>
                            <span class="entry-meta__item"><span href="news_details-1.html" class="entry-meta__link">{{ $lates->Ngay }}</span></span>
                            <span class="entry-meta__item"><i class="icon pe-7s-comment"></i>{{ $lates->commentNum }}</span>
                        </div>
                    </article>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</div>
