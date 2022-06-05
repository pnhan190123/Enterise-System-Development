<nav id="cd-nav" class="cd-nav-container"><a href="#0" class="cd-close-nav">Đóng</a>
    <nav class="sidebar-nav">
        <ul class="sidebar-nav__list list-unstyled">

            @foreach ($menuHide as $nav)
            <li><a href="{{ url('site/tin/theloai/' . $nav->slug_theloai) }}" data-toggle="dropdown">{{ $nav->TenTL }}</a>
                <ul role="menu" class="dropdown-menu">
                    <li>
                        <ul class="list list-mark-1 list-mark-1_mod-a">
                            @foreach ($nav->kinds as $kind)
                                <li><a href="{{ url('site/tin/theloai/loaitin/' . $kind->slug_loaitin) }}">{{ $kind->Ten }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
            </li>
            @endforeach


        </ul>
    </nav>
    <!-- end layout-theme-->



</nav>
