<div class="shop-product-wrap grid-view row mbn-30">
    @php
        $empty = false;
    @endphp
    @forelse ($products as $product)
        @php
            $image1 = '';
            $image2 = '';
        @endphp
        @if (isset($product->images))
            @if (isset($product->images[0]) && \File::exists(public_path('uploads/products/'.$product->images[0]->image)))
                @php
                    $image1 = asset('uploads/products/'.$product->images[0]->image);
                @endphp
            @endif
            @if (isset($product->images[1]) && \File::exists(public_path('uploads/products/'.$product->images[1]->image)))
                @php
                    $image2 = asset('uploads/products/'.$product->images[1]->image);
                @endphp
            @elseif (isset($product->images[0]) && \File::exists(public_path('uploads/products/'.$product->images[0]->image)))
                @php
                    $image2 = asset('uploads/products/'.$product->images[0]->image);
                @endphp
            @endif
        @endif

        <div class="col-md-4 col-sm-6">
            <div class="product-item">
                <figure class="product-thumb">
                    <a href="{{ route('product.detail', ['category' => $product->category->slug, 'slug' => $product->slug]) }}">
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
                        <a href="{{ route('product.detail', ['category' => $product->category->slug, 'slug' => $product->slug]) }}">{{ $product->name }}</a>
                    </p>
                    <div class="price-box">
                        <span class="price-regular">{{ '$'.number_format($product->price, 2) }}</span>
                    </div>
                </div>
            </div>

            <div class="product-list-item">
                <figure class="product-thumb">
                    <a href="{{ route('product.detail', ['category' => $product->category->slug, 'slug' => $product->slug]) }}">
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
                <div class="product-content-list">
                    <div class="manufacturer-name">
                        <a href="{{ route('index') }}">{{ env('APP_NAME') }}</a>
                    </div>
                    <h5 class="product-name"><a href="{{ route('product.detail', ['category' => $product->category->slug, 'slug' => $product->slug]) }}">{{ $product->name }}</a></h5>
                    <div class="price-box">
                        <span class="price-regular">{{ '$'.number_format($product->price, 2) }}</span>
                    </div>
                    <p>{{ strip_tags($product->description) }}</p>
                </div>
            </div>
        </div>
    @empty
        @php
            $empty = true;
        @endphp
    @endforelse
</div>


@if ($empty == true)
    <div class="paginatoin-area text-center">
        Product not found in this Category.
    </div>
@else
    @php
        $previous = '';
        $next = '';
        $firstItem = ($products->firstItem() != null) ? $products->firstItem() : 0;
        $lastItem = ($products->lastItem() != null) ? $products->lastItem() : 0;
    @endphp

    @if ($products->currentPage() == 1)
        @php
            $previous = "pointer-events: none";
        @endphp
    @endif
    @if ($products->currentPage() == $products->lastPage())
        @php
            $next = "pointer-events: none";
        @endphp
    @endif

    <div class="paginatoin-area text-center">
        <ul class="pagination-box">
            <li>
                <a class="previous" href="{{ $products->previousPageUrl() }}" style="{{ $previous }}">
                    <i class="lnr lnr-chevron-left"></i>
                </a>
            </li>
            @foreach ($products->getUrlRange(1, $products->lastPage()) as $key => $value)
                @php
                    $active = '';
                @endphp
                @if ($products->currentPage() == $key)
                    @php
                        $active = 'active';
                    @endphp
                @endif

                <li class="{{ $active }}">
                    <a href="{{ $value }}">{{ $key }}</a>
                </li>
            @endforeach
            <li>
                <a class="next" href="{{ $products->nextPageUrl() }}" style="{{ $next }}">
                    <i class="lnr lnr-chevron-right"></i>
                </a>
            </li>
        </ul>
    </div>
    <script>
        $('#page_showing').html('');
        var page_showing = "<p>Showing {{ $firstItem }}–{{ $lastItem }} of {{ $products->total() }} results</p>";
        $('#page_showing').append(page_showing);
    </script>
@endif
