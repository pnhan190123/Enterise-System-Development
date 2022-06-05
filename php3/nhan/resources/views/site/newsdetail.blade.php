@extends('site.layout')

@section('title')
    Chi Tiết Tin
@endsection
<?php 

use Illuminate\Support\Facades\Auth;
?>
@section('main')
    <div class="section-type-k">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <article class="post post-full post-full_mod-a clearfix">
                        <div class="post-full__top-block">
                            <div class="entry-media"><a href="http://localhost:8080/php3/nhan/storage/app/public/photos/{{ $newsDetail->idUser }}/{{ $newsDetail->urlHinh }}"
                                    class="prettyPhoto"><img src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{ $newsDetail->idUser }}/{{ $newsDetail->urlHinh }}" alt="Foto"
                                        class="img-responsive"
                                        style="
                                        height: 400px;
                                        width: 100% !important;
                                        object-fit: cover;"></a></div>
                            <div class="entry-header">
                                
                            <?php
                                                if (Auth::id() != null) { ?>
                                                           <h2 class="entry-title"><a href="{{ url('site/tin/chitiet/' . $newsDetail->slug_tin) }}">{{ $newsDetail->TieuDe }}</a>
                                </h2>
                                                <?php } else { ?>
                                                    <h2 class="entry-title"><a href="/login">{{ $newsDetail->TieuDe }}</a>
                                </h2>
                                                <?php  }
                                                ?>
                             
                                <div class="entry-meta"><span class="entry-meta__item">Bởi
                                   <a style="color: white" href="{{ url('site/profile/user/' . $newsDetail->idUser) }}">{{ $newsDetail->hoten }}</a></span><span
                                        class="entry-meta__item"><span class="entry-meta__link">{{ $newsDetail->Ngay }}</span></span><span class="entry-meta__item"><i
                                            class="icon pe-7s-comment"></i><span
                                            class="entry-meta__link">{{ $newsDetail->commentNum }}</span></span></div>
                            </div>
                            <a href="{{ url('site/tin/theloai/' . $newsDetail->slug_theloai) }}">
                                <span class="label bg-3">{{ $newsDetail->TenTL }}</span>
                            </a>
                            <a href="{{ url('site/tin/theloai/loaitin/' . $newsDetail->slug_loaitin) }}">
                                <span class="label bg-5">{{ $newsDetail->Ten }}</span>
                            </a>
                        </div>
                    </article>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <article class="post post-full post-full_mod-a clearfix">
                        <div class="entry-main">
                            <div class="entry-content">
                                <div class="blockquote-wrap">
                                    <div class="decor-left"></div>
                                    <blockquote class="blockquote blockquote_mod-a">
                                        <p>{{ $newsDetail->TomTat }}</p>
                                        <footer>
                                            <cite title="Blockquote Title"><span class="blockquote__author">{{ $newsDetail->hoten }}</span></cite>
                                        </footer>
                                    </blockquote>
                                    <div class="decor-right"></div>
                                </div>
                                <?= $newsDetail->Content ?>
                            </div>
                            <div class="entry-footer clearfix">
                                <div class="post-tags">
                                    <span class="post-tags__title">tags :</span>
                                    @for ($i = 0; $i < count($newsDetail->tags); $i++)
                                        <a href="{{ url('site/tin/tags/' . $newsDetail->tags[$i]) }}" class="post-tags__link"> {{ $newsDetail->tags[$i] }} {{ $i >= count($newsDetail->tags) - 1 ? "" : "," }}</a>
                                    @endfor

                                </div>
                                <div class="post-tags float-end" style="float: right">
                                    <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&width=150&layout=button_count&action=like&size=small&share=true&height=46&appId=1259082827813860" width="170px" height="46" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                                </div>
                                {{-- <ul class="social-links social-links_mod-a list-inline">
                                    <li class="bg-14"><a href="facebook.com" class="social-links__item_link"><i
                                                class="icon fa fa-facebook"></i></a></li>
                                    <li class="bg-15"><a href="twitter.com" class="social-links__item_link"><i
                                                class="icon fa fa-twitter"></i></a></li>
                                    <li class="bg-16"><a href="plus.google.com" class="social-links__item_link"><i
                                                class="icon fa fa-google-plus"></i></a></li>
                                    <li class="bg-17"><a href="instagram.com" class="social-links__item_link"><i
                                                class="icon fa fa-instagram"></i></a></li>
                                    <li class="bg-18"><a href="rss.com" class="social-links__item_link"><i
                                                class="icon fa fa-rss"></i></a></li>
                                    <li class="bg-19"><a href="pinterest.com" class="social-links__item_link"><i
                                                class="icon fa fa-pinterest-p"></i></a></li>
                                    <li class="bg-20"><a href="mail.com" class="social-links__item_link"><i
                                                class="icon fa fa-envelope-o"></i></a></li>
                                </ul> --}}
                            </div>
                        </div>
                    </article>
                    {{-- <article class="author-post clearfix">
                        <div class="author-post__img"><img src="assets/media/content/post/author/1.jpg" alt="foto"
                                class="img-responsive"></div>
                        <div class="author-post__inner">
                            <h2 class="author-post__title">Authoor:<span class="author-post__name"> samir hasman</span></h2>
                            <div class="author-post__info">Tempor incididunt labore et dolore magna aliqua enimad min veniam
                                saquis nostru exercitation ullamco laboris onsequat lorem ipsum dolor tasit amet consect
                                elit sed eiusmod incididunt labore et dolore magna aliquipsum.</div>
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
                                            class="icon fa fa-youtube-play"></i></a></li>
                            </ul>
                        </div>
                    </article> --}}
                    <section class="section-comment">
                        <h3 class="comment-title ui-title-inner ui-title-inner_spacing_sm">Bình luận :<span
                                class="comment-title__number"> {{ $newsDetail->commentNum }}</span></h3>
                        <div class="decor-left"></div>
                        <ul class="comments-list list-unstyled">
                            @foreach ($newsDetail->comment as $comment)
                            <li>
                                <article class="comment clearfix">
                                    <div class="avatar-placeholder">
                                        <img src="assets/media/content/post/reviews/3.jpg"
                                            alt="avatar" class="img-responsive">
                                        </div>
                                    <div class="comment-inner">
                                        <header class="comment-header">
                                            <cite class="comment-author"><a  href="{{ url('site/profile/user/' . $comment->idUser) }}"> {{ $comment->hoten }}</a></cite>
                                            <time datetime="2012-10-27" class="comment-datetime">{{ $comment->Ngay }}</time>
                                        </header>
                                        <div class="comment-body">
                                            <p>{{ $comment->NoiDung }}.</p>
                                        </div>
                                        <footer class="comment-footer"><a href="home.html"
                                                class="comment-btn btn btn-default btn-effect">Thích</a></footer>
                                    </div>
                                </article>
                            </li>
                            @endforeach
                        </ul>
                    </section>
                    <section class="section-reply-form">
                        <h3 class="comment-title ui-title-inner ui-title-inner_spacing_sm">Để lại ý kiến</h3>
                        <div class="decor-left"></div>
                        <form action="{{ url('/site/comment') }}" method="post" class="form-reply ui-form">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col-xs-12">
                                    <input type="hidden" name="idTin" value="{{ $newsDetail->idTin }}">
                                    <textarea rows="5" placeholder="Nội dung" required name="noidung" style="text-transform: none;" class="form-control"></textarea>
                                    @error('noidung')
                                        <span class="invalid-feedback d-block mb-3" style="display: block;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    @auth
                                    {{-- The user is login... --}}
                                    <button class="ui-form__btn btn btn-xs btn-info btn-effect d-block" type="submit">Bình luận</button>
                                    @endauth

                                    @guest
                                    {{-- The user is not login... --}}
                                        <button class="ui-form__btn btn btn-xs btn-info btn-effect d-block"><a href="/login">Đăng nhập</a></button>
                                    @endguest
                                </div>
                            </div>
                        </form>
                    </section>
                </div>

                @include('site.right')

            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section-default">
                    <h2 class="ui-title-block ui-title-block_border">
                        <span class="ui-title-block__subtitle">Đọc thêm
                        </span>
                        <span class="text-uppercase">Bài viết liên quan</span>
                    </h2>
                    <div data-min480="1" data-min768="2" data-min992="2" data-min1200="3" data-pagination="false"
                        data-navigation="true" data-auto-play="4000" data-stop-on-hover="true"
                        class="owl-carousel owl-theme owl-theme_mod-e enable-owl-carousel">
                        @foreach ($newsDetail->newsRelated as $newsRelated)
                        <article class="post post-2 post-2_mod-h clearfix">
                            <div class="entry-media">
                                <a href="http://localhost:8080/php3/nhan/storage/app/public/photos/{{ $newsRelated->idUser }}/{{ $newsRelated->urlHinh }}" class="prettyPhoto">
                                    <img src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{ $newsRelated->idUser }}/{{ $newsRelated->urlHinh }}" style="height: 200px;object-fit: cover;" alt="Foto" class="img-responsive" />
                                </a>
                                <a href="{{ url('site/tin/theloai/loaitin/' . $newsRelated->slug_loaitin) }}"><span class="label bg-10">{{ $newsRelated->Ten }}</span></a>
                            </div>
                            <div class="entry-main">
                                <div class="entry-header">
                                    
                                <?php
                                                if (Auth::id() != null) { ?>
                                                        <a href="{{ url('site/tin/chitiet/' . $newsRelated->slug_tin) }}"><h2 class="limit-content-2 entry-title text-uppercase">{{ $newsRelated->TieuDe }}
                                    </h2></a>
                                                <?php } else { ?>
                                                    <a href="/login"><h2 class="limit-content-2 entry-title text-uppercase">{{ $newsRelated->TieuDe }}
                                    </h2></a>
                                                <?php  }
                                                ?>
                                    
                                </div>
                                <div class="entry-meta">
                                    <span class="entry-meta__item">Bởi
                                        <a  href="{{ url('site/profile/user/' . $newsRelated->idUser) }}" class="entry-meta__link"> {{ $newsRelated->hoten }}</a>
                                    </span>
                                    <span class="entry-meta__item">
                                        <span href="news_details-1.html" class="entry-meta__link">{{ $newsRelated->Ngay }}</span>
                                    </span>
                                    <span class="entry-meta__item">
                                        <i class="icon pe-7s-comment"></i>
                                        <span href="news_details-1.html" class="entry-meta__link">{{ $newsRelated->commentNum }}</span>
                                    </span>
                                </div>
                            </div>
                        </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
