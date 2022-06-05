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
                                <input type="text" placeholder="Tìm kiếm" name="keyword" autocomplete="off" name="s" value="" class="search-global__input" />
                                <button class="search-global__btn" type="submit"><i class="icon fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="search-close close"><i class="fa fa-times"></i></button>
        </div>
    </nav>
    <div class="section-title section-bg" style="padding: 0px 300px;">
        <div class="section__inner">
            <h1 class="ui-title-page" style="letter-spacing: 0px; line-height: 45px;">{{ $TieuDe_ }}</h1>
        </div>
    </div>
</div>
<div class="breadcrumb-wrap">
    <ol class="breadcrumb">
        <li><a href="{{ url('site/') }}">Trang chủ</a></li>
        @for ($i = 0; $i < count($pages); $i++) 
            @if ($pages[$i]['link'] !=false)
                 <li><a href="{{ url($pages[$i]['link'] . $pages[$i]['id']) }}">{{ $pages[$i]['ten'] }}</a></li>
            @else
                <li class="active">{{ $pages[$i]['ten'] }}</li>
            @endif
            @endfor
            {{-- <li><a href="category.html">lifestyle</a></li>
        <li class="active">news in details</li> --}}
    </ol>
</div>