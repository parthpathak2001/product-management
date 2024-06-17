<header class="header-area">
    <div class="main-header d-none d-lg-block">
        <div class="header-main-area sticky">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3">
                        <div class="logo">
                            <a href="{{ route('index') }}">
                                <img src="{{ asset('assets/img/favicon.jpg') }}" alt="" height="50px">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="main-menu-area">
                            <div class="main-menu">
                                <nav class="desktop-menu">
                                    <ul>
                                        <li {{ \Request::is('/') ? 'class=active' : '' }}>
                                            <a href="{{ route('index') }}">Home</a>
                                        </li>

                                        <li {{ \Request::is('category/*') ? 'class=active' : '' }}>
                                            @php
                                                $cateories = \App\Models\Category::get(['slug', 'name']);
                                            @endphp
                                            <a href="#">shop <i class="fa fa-angle-down"></i></a>
                                            <ul class="dropdown">
                                                @foreach ($cateories as $category)
                                                    <li>
                                                        <a href="{{ route('product.index', $category->slug) }}" style="{{ \Request::is('category/' . $category->slug) ? 'color: #CC2121' : '' }}">{{ $category->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>

                                        <li {{ \Request::is('image-gallery') || \Request::is('video-gallery') ? 'class=active' : '' }}>
                                            <a href="#">Gallery <i class="fa fa-angle-down"></i></a>
                                            <ul class="dropdown">
                                                <li>
                                                    <a href="{{ route('product.image.gallery') }}" style="{{ \Request::is('image-gallery') ? 'color: #CC2121' : '' }}">Photos</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mobile-header d-lg-none d-md-block sticky">
        <!--mobile header top start -->
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <div class="mobile-main-header">
                        <div class="mobile-logo">
                            <a href="{{ route('index') }}">
                                <img src="{{ asset('assets/img/favicon.jpg') }}" alt="" height="50px">
                            </a>
                        </div>
                        <div class="mobile-menu-toggler">
                            <div class="mobile-menu-btn">
                                <div class="off-canvas-btn">
                                    <i class="lnr lnr-menu"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- mobile header top start -->
    </div>
</header>

<aside class="off-canvas-wrapper">
    <div class="off-canvas-overlay"></div>
    <div class="off-canvas-inner-content">
        <div class="btn-close-off-canvas">
            <i class="lnr lnr-cross"></i>
        </div>
        <div class="off-canvas-inner">
            <div class="mobile-navigation">
                <nav>
                    <ul class="mobile-menu">
                        <li {{ \Request::is('/') ? 'class=active' : '' }}>
                            <a href="{{ route('index') }}">Home</a>
                        </li>

                        <li class="menu-item-has-children " {{ \Request::is('category/*') ? 'class=active' : '' }}>
                            @php
                                $cateories = \App\Models\Category::get(['slug', 'name']);
                            @endphp

                            <a href="#">shop</a>
                            <ul class="dropdown">
                                @foreach ($cateories as $category)
                                    <li>
                                        <a href="{{ route('product.index', $category->slug) }}" style="{{ \Request::is('category/' . $category->slug) ? 'color: #CC2121' : '' }}">{{ $category->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</aside>
