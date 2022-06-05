@extends('site.layout')

@section('title')
Trang Chủ
@endsection

<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

$data  =  DB::table('giaodich')->where('idUser', '=', Auth::id())->first();
$role_giaodich = $data->role_giaodich ?? null;
$ngayhethan =  $data->thoigianhethan ?? null;
$tmp = Carbon::now()->timestamp;
if (Auth::id() ?? null) {
    if ($ngayhethan <= $tmp) {
        // print dd($tmp);
        if ($role_giaodich != 1) { ?>

            @include('site.money')

        <?php

        } elseif ($role_giaodich == 1) { ?>
            @include('site.money')

        <?php }
    } elseif ($role_giaodich == 1) { ?>
        @include('site.confirm')
    <?php } else { ?>
        @include('site.money')

<?php }
}
?>

@section('main')
<div class="section-type-c">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <section class="section-area wow">
                    <div class="row">
                        <div class="col-md-4">
                            <h2 class="ui-title-block"><span class="ui-title-block__subtitle">Khám Phá Hàng
                                    Đầu</span><span class="text-uppercase">news makers</span></h2>
                        </div>
                        <div class="col-md-8">
                            <ul class="nav nav-tabs nav-tabs_mod-a pull-right">
                                <li class="tabs-label">Tìm kiếm nội dung</li>
                                <li class="active"><a href="#tab-1" data-toggle="tab">Mới nhất</a></li>
                                <li><a href="#tab-2" data-toggle="tab">Tuần trước</a></li>
                                <li><a href="#tab-3" data-toggle="tab">Tin nổi bật</a></li>
                                <li><a href="#tab-4" data-toggle="tab">Đánh giá cao</a></li>
                            </ul>
                        </div>
                    </div>


                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade in active">
                            <div class="row">
                                <div class="col-md-8">
                                    @foreach ($lastNews['firstNewsLates'] as $first)

                                    <article class="post post-2 post-2_mod-d clearfix">
                                        <div class="entry-media">
                                            <a href="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$first->idUser}}/{{ $first->urlHinh }}" class="prettyPhoto">
                                                <img src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$first->idUser}}/{{ $first->urlHinh }}" style="height: 450px;object-fit: cover;" alt="Foto" class="img-responsive" />
                                            </a>
                                            <?php
                                            if (Auth::id() != null) { ?>
                                                <a href="{{ url('site/tin/theloai/loaitin/' . $first->slug_loaitin) }}"><span class="label bg-3">{{ $first->Ten }}</span></a>

                                            <?php } else { ?>
                                                <a href="/login"><span class="label bg-3">{{ $first->Ten }}</span></a>

                                            <?php  }
                                            ?>
                                        </div>
                                        <div class="entry-main">
                                            <div class="entry-header">

                                                <?php
                                                if (Auth::id() != null) { ?>

                                                    <a href="{{ url('site/tin/chitiet/' . $first->slug_tin) }}">
                                                        <h2 class="entry-title text-uppercase">{{ $first->TieuDe }}
                                                        </h2>
                                                    </a>
                                                <?php } else { ?>
                                                    <a href="/login">
                                                        <h2 class="entry-title text-uppercase">{{ $first->TieuDe }}
                                                        </h2>
                                                    </a>

                                                <?php  }
                                                ?>

                                            </div>
                                            <div class="entry-meta">
                                                <span class="entry-meta__item">Bởi
                                                    <a href="{{ url('site/profile/user/' . $first->idUser) }}" class="entry-meta__link">
                                                        {{ $first->hoten }}</a>
                                                </span>
                                                <span class="entry-meta__item">
                                                    <span href="news_details-1.html" class="entry-meta__link">{{ $first->Ngay }}</span>
                                                </span>
                                                <span class="entry-meta__item">
                                                    <i class="icon pe-7s-comment"></i>
                                                    <span href="news_details-1.html" class="entry-meta__link">{{ $first->commentNum }}</span>
                                                </span>
                                            </div>
                                            <div class="entry-content">
                                                <p class="limit-content-3">{{ $first->TomTat }}</p>
                                            </div>
                                            <?php
                                            if (Auth::id() != null) { ?>
                                                <div class="entry-footer"><a href="{{ url('site/tin/chitiet/' . $first->slug_tin) }}" class="btn-link">Đọc tiếp</a></div>
                                        </div>
                                    <?php } else { ?>
                                        <div class="entry-footer"><a href="/login" class="btn-link">Đọc tiếp</a></div>
                                </div>
                            <?php  }
                            ?>

                            </article>

                            @endforeach
                            </div>
                            <div class="col-md-4">
                                @foreach ($lastNews['nextNewsLates'] as $next)
                                @php
                                $classColor = 'color-' . $loop->index + 1;
                                @endphp
                                <article class="post post-3 post-3_mod-a clearfix">
                                    <div class="entry-media"><a href="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$next->idUser}}/{{ $next->urlHinh }}" class="prettyPhoto"><img style="height: 98px;" src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$next->idUser}}/{{ $next->urlHinh }}" alt="Foto" class="img-responsive" /></a></div>
                                    <div class="entry-main">
                                        <?php
                                        if (Auth::id() != null) { ?>
                                            <div class="entry-header">
                                                <h2 class="entry-title"><a href="{{ url('site/tin/chitiet/' . $next->slug_tin) }}" class="limit-content-2">{{ $next->TieuDe }}</a></h2>
                                            </div>
                                            <div class="entry-meta">
                                                <a href="{{ url('site/tin/theloai/loaitin/' . $next->slug_loaitin) }}"><span class="category {{ $classColor }}">{{ $next->Ten }}</span></a>
                                                <span class="entry-meta__item">
                                                    <i class="icon pe-7s-comment"></i><a href="news_details-1.html" class="entry-meta__link">{{ $next->commentNum }}</a>
                                                </span>
                                            </div>
                                        <?php } else { ?>
                                            <div class="entry-header">
                                                <h2 class="entry-title"><a href="/login" class="limit-content-2">{{ $next->TieuDe }}</a></h2>
                                            </div>
                                            <div class="entry-meta">
                                                <a href="/login"><span class="category {{ $classColor }}">{{ $next->Ten }}</span></a>
                                                <span class="entry-meta__item">
                                                    <i class="icon pe-7s-comment"></i><a href="news_details-1.html" class="entry-meta__link">{{ $next->commentNum }}</a>
                                                </span>
                                            </div>
                                        <?php  }
                                        ?>




                                    </div>
                                </article>

                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane fade">
                        <div class="row">
                            <div class="col-md-8">
                                @foreach ($lastWeekHome['firstNewsLastWeek'] as $firstNewsLastWeek)
                                <article class="post post-2 post-2_mod-d clearfix">
                                    <div class="entry-media">
                                        <a href="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$firstNewsLastWeek->idUser}}/{{ $firstNewsLastWeek->urlHinh }}" class="prettyPhoto">
                                            <img src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$firstNewsLastWeek->idUser}}/{{ $firstNewsLastWeek->urlHinh }}" style="height: 450px;object-fit: cover;" alt="Foto" class="img-responsive" />
                                        </a>
                                        <a href="{{ url('site/tin/theloai/loaitin/' . $firstNewsLastWeek->slug_loaitin) }}"><span class="label bg-3">{{ $firstNewsLastWeek->Ten }}</span></a>
                                    </div>
                                    <div class="entry-main">
                                        <div class="entry-header">

                                            <?php
                                            if (Auth::id() != null) { ?>
                                                <a href="{{ url('site/tin/chitiet/' . $firstNewsLastWeek->slug_tin) }}">
                                                    <h2 class="entry-title text-uppercase">{{ $firstNewsLastWeek->TieuDe }}
                                                    </h2>
                                                </a>
                                            <?php } else { ?>
                                                <a href="/login">
                                                    <h2 class="entry-title text-uppercase">{{ $firstNewsLastWeek->TieuDe }}
                                                    </h2>
                                                </a>
                                            <?php  }
                                            ?>




                                        </div>
                                        <div class="entry-meta">
                                            <span class="entry-meta__item">Bởi
                                                <a href="{{ url('site/profile/user/' . $firstNewsLastWeek->idUser) }}" class="entry-meta__link">
                                                    {{ $firstNewsLastWeek->hoten }}</a>
                                            </span>
                                            <span class="entry-meta__item">
                                                <span href="news_details-1.html" class="entry-meta__link">{{ $firstNewsLastWeek->Ngay }}</span>
                                            </span>
                                            <span class="entry-meta__item">
                                                <i class="icon pe-7s-comment"></i>
                                                <span href="news_details-1.html" class="entry-meta__link">{{ $firstNewsLastWeek->commentNum }}</span>
                                            </span>
                                        </div>
                                        <div class="entry-content">
                                            <p class="limit-content-3">{{ $firstNewsLastWeek->TomTat }}</p>
                                        </div>
                                       
                                        <?php
                                                if (Auth::id() != null) { ?>
                                                           <div class="entry-footer"><a href="{{ url('site/tin/chitiet/' . $firstNewsLastWeek->slug_tin) }}" class="btn-link">Đọc tiếp</a></div>
                                                           </div>
                                                <?php } else { ?>
                                                    <div class="entry-footer"><a href="/login" class="btn-link">Đọc tiếp</a></div>
                                                           </div>
                                                <?php  }
                                                ?>         
                                     
                                </article>

                                @endforeach
                            </div>
                            <div class="col-md-4">
                                @foreach ($lastWeekHome['nextNewsLastWeek'] as $nextNewsLastWeek)
                                @php
                                $classColor = 'color-' . $loop->index + 1;
                                @endphp
                                <article class="post post-3 post-3_mod-a clearfix">
                                    <div class="entry-media"><a href="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$nextNewsLastWeek->idUser}}/{{ $nextNewsLastWeek->urlHinh }}" class="prettyPhoto"><img style="height: 98px;" src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$nextNewsLastWeek->idUser}}/{{ $nextNewsLastWeek->urlHinh }}" alt="Foto" class="img-responsive" /></a></div>
                                    <div class="entry-main">
                                        <div class="entry-header">

                                            <?php
                                            if (Auth::id() != null) { ?>
                                                <h2 class="entry-title"><a href="{{ url('site/tin/chitiet/' . $nextNewsLastWeek->slug_tin) }}" class="limit-content-2">{{ $nextNewsLastWeek->TieuDe }}</a></h2>
                                        </div>
                                        <div class="entry-meta">
                                            <a href="{{ url('site/tin/theloai/loaitin/' . $nextNewsLastWeek->slug_loaitin) }}"><span class="category {{ $classColor }}">{{ $nextNewsLastWeek->Ten }}</span></a>
                                            <span class="entry-meta__item">
                                                <i class="icon pe-7s-comment"></i><a href="news_details-1.html" class="entry-meta__link">{{ $nextNewsLastWeek->commentNum }}</a>
                                            </span>
                                        </div>

                                    <?php } else { ?>
                                        <h2 class="entry-title"><a href="/login" class="limit-content-2">{{ $nextNewsLastWeek->TieuDe }}</a></h2>
                                    </div>
                                    <div class="entry-meta">
                                        <a href="/login"><span class="category {{ $classColor }}">{{ $nextNewsLastWeek->Ten }}</span></a>
                                        <span class="entry-meta__item">
                                            <i class="icon pe-7s-comment"></i><a href="news_details-1.html" class="entry-meta__link">{{ $nextNewsLastWeek->commentNum }}</a>
                                        </span>
                                    </div>

                                <?php  }
                                ?>

                            </div>
                            </article>

                            @endforeach
                        </div>
                    </div>
            </div>
            <div id="tab-3" class="tab-pane fade">
                <div class="row">
                    <div class="col-md-8">
                        @foreach ($hotNewsHome['firstNewsHot'] as $firstNewsHot)

                        <article class="post post-2 post-2_mod-d clearfix">
                            <div class="entry-media">
                                <a href="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$firstNewsHot->idUser}}/{{ $firstNewsHot->urlHinh }}" class="prettyPhoto">
                                    <img src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$firstNewsHot->idUser}}/{{ $firstNewsHot->urlHinh }}" style="height: 450px;object-fit: cover;" alt="Foto" class="img-responsive" />
                                </a>
                                <a href="{{ url('site/tin/theloai/loaitin/' . $firstNewsHot->slug_loaitin) }}"><span class="label bg-3">{{ $firstNewsHot->Ten }}</span></a>
                            </div>
                            <div class="entry-main">

                                <?php
                                if (Auth::id() != null) { ?>
                                    <div class="entry-header">
                                        <a href="{{ url('site/tin/chitiet/' . $firstNewsHot->slug_tin) }}">
                                            <h2 class="entry-title text-uppercase">{{ $firstNewsHot->TieuDe }}
                                            </h2>
                                        </a>
                                    </div>
                                <?php } else { ?>
                                    <div class="entry-header">
                                        <a href="/login">
                                            <h2 class="entry-title text-uppercase">{{ $firstNewsHot->TieuDe }}
                                            </h2>
                                        </a>
                                    </div>
                                <?php  }
                                ?>

                                <div class="entry-meta">
                                    <span class="entry-meta__item">Bởi
                                        <a href="{{ url('site/profile/user/' . $firstNewsHot->idUser) }}" class="entry-meta__link">
                                            {{ $firstNewsHot->hoten }}</span>
                                    </span>
                                    <span class="entry-meta__item">
                                        <span href="news_details-1.html" class="entry-meta__link">{{ $firstNewsHot->Ngay }}</span>
                                    </span>
                                    <span class="entry-meta__item">
                                        <i class="icon pe-7s-comment"></i>
                                        <span href="news_details-1.html" class="entry-meta__link">{{ $firstNewsHot->commentNum }}</span>
                                    </span>
                                </div>
                                <div class="entry-content">
                                    <p class="limit-content-3">{{ $firstNewsHot->TomTat }}</p>
                                </div>

                                <?php
                                if (Auth::id() != null) { ?>
                                    <div class="entry-footer"><a href="{{ url('site/tin/chitiet/' . $firstNewsHot->slug_tin) }}" class="btn-link">Đọc tiếp</a></div>

                                <?php } else { ?>
                                    <div class="entry-footer"><a href="/login" class="btn-link">Đọc tiếp</a></div>

                                <?php  }
                                ?>
                            </div>
                        </article>

                        @endforeach
                    </div>
                    <div class="col-md-4">
                        @foreach ($hotNewsHome['nextNewsHot'] as $nextNewsHot)
                        @php
                        $classColor = 'color-' . $loop->index + 1;
                        @endphp
                        <article class="post post-3 post-3_mod-a clearfix">
                            <div class="entry-media"><a href="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$nextNewsHot->idUser}}/{{ $nextNewsHot->urlHinh }}" class="prettyPhoto"><img style="height: 98px;" src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$nextNewsHot->idUser}}/{{ $nextNewsHot->urlHinh }}" alt="Foto" class="img-responsive" /></a></div>
                            <div class="entry-main">
                                <div class="entry-header">

                                    <?php
                                    if (Auth::id() != null) { ?>
                                        <h2 class="entry-title"><a href="{{ url('site/tin/chitiet/' . $nextNewsHot->slug_tin) }}" class="limit-content-2">{{ $nextNewsHot->TieuDe }}</a></h2>

                                    <?php } else { ?>
                                        <h2 class="entry-title"><a href="/login}" class="limit-content-2">{{ $nextNewsHot->TieuDe }}</a></h2>

                                    <?php  }
                                    ?>
                                </div>

                                <?php
                                if (Auth::id() != null) { ?>
                                    <div class="entry-meta">
                                        <a href="{{ url('site/tin/theloai/loaitin/' . $nextNewsHot->slug_loaitin) }}"><span class="category {{ $classColor }}">{{ $nextNewsHot->Ten }}</span></a>
                                        <span class="entry-meta__item">
                                            <i class="icon pe-7s-comment"></i><a href="news_details-1.html" class="entry-meta__link">{{ $nextNewsHot->commentNum }}</a>
                                        </span>
                                    </div>
                                <?php } else { ?>
                                    <div class="entry-meta">
                                        <a href="/login"><span class="category {{ $classColor }}">{{ $nextNewsHot->Ten }}</span></a>
                                        <span class="entry-meta__item">
                                            <i class="icon pe-7s-comment"></i><a href="news_details-1.html" class="entry-meta__link">{{ $nextNewsHot->commentNum }}</a>
                                        </span>
                                    </div>
                                <?php  }
                                ?>

                            </div>
                        </article>

                        @endforeach
                    </div>
                </div>
            </div>
            <div id="tab-4" class="tab-pane fade">
                <div class="row">
                    <div class="col-md-8">
                        @foreach ($topRatedNewsHome['firstNewsTopRated'] as $firstNewsTopRated)
                        <article class="post post-2 post-2_mod-d clearfix">
                            <div class="entry-media">
                                <a href="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$firstNewsTopRated->idUser}}/{{ $firstNewsTopRated->urlHinh }}" class="prettyPhoto">
                                    <img src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$firstNewsTopRated->idUser}}/{{ $firstNewsTopRated->urlHinh }}" style="height: 450px;object-fit: cover;" alt="Foto" class="img-responsive" />
                                </a>
                                <a href="{{ url('site/tin/theloai/loaitin/' . $firstNewsTopRated->slug_loaitin) }}"><span class="label bg-3">{{ $firstNewsTopRated->Ten }}</span></a>
                            </div>
                            <div class="entry-main">

                                <?php
                                if (Auth::id() != null) { ?>
                                    <div class="entry-header">
                                        <a href="{{ url('site/tin/chitiet/' . $firstNewsTopRated->slug_tin) }}">
                                            <h2 class="entry-title text-uppercase">{{ $firstNewsTopRated->TieuDe }}
                                            </h2>
                                        </a>
                                    </div>
                                <?php } else { ?>
                                    <div class="entry-header">
                                        <a href="/login">
                                            <h2 class="entry-title text-uppercase">{{ $firstNewsTopRated->TieuDe }}
                                            </h2>
                                        </a>
                                    </div>
                                <?php  }
                                ?>

                                <div class="entry-meta">
                                    <span class="entry-meta__item">Bởi
                                        <a href="{{ url('site/profile/user/' . $firstNewsTopRated->idUser) }}" class="entry-meta__link">
                                            {{ $firstNewsTopRated->hoten }}</a>
                                    </span>
                                    <span class="entry-meta__item">
                                        <span href="news_details-1.html" class="entry-meta__link">{{ $firstNewsTopRated->Ngay }}</span>
                                    </span>
                                    <span class="entry-meta__item">
                                        <i class="icon pe-7s-comment"></i>
                                        <span href="news_details-1.html" class="entry-meta__link">{{ $firstNewsTopRated->commentNum }}</span>
                                    </span>
                                </div>
                                <div class="entry-content">
                                    <p class="limit-content-3">{{ $firstNewsTopRated->TomTat }}</p>
                                </div>
                                <?php
                                if (Auth::id() != null) { ?>
                                    <div class="entry-footer"><a href="{{ url('site/tin/chitiet/' . $firstNewsTopRated->slug_tin) }}" class="btn-link">Đọc tiếp</a></div>

                                <?php } else { ?>
                                    <div class="entry-footer"><a href="/login" class="btn-link">Đọc tiếp</a></div>

                                <?php  }
                                ?>

                            </div>
                        </article>

                        @endforeach
                    </div>
                    <div class="col-md-4">
                        @foreach ($topRatedNewsHome['nextNewsLastRated'] as $nextNewsLastRated)
                        @php
                        $classColor = 'color-' . $loop->index + 1;
                        @endphp
                        <article class="post post-3 post-3_mod-a clearfix">
                            <div class="entry-media"><a href="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$nextNewsLastRated->idUser}}/{{ $nextNewsLastRated->urlHinh }}" class="prettyPhoto"><img style="height: 98px;" src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$nextNewsLastRated->idUser}}/{{ $nextNewsLastRated->urlHinh }}" alt="Foto" class="img-responsive" /></a></div>
                            <div class="entry-main">

                                <?php
                                if (Auth::id() != null) { ?>
                                    <div class="entry-header">
                                        <h2 class="entry-title"><a href="{{ url('site/tin/chitiet/' . $nextNewsLastRated->slug_tin) }}" class="limit-content-2">{{ $nextNewsLastRated->TieuDe }}</a></h2>
                                    </div>
                                <?php } else { ?>
                                    <div class="entry-header">
                                        <h2 class="entry-title"><a href="/login" class="limit-content-2">{{ $nextNewsLastRated->TieuDe }}</a></h2>
                                    </div>
                                <?php  }
                                ?>

                                <div class="entry-meta">
                                    <a href="{{ url('site/tin/theloai/loaitin/' . $nextNewsLastRated->slug_loaitin) }}"><span class="category {{ $classColor }}">{{ $nextNewsLastRated->Ten }}</span></a>
                                    <span class="entry-meta__item">
                                        <i class="icon pe-7s-comment"></i><a href="news_details-1.html" class="entry-meta__link">{{ $nextNewsLastRated->commentNum }}</a>
                                    </span>
                                </div>
                            </div>
                        </article>

                        @endforeach
                    </div>

                </div>
            </div>
        </div>
        </section>
    </div>
