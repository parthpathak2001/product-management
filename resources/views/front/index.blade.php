@extends('front.layouts.master')
@section('content')
    <main>
        <section class="slider-area">
            <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
                <div class="hero-single-slide ">
                    <div class="hero-slider-item bg-img" data-bg="assets/img/slider/Banner-1.png">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="hero-slider-content slide-1">
                                        <h4>sale offer 10% off this week</h4>
                                        <h1>canvas cross back</h1>
                                        <h2>apron collection</h2>
                                        <a href="{{ route('index') }}" class="btn-hero">read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hero-single-slide">
                    <div class="hero-slider-item bg-img" data-bg="assets/img/slider/Banner-2.png">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="hero-slider-content slide-2">
                                        <h4>sale offer 20% off this week</h4>
                                        <h1>serving dishes</h1>
                                        <h2>& mugs</h2>
                                        <a href="{{ route('index') }}" class="btn-hero">read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hero-single-slide">
                    <div class="hero-slider-item bg-img" data-bg="assets/img/slider/Banner-3.png">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="hero-slider-content slide-3">
                                        <h4>sale offer 50% off this week</h4>
                                        <h1>linen oven gloves</h1>
                                        <h2>in the kitchen</h2>
                                        <a href="{{ route('index') }}" class="btn-hero">read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="service-policy-area section-space pb-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-6">
                        <div class="service-policy-item">
                            <div class="icons">
                                <img src="assets/img/icon/free_shipping.png" alt="">
                            </div>
                            <h5>free shipping</h5>
                            <p>Free shipping all order</p>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="service-policy-item">
                            <div class="icons">
                                <img src="assets/img/icon/money_back.png" alt="">
                            </div>
                            <h5>Money Return</h5>
                            <p>30 days for free return</p>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="service-policy-item">
                            <div class="icons">
                                <img src="assets/img/icon/support247.png" alt="">
                            </div>
                            <h5>Online Support</h5>
                            <p>Support 24 hours a day</p>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="service-policy-item">
                            <div class="icons">
                                <img src="assets/img/icon/promotions.png" alt="">
                            </div>
                            <h5>Deals & Promotions</h5>
                            <p>Price savings, discounts</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="trending-products section-space">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <h2>New Trending Products</h2>
                            <p>Accumsan vitae pede lacus ut ullamcorper sollicitudin quisque libero</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="product-carousel--4 slick-row-15 slick-sm-row-10 slick-arrow-style">
                            @foreach ($products as $product)
                                @php
                                    $image1 = '';
                                    $image2 = '';
                                @endphp

                                @if (isset($product->images))
                                    @if (isset($product->images[0]) && \File::exists(public_path('uploads/products/' . $product->images[0]->image)))
                                        @php
                                            $image1 = asset('uploads/products/' . $product->images[0]->image);
                                        @endphp
                                    @endif

                                    @if (isset($product->images[1]) && \File::exists(public_path('uploads/products/' . $product->images[1]->image)))
                                        @php
                                            $image2 = asset('uploads/products/' . $product->images[1]->image);
                                        @endphp
                                    @elseif (isset($product->images[0]) && \File::exists(public_path('uploads/products/' . $product->images[0]->image)))
                                        @php
                                            $image2 = asset('uploads/products/' . $product->images[0]->image);
                                        @endphp
                                    @endif
                                @endif

                                <div class="product-item">
                                    <figure class="product-thumb">
                                        <a
                                            href="{{ route('product.detail', ['category' => $product->category->slug, 'slug' => $product->slug]) }}">
                                            <img class="pri-img" src="{{ $image1 }}" alt="product">
                                            <img class="sec-img" src="{{ $image2 }}" alt="product">
                                        </a>

                                        @if (\Carbon\Carbon::now() <= $product->created_at->addMonth())
                                            <div class="product-badge">
                                                <div class="product-label new">
                                                    <span>new</span>
                                                </div>
                                            </div>
                                        @endif
                                    </figure>

                                    <div class="product-caption">
                                        <div class="product-identity">
                                            <p class="manufacturer-name">
                                                <a href="{{ route('index') }}">{{ env('APP_NAME') }}</a>
                                            </p>
                                        </div>
                                        <p class="product-name">
                                            <a
                                                href="{{ route('product.detail', ['category' => $product->category->slug, 'slug' => $product->slug]) }}">{{ $product->name }}</a>
                                        </p>

                                        <div class="price-box">
                                            <span class="price-regular">{{ '$' . number_format($product->price, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="our-product section-space pt-0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <h2>our Products</h2>
                            <p>Accumsan vitae pede lacus ut ullamcorper sollicitudin quisque libero</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    {{-- <div class="col-12">
                        <div class="tab-menu">
                            <ul class="nav justify-content-center">
                                <li><a data-bs-toggle="tab" class="active" href="#one">{{ $categories[0]->name }}</a>
                                </li>
                                <li><a data-bs-toggle="tab" href="#two">{{ $categories[1]->name }}</a></li>
                                <li><a data-bs-toggle="tab" href="#three">{{ $categories[2]->name }}</a></li>
                            </ul>
                        </div>

                        <div class="product-container">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="one">
                                    <div class="product-carousel-wrapper">
                                        <div class="product-carousel--4_2 slick-row-15 slick-sm-row-10 slick-arrow-style">
                                            @forelse ($cat1_products as $product)
                                                @php
                                                    $image1 = '';
                                                    $image2 = '';
                                                @endphp

                                                @if (isset($product->images))
                                                    @if (isset($product->images[0]) && \File::exists(public_path('uploads/products/' . $product->images[0]->image)))
                                                        @php
                                                            $image1 = asset('uploads/products/' . $product->images[0]->image);
                                                        @endphp
                                                    @endif

                                                    @if (isset($product->images[1]) && \File::exists(public_path('uploads/products/' . $product->images[1]->image)))
                                                        @php
                                                            $image2 = asset('uploads/products/' . $product->images[1]->image);
                                                        @endphp
                                                    @elseif (isset($product->images[0]) && \File::exists(public_path('uploads/products/' . $product->images[0]->image)))
                                                        @php
                                                            $image2 = asset('uploads/products/' . $product->images[0]->image);
                                                        @endphp
                                                    @endif
                                                @endif

                                                <div class="product-item">
                                                    <figure class="product-thumb">
                                                        <a
                                                            href="{{ route('product.detail', ['category' => $product->category->slug, 'slug' => $product->slug]) }}">
                                                            <img class="pri-img" src="{{ $image1 }}"
                                                                alt="product">
                                                            <img class="sec-img" src="{{ $image2 }}"
                                                                alt="product">
                                                        </a>

                                                        @if (\Carbon\Carbon::now() <= $product->created_at->addMonth())
                                                            <div class="product-badge">
                                                                <div class="product-label new">
                                                                    <span>new</span>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </figure>

                                                    <div class="product-caption">
                                                        <div class="product-identity">
                                                            <p class="manufacturer-name">
                                                                <a href="{{ route('index') }}">{{ env('APP_NAME') }}</a>
                                                            </p>
                                                        </div>

                                                        <p class="product-name">
                                                            <a
                                                                href="{{ route('product.detail', ['category' => $product->category->slug, 'slug' => $product->slug]) }}">{{ $product->name }}</a>
                                                        </p>

                                                        <div class="price-box">
                                                            <span
                                                                class="price-regular">{{ '$' . number_format($product->price, 2) }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div>Product not found in this Category.</div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="two">
                                    <div class="product-carousel-wrapper">
                                        <div class="product-carousel--4_2 slick-row-15 slick-sm-row-10 slick-arrow-style">
                                            @forelse ($cat2_products as $product)
                                                @php
                                                    $image1 = '';
                                                    $image2 = '';
                                                @endphp

                                                @if (isset($product->images))
                                                    @if (isset($product->images[0]) && \File::exists(public_path('uploads/products/' . $product->images[0]->image)))
                                                        @php
                                                            $image1 = asset('uploads/products/' . $product->images[0]->image);
                                                        @endphp
                                                    @endif

                                                    @if (isset($product->images[1]) && \File::exists(public_path('uploads/products/' . $product->images[1]->image)))
                                                        @php
                                                            $image2 = asset('uploads/products/' . $product->images[1]->image);
                                                        @endphp
                                                    @elseif (isset($product->images[0]) && \File::exists(public_path('uploads/products/' . $product->images[0]->image)))
                                                        @php
                                                            $image2 = asset('uploads/products/' . $product->images[0]->image);
                                                        @endphp
                                                    @endif
                                                @endif

                                                <div class="product-item">
                                                    <figure class="product-thumb">
                                                        <a
                                                            href="{{ route('product.detail', ['category' => $product->category->slug, 'slug' => $product->slug]) }}">
                                                            <img class="pri-img" src="{{ $image1 }}"
                                                                alt="product">
                                                            <img class="sec-img" src="{{ $image2 }}"
                                                                alt="product">
                                                        </a>

                                                        @if (\Carbon\Carbon::now() <= $product->created_at->addMonth())
                                                            <div class="product-badge">
                                                                <div class="product-label new">
                                                                    <span>new</span>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </figure>

                                                    <div class="product-caption">
                                                        <div class="product-identity">
                                                            <p class="manufacturer-name">
                                                                <a href="{{ route('index') }}">{{ env('APP_NAME') }}</a>
                                                            </p>
                                                        </div>

                                                        <p class="product-name">
                                                            <a
                                                                href="{{ route('product.detail', ['category' => $product->category->slug, 'slug' => $product->slug]) }}">{{ $product->name }}</a>
                                                        </p>

                                                        <div class="price-box">
                                                            <span
                                                                class="price-regular">{{ '$' . number_format($product->price, 2) }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div>Product not found in this Category.</div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="three">
                                    <div class="product-carousel-wrapper">
                                        <div class="product-carousel--4_2 slick-row-15 slick-sm-row-10 slick-arrow-style">
                                            @forelse ($cat3_products as $product)
                                                @php
                                                    $image1 = '';
                                                    $image2 = '';
                                                @endphp

                                                @if (isset($product->images))
                                                    @if (isset($product->images[0]) && \File::exists(public_path('uploads/products/' . $product->images[0]->image)))
                                                        @php
                                                            $image1 = asset('uploads/products/' . $product->images[0]->image);
                                                        @endphp
                                                    @endif

                                                    @if (isset($product->images[1]) && \File::exists(public_path('uploads/products/' . $product->images[1]->image)))
                                                        @php
                                                            $image2 = asset('uploads/products/' . $product->images[1]->image);
                                                        @endphp
                                                    @elseif (isset($product->images[0]) && \File::exists(public_path('uploads/products/' . $product->images[0]->image)))
                                                        @php
                                                            $image2 = asset('uploads/products/' . $product->images[0]->image);
                                                        @endphp
                                                    @endif
                                                @endif

                                                <div class="product-item">
                                                    <figure class="product-thumb">
                                                        <a
                                                            href="{{ route('product.detail', ['category' => $product->category->slug, 'slug' => $product->slug]) }}">
                                                            <img class="pri-img" src="{{ $image1 }}"
                                                                alt="product">
                                                            <img class="sec-img" src="{{ $image2 }}"
                                                                alt="product">
                                                        </a>

                                                        @if (\Carbon\Carbon::now() <= $product->created_at->addMonth())
                                                            <div class="product-badge">
                                                                <div class="product-label new">
                                                                    <span>new</span>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </figure>

                                                    <div class="product-caption">
                                                        <div class="product-identity">
                                                            <p class="manufacturer-name">
                                                                <a href="{{ route('index') }}">{{ env('APP_NAME') }}</a>
                                                            </p>
                                                        </div>

                                                        <p class="product-name">
                                                            <a
                                                                href="{{ route('product.detail', ['category' => $product->category->slug, 'slug' => $product->slug]) }}">{{ $product->name }}</a>
                                                        </p>

                                                        <div class="price-box">
                                                            <span
                                                                class="price-regular">{{ '$' . number_format($product->price, 2) }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div>Product not found in this Category.</div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </section>

        <div class="instagram-feed-area section-space pt-0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <h2>{{ env('APP_NAME') }} On Instagram</h2>
                            <p>Accumsan vitae pede lacus ut ullamcorper sollicitudin quisque libero est.</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="instagram-carousel slick-row-5" id="instagram-carousel">
                            @foreach ($instagram_images as $image)
                                <div class="instagram-item">
                                    <div class="instagram-thumb">
                                        <a href="https://www.instagram.com/p/{{ $image['name'] }}" target="_blank">
                                            <img src="{{ 'data:image/jpg;base64,' . base64_encode(file_get_contents($image['image'])) }}" alt="instagram">
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
