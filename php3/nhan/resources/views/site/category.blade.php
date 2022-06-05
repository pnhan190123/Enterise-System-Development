@extends('site.layout')
<?php

use Illuminate\Support\Facades\Auth;

?>
@section('title')
Tin Trong Loại
@endsection
@section('main')


<div class="section-type-b">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div data-pagination="false" data-navigation="true" data-single-item="true" data-auto-play="7000" data-transition-style="fade" data-main-text-animation="true" data-after-init-delay="3000" data-after-move-delay="1000" data-stop-on-hover="true" class="slider-type-a owl-carousel owl-theme owl-theme_mod-d enable-owl-carousel">

                    <div class="slider-type-a__item">
                        <?php
                        if (Auth::id() != null) { ?>
                            <a href="{{ url('site/tin/chitiet/' . $newsFirst->slug_tin) }}"><img src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{ $newsFirst->idUser}}/{{ $newsFirst->urlHinh }}" style="height: 400px;width: 100% !important;object-fit: cover;" alt="foto" class="slider-type-a__img"></a>

                            <a href="{{ url('site/tin/chitiet/' . $newsFirst->slug_tin) }}"><img src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{ $newsFirst->idUser}}/{{ $newsFirst->urlHinh }}" style="height: 400px;width: 100% !important;object-fit: cover;" alt="foto" class="slider-type-a__img"></a>

                        <?php } else { ?>
                            <a href="/login"><img src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{ $newsFirst->idUser}}/{{ $newsFirst->urlHinh }}" style="height: 400px;width: 100% !important;object-fit: cover;" alt="foto" class="slider-type-a__img"></a>

                            <a href="/login"><img src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{ $newsFirst->idUser}}/{{ $newsFirst->urlHinh }}" style="height: 400px;width: 100% !important;object-fit: cover;" alt="foto" class="slider-type-a__img"></a>
                        <?php  }
                        ?>

                        <div class="slider-type-a__inner">
                            <?php
                            if (Auth::id() != null) { ?>
                                <div class="slider-type-a__title" style="padding: 0px 100px;line-height: 37px;padding-bottom: 10px;"><a href="{{ url('site/tin/chitiet/' . $newsFirst->slug_tin) }}" style="color: white">{{ $newsFirst->TieuDe }}</a></div>


                            <?php } else { ?>
                                <div class="slider-type-a__title" style="padding: 0px 100px;line-height: 37px;padding-bottom: 10px;"><a href="/login" style="color: white">{{ $newsFirst->TieuDe }}</a></div>

                            <?php  }
                            ?>

                            <div class="slider-type-a__footer">
                                <a style="color: white;" href="{{ url('site/profile/user/' . $newsFirst->idUser) }}" class="slider-type-a__meta">{{ $newsFirst->hoten }} </a>
                                <span class="slider-type-a__meta" style="margin-left: 16px;">{{ $newsFirst->Ngay }}</span>
                                <span class="slider-type-a__meta"><i class="icon pe-7s-comment"></i>{{ $newsFirst->commentNum }}</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section-default">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if (isset($sotin))
                @if ($sotin == 0)
                <h3 class="text-center">Không tìm thấy sản phẩm tên nào có từ khóa "<?= $keyword ?>"</h3>
                <div class="row mt-5" style="margin-top: 2em;margin-bottom: 170px;">
                    <div class="col-sm-6 col-sm-offset-3">
                        <button class="ui-form__btn btn btn-sm btn-info btn-full btn-effect"><a href="/" style="color: white;"><i class="icon pe-7s-mail"></i>Quay lại trang chủ</a></button>
                    </div>
                </div>
                @endif
                @endif
                @if (isset($sotin))
                @if ($sotin > 0)
                <div class="thongbao mb-4 text-left">
                    <h3 class="text-left color-black" style="margin-top: 0px; margin-bottom: 1.2em;">Từ khóa "<?= $keyword ?>" có <?= $sotin ?> tin được tìm thấy</h3>
                </div>
                @endif
                @endif
                @foreach ($newsNext as $newNext)
                <article class="post post-5 clearfix">

                    <div class="entry-media">
                        <a href="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$newNext->idUser}}/{{ $newNext->urlHinh }}" class="prettyPhoto">
                            <img src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$newNext->idUser}}/{{ $newNext->urlHinh }}" style="height: 300px;object-fit: cover;" alt="Foto" class="img-responsive" />
                        </a>
                    </div>
                    <div class="entry-main">
                        <div class="entry-header">
                        <?php
                        if (Auth::id() != null) { ?>
                                <a href="{{ url('site/tin/theloai/loaitin/' . $newNext->slug_loaitin) }}"><span class="category color-4">{{ $newNext->CatetegoryName }}</span></a>
                                    <h2 class="entry-title">
                                        <a href="{{ url('site/tin/chitiet/' . $newNext->slug_tin) }}" class="limit-content-2">
                                            {{ $newNext->TieuDe }}
                                        </a>
                                    </h2>

                        <?php } else { ?>
                            <a href="/login"><span class="category color-4">{{ $newNext->CatetegoryName }}</span></a>
                            <h2 class="entry-title">
                                <a href="/login" class="limit-content-2">
                                    {{ $newNext->TieuDe }}
                                </a>
                            </h2>
                        <?php  }
                        ?>

                        
                            
                        </div>
                        <div class="entry-meta">
                            <span class="entry-meta__item">
                                <a href="{{ url('site/profile/user/' . $newNext->idUser) }}" class="entry-meta__link"> {{ $newNext->hoten }}</a>
                            </span>
                            <span class="entry-meta__item">
                                <span href="news_details-1.html" class="entry-meta__link">{{ $newNext->Ngay }}</span>
                            </span>
                            <span class="entry-meta__item">
                                <i class="icon pe-7s-comment"></i>
                                <span href="news_details-1.html" class="entry-meta__link">{{ $newNext->commentNum }}</span>
                            </span>
                            <span class="entry-meta__item">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <span href="news_details-1.html" class="entry-meta__link">{{ $newNext->SoLanXem }}</span>
                            </span>
                        </div>
                        <div class="entry-content">
                            <p class="limit-content-3">{{ $newNext->TomTat }}</p>
                        </div>

                        <?php
                        if (Auth::id() != null) { ?>
                               <div class="entry-footer"><a href="{{ url('site/tin/chitiet/' . $newNext->slug_tin) }}" class="btn-link">Đọc tiếp</a>
                        </div>
                        <?php } else { ?>
                            <div class="entry-footer"><a href="/login" class="btn-link">Đọc tiếp</a>

                        <?php  }
                        ?>

                       
                    </div>
                </article>
                @endforeach
                @if (isset($sotin))
                @if ($sotin > 0)
                <div class="wrap-pagination">
                    {{$newsNext->links("pagination::bootstrap-4")}}
                </div>
                @endif
                @else
                <div class="wrap-pagination">
                    {{$newsNext->links("pagination::bootstrap-4")}}
                </div>
                @endif
            </div>

            @include('site.right')

        </div>
    </div>
</div>

@endsection