</div>
</div>
</div>
<section class="section-type-a">
    <div class="wrap-title-bg">
        <h2 class="ui-title-bg">Xu hướng tìm kiếm</h2>
    </div>

    <div data-jarallax="{&quot;type&quot;: &quot;scroll-opacity&quot;, &quot;speed&quot;: &quot;.2&quot;}" style="background-image: url(http://localhost:8080/php3/nhan/storage/app/public/photos/41/media/content/bg/1.jpg)" class="section-default section-bg section-bg_dark jarallax">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="section__inner">
                        <div id="slider-1" class="slider-pro slider-thumbnails">
                            <div class="sp-slides">
                                @foreach ($newsTrend['right'] as $right)
                                @php
                                $classColor = 'bg-' . $loop->index + 1;
                                @endphp
                                <div class="sp-slide">
                                    <article class="post post-2 post-2_mod-a clearfix">
                                        <div class="entry-media"><a href="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$right[0]->idUser}}/{{ $right[0]->urlHinh }}" class="prettyPhoto"><img style="height: 320px;object-fit: cover;" src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$right[0]->idUser}}/{{ $right[0]->urlHinh }}" alt="Foto" class="img-responsive" /></a>
                                            <a href="{{ url('site/tin/theloai/loaitin/' . $right[0]->slug_loaitin) }}"><span class="label {{ $classColor }}">{{ $right[0]->Ten }}</span></a>
                                        </div>
                                        <div class="entry-main">
                                            <div class="entry-header">

                                                <?php
                                                if (Auth::id() != null) { ?>
                                                    <h2 class="entry-title text-uppercase">
                                                        <a href="{{ url('site/tin/chitiet/' . $right[0]->slug_tin) }}">{{ $right[0]->TieuDe }}</a>
                                                    </h2>
                                                <?php } else { ?>
                                                    <h2 class="entry-title text-uppercase">
                                                        <a href="/login">{{ $right[0]->TieuDe }}</a>
                                                    </h2>
                                                <?php  }
                                                ?>

                                            </div>
                                            <div class="entry-meta">
                                                <span class="entry-meta__item">Bởi
                                                    <a href="{{ url('site/profile/user/' . $right[0]->idUser) }}" class="entry-meta__link">{{ $right[0]->hoten }}</a>
                                                </span>
                                                <span class="entry-meta__item">
                                                    <span href="news_details-1.html" class="entry-meta__link">{{ $right[0]->Ngay }}</span>
                                                </span>
                                                <span class="entry-meta__item">
                                                    <i class="icon pe-7s-comment"></i>
                                                    <span href="news_details-1.html" class="entry-meta__link">{{ $right[0]->commentNum }}
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="entry-content limit-content-2">
                                                <p>{{ $right[0]->TomTat }}</p>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                @endforeach
                            </div>
                            <div class="sp-thumbnails">
                                @foreach ($newsTrend['right'] as $right)
                                @php
                                $classColor = 'bg-' . $loop->index + 1;
                                @endphp
                                <div class="sp-thumbnail">
                                    <article class="post post-2 post-2_mod-b clearfix">
                                        <div class="entry-media"><img style="width: 180px !important;height: 110px !important;" src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{ $right[0]->idUser}}/{{ $right[0]->urlHinh }}" alt="Foto" class="img-responsive" />
                                            <a href="{{ url('site/tin/theloai/loaitin/' . $right[0]->slug_loaitin) }}"><span class="label {{ $classColor }}">{{ $right[0]->Ten }}</span></a>
                                        </div>
                                        <div class="entry-main">

                                            <?php
                                            if (Auth::id() != null) { ?>
                                                <div class="entry-header">
                                                    <a href="{{ url('site/tin/chitiet/' . $right[0]->slug_tin) }}">
                                                        <h2 class="entry-title text-uppercase limit-content-2">{{ $right[0]->TieuDe }}
                                                        </h2>
                                                    </a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="entry-header">
                                                    <a href="/login">
                                                        <h2 class="entry-title text-uppercase limit-content-2">{{ $right[0]->TieuDe }}
                                                        </h2>
                                                    </a>
                                                </div>
                                            <?php  }
                                            ?>

                                            <div class="entry-meta"><span class="entry-meta__item">{{ $right[0]->Ngay }}</span><span class="entry-meta__item"><i class="icon pe-7s-comment"></i>{{ $right[0]->commentNum }}</span></div>
                                        </div>
                                    </article>
                                </div>
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="section-type-j wow">
    <div class="container">
        <div class="row">
            @foreach ($newsFromCategories_['first'] as $first)
            @php
            $i = $loop->index;
            $classColor = 'color-' . $loop->index + 1;
            @endphp

            <div class="col-md-4">
                <div class="title-category clearfix">
                    <h2 class="title-category__title ui-title-inner {{ $classColor }}">{{ $first[0]->TenTL }}</h2><span class="title-category__category">
                        @foreach ($newsFromCategories_['kinds'][$i] as $kind)
                        {{ $kind->Ten }},
                        @endforeach
                        ...
                    </span>
                </div>
                <div class="decor-right bg-4"></div>
                <article class="post post-2 post-2_mod-c post-2__mrg-btn clearfix">
                    <div class="entry-media"><a href="http://localhost:8080/php3/nhan/storage/app/public/photos/{{ $first[0]->idUser}}/{{ $first[0]->urlHinh }}" class="prettyPhoto"><img style="height: 300px;object-fit: cover;" src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{ $first[0]->idUser}}/{{ $first[0]->urlHinh }}" alt="Foto" class="img-responsive" /></a>
                    </div>
                    <div class="entry-main">

                        <?php
                        if (Auth::id() != null) { ?>
                            <div class="entry-header">
                                <a href="{{ url('site/tin/chitiet/' . $first[0]->slug_tin) }}">
                                    <h2 class="entry-title text-uppercase limit-content-2">{{ $first[0]->TieuDe }}</h2>
                                </a>
                            </div>
                            <div class="entry-meta"><span class="entry-meta__item">Bởi
                                    <a href="{{ url('site/profile/user/' . $first[0]->idUser) }}" class="entry-meta__link">{{ $first[0]->hoten }}</a></span><span class="entry-meta__item"><span href="news_details-1.html" class="entry-meta__link">{{ $first[0]->Ngay }}</span></span><span class="entry-meta__item"><i class="icon pe-7s-comment"></i><span href="news_details-1.html" class="entry-meta__link">{{ $first[0]->commentNum }}</span></span></div>
                            <div class="entry-content limit-content-3">
                                <p class="mb-0" style="margin-bottom: 0px">{{ $first[0]->TomTat }}</p>
                            </div>
                            <div class="entry-footer"><a href="{{ url('site/tin/chitiet/' . $first[0]->slug_tin) }}" class="btn-link">Đọc tiếp</a>
                            </div>
                        <?php } else { ?>
                            <div class="entry-header">
                                <a href="/login">
                                    <h2 class="entry-title text-uppercase limit-content-2">{{ $first[0]->TieuDe }}</h2>
                                </a>
                            </div>
                            <div class="entry-meta"><span class="entry-meta__item">Bởi
                                    <a href="/login" class="entry-meta__link">{{ $first[0]->hoten }}</a></span><span class="entry-meta__item"><span href="news_details-1.html" class="entry-meta__link">{{ $first[0]->Ngay }}</span></span><span class="entry-meta__item"><i class="icon pe-7s-comment"></i><span href="news_details-1.html" class="entry-meta__link">{{ $first[0]->commentNum }}</span></span></div>
                            <div class="entry-content limit-content-3">
                                <p class="mb-0" style="margin-bottom: 0px">{{ $first[0]->TomTat }}</p>
                            </div>
                            <div class="entry-footer"><a href="/login" class="btn-link">Đọc tiếp</a>
                            </div>
                        <?php  }
                        ?>

                    </div>
                </article>
                @foreach ($newsFromCategories_['next'][$i] as $next)
                <article class="post post-3 post-3_mod-c clearfix">
                    <div class="entry-media"><a href="http://localhost:8080/php3/nhan/storage/app/public/photos/{{ $next->idUser }}/{{ $next->urlHinh }}" class="prettyPhoto">
                            <img style="height: 95px;object-fit: cover;" src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$next->idUser}}/{{ $next->urlHinh }}" alt="Foto" class="img-responsive" /></a>
                    </div>
                    <div class="entry-main">
                        <div class="entry-header">
                            <?php
                            if (Auth::id() != null) { ?>
                                ?>
                                <h2 class="entry-title limit-content-2"><a href="{{ url('site/tin/chitiet/' . $next->slug_tin) }}">{{ $next->TieuDe }}</a></h2>
                            <?php } else { ?>
                                <h2 class="entry-title limit-content-2"><a href="/login">{{ $next->TieuDe }}</a></h2>

                            <?php  }
                            ?>
                        </div>
                        <div class="entry-meta">
                            <a href="{{ url('site/tin/theloai/loaitin/' . $next->slug_loaitin) }}"><span class="category color-4">{{ $next->Ten }}</span></a><span class="entry-meta__item"><i class="icon pe-7s-comment"></i><span href="news_details-1.html" class="entry-meta__link">{{ $next->commentNum }}</span></span>
                        </div>
                    </div>
                </article>
                @endforeach

            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="section-downloads section-downloads_mod-b wow">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-md-offset-7">
                <div class="downloads downloads_mod-b section__inner clearfix">
                    <div class="downloads__wrap-text">
                        <h2 class="downloads__title ui-title-block"><span class="ui-title-block__subtitle">Nhận Thông Tin Sớm Nhất</span><span class="text-uppercase">Mọi lúc mọi nơi</span></h2>
                        <div class="downloads__info">Tải Ngay Hôm Nay! Miễn Phí</div>
                        <div class="downloads__btns-group"><a href="/" class="downloads__btn"><i class="icon fa fa-apple"></i></a><a href="/" class="downloads__btn"><i class="icon fa fa-android"></i></a></div>
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
                <div class="section-type-d wow" style="padding-top: 0px"><a href="home.html" class="banner"><img src="http://localhost:8080/php3/nhan/storage/app/public/photos/41/imgaes.jpg" style="height: 110px;" alt="banner" class="img-responsive center-block"></a></div>
                <div class="section-type-b wow" style="padding-top: 25px">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="ui-title-block" style="line-height: 40px;"><span class="ui-title-block__subtitle">Danh Mục</span><span class="text-uppercase">Tin Ngẫu Nhiên</span></h2>
                            @foreach ($ramdom['next'] as $rdom)
                            @php
                            $classColor = 'color-' . $loop->index + 1;
                            @endphp
                            <article class="post post-3 post-3_mod-c post-3_first clearfix">
                                <div class="entry-media"><a href="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$rdom->idUser}}/{{ $rdom->urlHinh }}" class="prettyPhoto"><img src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$rdom->idUser}}/{{ $rdom->urlHinh }}" style="height: 95px;object-fit: cover;" alt="Foto" class="img-responsive" /></a></div>
                                <div class="entry-main">

                                    <?php
                                    if (Auth::id() != null) { ?>
                                        <div class="entry-header">
                                            <h2 class="entry-title limit-content-2"><a href="{{ url('site/tin/chitiet/' . $rdom->slug_tin) }}">{{ $rdom->TieuDe }}</a></h2>
                                        </div>
                                    <?php } else { ?>
                                        <div class="entry-header">
                                            <h2 class="entry-title limit-content-2"><a href="/login">{{ $rdom->TieuDe }}</a></h2>
                                        </div>
                                    <?php  }
                                    ?>

                                    <div class="entry-meta">
                                        <a href="{{ url('site/tin/theloai/loaitin/' . $rdom->slug_loaitin) }}"><span class="category {{ $classColor }}">{{ $rdom->Ten }}</span></a><span class="entry-meta__item"><i class="icon pe-7s-comment"></i><a href="news_details-1.html" class="entry-meta__link">{{ $rdom->commentNum }}</a></span>
                                    </div>
                                </div>
                            </article>
                            @endforeach


                        </div>
                        <div class="col-md-6">
                            <article class="post post-2 post-2_mod-d clearfix">
                                <div class="entry-media"><a href="http://localhost:8080/php3/nhan/storage/app/public/photos/{{ $ramdom['first']->idUser }}/{{ $ramdom['first']->urlHinh }}" class="prettyPhoto"><img src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{ $ramdom['first']->idUser }}/{{ $ramdom['first']->urlHinh }}" alt="Foto" class="img-responsive" /></a>
                                    <a href="{{ url('site/tin/theloai/loaitin/' . $ramdom['first']->slug_loaitin) }}"><span class="label bg-6">{{ $ramdom['first']->Ten }}</span></a>
                                </div>

                                <?php
                                if (Auth::id() != null) { ?>
                                    <div class="entry-main">
                                        <div class="entry-header">
                                            <a href="{{ url('site/tin/chitiet/' . $ramdom['first']->slug_tin) }}">
                                                <h2 class="entry-title text-uppercase">{{ $ramdom['first']->TieuDe }}</h2>
                                            </a>
                                        </div>
                                        <div class="entry-meta"><span class="entry-meta__item">Bởi
                                                <a href="{{ url('site/profile/user/' . $ramdom['first']->idUser) }}" class="entry-meta__link"> {{ $ramdom['first']->hoten }}</a></span><span class="entry-meta__item"><span href="news_details-1.html" class="entry-meta__link">{{ $ramdom['first']->Ngay }}</span></span><span class="entry-meta__item"><i class="icon pe-7s-comment"></i><span href="news_details-1.html" class="entry-meta__link">{{ $ramdom['first']->commentNum }}</span></span></div>
                                        <div class="entry-content limit-content-3">
                                            <p>{{ $ramdom['first']->TomTat }}</p>
                                        </div>
                                        <div class="entry-footer"><a href="{{ url('site/tin/chitiet/' . $ramdom['first']->slug_tin) }}" class="btn-link">Đọc tiếp</a></div>
                                    </div>
                                <?php } else { ?>
                                    <div class="entry-main">
                                        <div class="entry-header">
                                            <a href="/login">
                                                <h2 class="entry-title text-uppercase">{{ $ramdom['first']->TieuDe }}</h2>
                                            </a>
                                        </div>
                                        <div class="entry-meta"><span class="entry-meta__item">Bởi
                                                <a href="/login" class="entry-meta__link"> {{ $ramdom['first']->hoten }}</a></span><span class="entry-meta__item"><span href="news_details-1.html" class="entry-meta__link">{{ $ramdom['first']->Ngay }}</span></span><span class="entry-meta__item"><i class="icon pe-7s-comment"></i><span href="news_details-1.html" class="entry-meta__link">{{ $ramdom['first']->commentNum }}</span></span></div>
                                        <div class="entry-content limit-content-3">
                                            <p>{{ $ramdom['first']->TomTat }}</p>
                                        </div>
                                        <div class="entry-footer"><a href="/login" class="btn-link">Đọc tiếp</a></div>
                                    </div>
                                <?php  }
                                ?>


                            </article>
                        </div>
                    </div>
                </div>
                <section class="section-type-c wow">
                    <h2 class="ui-title-block" style="line-height: 40px;"><span class="ui-title-block__subtitle">Tin Tức</span><span class="text-uppercase">Bản Tin Mới Nhất</span></h2>
                    @foreach ($lastNewsPage as $lates)
                    @php
                    $classColor = 'bg-' . $loop->index + 1;
                    @endphp
                    <article class="post post-2 post-2_mod-g clearfix">
                        <div class="entry-media">
                            <a href="http://localhost:8080/php3/nhan/storage/app/public/photos/{{ $lates->idUser }}/{{ $lates->urlHinh }}" class="prettyPhoto">
                                <img style="height: 150px;width: 165px !important;object-fit: cover;" src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{ $lates->idUser }}/{{ $lates->urlHinh }}" alt="Foto" class="img-responsive" />
                            </a>



                            <?php
                            if (Auth::id() != null) { ?>
                                <a href="{{ url('site/tin/chitiet/' . $lates->slug_tin) }}"><span class="label {{ $classColor }}">{{ $lates->Ten }}</span></a>
                        </div>
                        <div class="entry-main">
                            <div class="entry-header">
                                <a href="{{ url('site/tin/chitiet/' . $lates->slug_tin) }}">
                                    <h2 class="entry-title text-uppercase limit-content-2">{{ $lates->TieuDe }}
                                    </h2>
                                </a>
                            </div>
                            <div class="entry-meta"><span class="entry-meta__item">Bởi
                                    <a href="{{ url('site/profile/user/' . $lates->idUser) }}" class="entry-meta__link">{{ $lates->hoten }}</a></span><span class="entry-meta__item"><span href="news_details-1.html" class="entry-meta__link">{{ $lates->Ngay }}</span></span><span class="entry-meta__item"><i class="icon pe-7s-comment"></i><span href="news_details-1.html" class="entry-meta__link">{{ $lates->commentNum }}</span></span></div>
                            <div class="entry-content limit-content-2">
                                <p>{{ $lates->TomTat }}</p>
                            </div>
                        </div>
                    <?php } else { ?>
                        <a href="/login"><span class="label {{ $classColor }}">{{ $lates->Ten }}</span></a>
            </div>
            <div class="entry-main">
                <div class="entry-header">
                    <a href="/login">
                        <h2 class="entry-title text-uppercase limit-content-2">{{ $lates->TieuDe }}
                        </h2>
                    </a>
                </div>
                <div class="entry-meta"><span class="entry-meta__item">Bởi
                        <a href="{{ url('site/profile/user/' . $lates->idUser) }}" class="entry-meta__link">{{ $lates->hoten }}</a></span><span class="entry-meta__item"><span href="news_details-1.html" class="entry-meta__link">{{ $lates->Ngay }}</span></span><span class="entry-meta__item"><i class="icon pe-7s-comment"></i><span href="news_details-1.html" class="entry-meta__link">{{ $lates->commentNum }}</span></span></div>
                <div class="entry-content limit-content-2">
                    <p>{{ $lates->TomTat }}</p>
                </div>
            </div>
        <?php  }
        ?>

        </article>
        @endforeach

        <div class="wrap-pagination">
            {{$lastNewsPage->links("pagination::bootstrap-4")}}
        </div>
        </section>
        </div>

        @include('site.right')
    </div>
</div>
</div>
@endsection