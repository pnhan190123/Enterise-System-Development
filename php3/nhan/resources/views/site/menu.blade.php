<?php 

use Illuminate\Support\Facades\Auth;
?>
<div id="navbar-collapse-1" class="navbar-collapse collapse">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <ul class="nav navbar-nav">
                    <li><a href="/site">Trang Chủ</a>
                    </li>

                    @foreach ($menuMain as $menuMainItem)
                        @if ($loop->index < 8)
                            @if (count($menuMainItem->newsFirst) > 0 && count($menuMainItem->newsNext) > 2)

                            <li class="yamm-fw"><a href="{{ url('site/tin/theloai/' . $menuMainItem->slug_theloai) }}">{{ $menuMainItem->TenTL }}</a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <div class="yamm-content">
                                            <div class="row">
                                                <div class="col-md-4 col-sm-6">
                                                    @foreach ($menuMainItem->newsFirst as $newsFirstItem)
                                                    <article class="post post-4 post-4_mod-a clearfix">
                                                        <div class="entry-media">
                                                            <a href="http://localhost:8080/php3/nhan/storage/app/public/photos/{{ $newsFirstItem->idUser }}/{{ $newsFirstItem->urlHinh }}" class="prettyPhoto">
                                                                <img src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{ $newsFirstItem->idUser }}/{{ $newsFirstItem->urlHinh }}" alt="" style="height: 280px;" class="img-responsive" />
                                                            </a>
                                                        </div>
                                                        <div class="entry-main">
                                                            <div class="entry-header">
                                                                
                                            <?php
                                                if (Auth::id() != null) { ?>
                                                    <a href="{{ url('site/tin/chitiet/' . $newsFirstItem->slug_tin) }}"><h2 class="entry-title limit-content-2">{{ $newsFirstItem->TieuDe }}</h2></a>

                                                <?php } else { ?>
                                                    <a href="/login"><h2 class="entry-title limit-content-2">{{ $newsFirstItem->TieuDe }}</h2></a>

                                                <?php  }
                                                ?>
                                                            </div>
                                                            <div class="entry-meta"><span class="entry-meta__item"><a
                                                                        href="news_details-1.html"
                                                                        class="entry-meta__link">{{ $newsFirstItem->Ngay }}</a></span><span class="entry-meta__item"><i
                                                                        class="icon pe-7s-comment"></i><a
                                                                        href="news_details-1.html"
                                                                        class="entry-meta__link">62</a></span></div>
                                                        </div>
                                                    </article>
                                                    @endforeach
                                                </div>
                                                <div class="col-md-4 col-xs-12">
                                                    @foreach ($menuMainItem->newsNext as $newsNextItem)
                                                    <article class="post post-3 post-3_mod-f clearfix">
                                                        <div class="entry-media">
                                                            <a href="http://localhost:8080/php3/nhan/storage/app/public/photos/{{ $newsNextItem->idUser }}/{{ $newsNextItem->urlHinh }}" class="prettyPhoto">
                                                                <img style="height: 79px; width: 100%; object-fit: cover;" src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{ $newsNextItem->idUser }}/{{ $newsNextItem->urlHinh }}" alt="" class="img-responsive" />
                                                            </a>
                                                        </div>
                                                        <div class="entry-main">
                                                            
                                            <?php
                                                if (Auth::id() != null) { ?>
                                                         <div class="entry-header">
                                                                <h2 class="entry-title limit-content-2"><a class=""
                                                                        href="{{ url('site/tin/chitiet/' . $newsNextItem->slug_tin) }}">{{ $newsNextItem->TieuDe }}</a></h2>
                                                            </div>
                                                <?php } else { ?>
                                                    <div class="entry-header">
                                                                <h2 class="entry-title limit-content-2"><a class=""
                                                                        href="/login">{{ $newsNextItem->TieuDe }}</a></h2>
                                                            </div>
                                                <?php  }
                                                ?>
                                                           
                                                            <div class="entry-meta">
                                                                <a href="{{ url('site/tin/theloai/loaitin/' . $newsNextItem->slug_loaitin) }}">
                                                                    <span class="category color-4">{{ $newsNextItem->Ten }}</span>
                                                                </a>
                                                                <span class="entry-meta__item"><i
                                                                        class="icon pe-7s-comment"></i><a
                                                                        href="news_details-1.html"
                                                                        class="entry-meta__link">4</a></span></div>
                                                        </div>
                                                    </article>

                                                    @endforeach
                                                </div>
                                                <div class="col-md-4 col-sm-6">
                                                    <ul class="list list-mark-1 list-mark-1_mod-a">
                                                        @foreach ($menuMainItem->kinds as $kind)
                                                        <li><a href="{{ url('site/tin/theloai/loaitin/' . $kind->slug_loaitin) }}">{{ $kind->Ten }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            @endif
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
