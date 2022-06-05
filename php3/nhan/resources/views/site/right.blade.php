<?php 

use Illuminate\Support\Facades\Auth;
?>
<div class="col-md-4">
    <aside class="sidebar">
        <div class="widget">
            <form id="search-global-form" method="get" class="form-search">
                <div class="form-group has-feedback">
                    <input type="text" placeholder="Tìm kiếm bất kỳ" class="form-search__input form-control">
                    <button class="form-search__btn icon pe-7s-search form-control-feedback"></button>
                </div>
            </form>
        </div>
        {{-- <section class="widget">
            <h2 class="widget-title ui-title-inner text-right">follow us</h2>
            <div class="decor-right"></div>
            <div class="widget-content">
                <ul class="list-subscription list-unstyled">
                    <li class="list-subscription__item bg-11"><span class="list-subscription__name">Rss</span><span
                            class="list-subscription__number">164.983</span> followers<a href="rss.com"
                            class="list-subscription__link"><i class="icon fa fa-rss"></i></a></li>
                    <li class="list-subscription__item bg-8"><span class="list-subscription__name">TW</span><span
                            class="list-subscription__number">714,967</span> followers<a href="twitter.com"
                            class="list-subscription__link"><i class="icon fa fa-twitter"></i></a></li>
                    <li class="list-subscription__item bg-9"><span class="list-subscription__name">FB</span><span
                            class="list-subscription__number">250,642</span> likes<a href="facebook.com"
                            class="list-subscription__link"><i class="icon fa fa-facebook"></i></a></li>
                    <li class="list-subscription__item bg-10"><span class="list-subscription__name">yt</span><span
                            class="list-subscription__number">920,497</span> subscribers<a href="youtube.com"
                            class="list-subscription__link"><i class="icon fa fa-youtube-play"></i></a></li>
                </ul>
            </div>
        </section> --}}
        {{-- <section class="widget">
            <h2 class="widget-title ui-title-inner text-right">categories</h2>
            <div class="decor-right"></div>
            <div class="widget-content">
                <ul class="list list-mark-1 list-mark-1_mod-a">
                    <li><a href="category.html">fashion & lifestyle</a></li>
                    <li><a href="category.html">World politics</a></li>
                    <li><a href="category.html">entertainment News</a></li>
                    <li><a href="category.html">music & videos</a></li>
                    <li><a href="category.html">fun & funny moments</a></li>
                </ul>
            </div>
        </section> --}}
        <section class="widget">
            <h2 class="widget-title ui-title-inner text-right">Nhiều lượt xem</h2>
            <div class="decor-right"></div>
            <div class="widget-content">
                @foreach ($tinXemNhieu as $tin)
                    @php
                        $classColor = 'color-' . $loop->index + 2;
                    @endphp
                    <article class="post post-3 post-3_mod-a clearfix">
                        <div class="entry-media"><a href="http://localhost:8080/php3/nhan/storage/app/public/photos/{{ $tin->idUser }}/{{ $tin->urlHinh }}" class="prettyPhoto">
                            <img style="height: 98px;" src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{ $tin->idUser}}/{{ $tin->urlHinh }}" alt="Foto" class="img-responsive" /></a>
                        </div>
                        <div class="entry-main">
                            <div class="entry-header">
                                
                            <?php
                                                if (Auth::id() != null) { ?>
                                                         <h2 class="entry-title limit-content-2">
                                    <a href="{{ url('site/tin/chitiet/' . $tin->slug_tin) }}">
                                        {{ $tin->TieuDe }}-
                                    </a>
                                </h2>
                                                <?php } else { ?>
                                                    <h2 class="entry-title limit-content-2">
                                    <a href="/login">
                                        {{ $tin->TieuDe }}-
                                    </a>
                                </h2>
                                                <?php  }
                                                ?>
                               
                            </div>
                            <div class="entry-meta">
                                <a href="{{ url('site/tin/theloai/loaitin/' . $tin->slug_loaitin) }}"><span class="category {{ $classColor }}">{{ $tin->Ten }}</span></a>
                                <span class="entry-meta__item"  style="float: right;">
                                    <i class="icon pe-7s-comment"></i>
                                    <span href="news_details-1.html"
                                        class="entry-meta__link">{{ $tin->commentNum }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
     
        <?php 
                $tmp = DB::select('SELECT * FROM `quangcao`where role_quangcao = 2 ORDER BY(id_quangcao) ASC LIMIT 1');
        
        ?>
        @foreach($tmp as $value)
        <div class="widget"><a href="home.html" class="banner"><img src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{$value->idUser}}/{{$value->urlHinh}}"
                    alt="banner" class="img-responsive center-block"></a></div>
        @endforeach
        <section class="widget">
            <h2 class="widget-title ui-title-inner text-right">Nhận thông tín sớm nhất</h2>
            <div class="decor-right"></div>
            <div class="widget-content">
                <p>Đăng ký nhận bản tin của chúng tôi để nhận tin tức mới nhất khi có trong hộp thư đến của bạn.</p>
                <form class="form-subscribe">
                    <div class="form-group has-feedback">
                        <input type="email" placeholder="Email của bạn" class="form-control">
                        <button class="icon pe-7s-mail form-control-feedback"></button>
                    </div>
                </form>
            </div>
        </section>
        <section class="widget">
            <h2 class="widget-title ui-title-inner text-right">Ngày Mới Express</h2>
            <div class="decor-right"></div>
            <div class="widget-content">
                <ul class="nav nav-tabs nav-tabs_sm nav-tabs_primary">
                    <li class="active"><a href="#tab-2-1" data-toggle="tab">Tuần trước</a></li>
                    <li><a href="#tab-2-2" data-toggle="tab">Tin nổi bật</a></li>
                    <li><a href="#tab-2-3" data-toggle="tab">Top đánh giá</a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-2-1" class="tab-pane fade in active">
                        @foreach ($newsLastWeek as $news)
                        @php
                            $classColor = 'color-' . $loop->index + 2;
                        @endphp
                            <article class="post post-3 post-3_mod-e clearfix">
                                <div class="entry-media">
                                    <a href="http://localhost:8080/php3/nhan/storage/app/public/photos/{{ $news->idUser }}/{{ $news->urlHinh }}"
                                        class="prettyPhoto">
                                        <img style="height: 98px;" src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{ $news->idUser }}/{{ $news->urlHinh }}" alt="Foto" class="img-responsive" />
                                    </a>
                                </div>
                                <div class="entry-main">
                                    <div class="entry-header">
                                        
                                    <?php
                                                if (Auth::id() != null) { ?>
                                                           <h2 class="entry-title  limit-content-2">
                                            <a href="{{ url('site/tin/chitiet/' . $news->slug_tin) }}">{{ $news->TieuDe }}
                                            </a>
                                        </h2>
                                                <?php } else { ?>
                                                    <h2 class="entry-title  limit-content-2">
                                            <a href="/login">{{ $news->TieuDe }}
                                            </a>
                                        </h2>
                                                <?php  }
                                                ?>
                                     
                                    </div>
                                    <div class="entry-meta">
                                        <a href="{{ url('site/tin/theloai/loaitin/' . $news->slug_loaitin) }}" class="entry-meta__link"><span class="category {{ $classColor }}">{{ $news->Ten }}</span></a>
                                        <span class="entry-meta__item">
                                            <i class="icon pe-7s-comment"></i>
                                            <span href="news_details-1.html" class="entry-meta__link">{{ $news->commentNum }}</span>
                                        </span>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                    <div id="tab-2-2" class="tab-pane fade">
                        @foreach ($hotNews as $hot)
                        @php
                            $classColor = 'color-' . $loop->index + 2;
                        @endphp
                        <article class="post post-3 post-3_mod-e clearfix">
                            <div class="entry-media">
                                <a href="http://localhost:8080/php3/nhan/storage/app/public/photos/{{ $hot->idUser }}/{{ $hot->urlHinh }}"
                                    class="prettyPhoto">
                                    <img style="height: 98px;" src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{ $hot->idUser }}/{{ $hot->urlHinh }}" alt="Foto" class="img-responsive" />
                                </a>
                            </div>
                            <div class="entry-main">
                                <div class="entry-header">
                                    
                                <?php
                                                if (Auth::id() != null) { ?>
                                                        <h2 class="entry-title  limit-content-2">
                                        <a href="{{ url('site/tin/chitiet/' . $hot->slug_tin) }}">{{ $hot->TieuDe }}
                                        </a>
                                    </h2>
                                                <?php } else { ?>
                                                    <h2 class="entry-title  limit-content-2">
                                        <a href="/login">{{ $hot->TieuDe }}
                                        </a>
                                    </h2>
                                                <?php  }
                                                ?>
                                    
                                </div>
                                <div class="entry-meta">
                                    <a href="{{ url('site/tin/theloai/loaitin/' . $hot->slug_loaitin) }}" class="entry-meta__link"><span class="category {{ $classColor }}">{{ $hot->Ten }}</span></a>
                                    <span class="entry-meta__item">
                                        <i class="icon pe-7s-comment"></i>
                                        <span href="news_details-1.html" class="entry-meta__link">{{ $hot->commentNum }}</span>
                                    </span>
                                </div>
                            </div>
                        </article>
                        @endforeach
                    </div>
                    <div id="tab-2-3" class="tab-pane fade">
                        @foreach ($topRatedNews as $rated)
                        @php
                            $classColor = 'color-' . $loop->index + 2;
                        @endphp
                        <article class="post post-3 post-3_mod-e clearfix">
                            <div class="entry-media">
                                <a href="http://localhost:8080/php3/nhan/storage/app/public/photos/{{ $rated->idUser }}/{{ $rated->urlHinh }}"
                                    class="prettyPhoto">
                                    <img style="height: 98px;" src="http://localhost:8080/php3/nhan/storage/app/public/photos/{{ $rated->idUser }}/{{ $rated->urlHinh }}" alt="Foto" class="img-responsive" />
                                </a>
                            </div>
                            <div class="entry-main">
                                <div class="entry-header">
                                    
                                <?php
                                                if (Auth::id() != null) { ?>
                                                          <h2 class="entry-title  limit-content-2">
                                        <a href="{{ url('site/tin/chitiet/' . $rated->slug_tin) }}">{{ $rated->TieuDe }}
                                        </a>
                                    </h2>
                                                <?php } else { ?>
                                                    <h2 class="entry-title  limit-content-2">
                                        <a href="/login">{{ $rated->TieuDe }}
                                        </a>
                                    </h2>
                                                <?php  }
                                                ?>
                                  
                                </div>
                                <div class="entry-meta">
                                    <a href="{{ url('site/tin/theloai/loaitin/' . $rated->slug_loaitin) }}" class="entry-meta__link"><span class="category {{ $classColor }}">{{ $rated->Ten }}</span></a>
                                    <span class="entry-meta__item">
                                        <i class="icon pe-7s-comment"></i>
                                        <span href="news_details-1.html" class="entry-meta__link">{{ $rated->commentNum }}</span>
                                    </span>
                                </div>
                            </div>
                        </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </aside>
</div>
