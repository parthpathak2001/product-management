@php
    $empty = false;
    $i = 0;
@endphp

<div class="row mbn-30">
    @forelse ($products as $product)
        @if (isset($product->image) && \File::exists(public_path('uploads/products/' . $product->image)))
            @php
                $product_image = asset('uploads/products/' . $product->image);
                $i++;
            @endphp

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="team-member mb-30">
                    <div class="team-thumb multiple-images">
                        <img src="{{ $product_image }}" class="image_gallery" id="image_count_{{ $i - 1 }}" data-bs-toggle="modal" data-bs-target="#quick_view" alt="Product Image">
                    </div>
                </div>
            </div>
        @endif
    @empty
        @php
            $empty = true;
        @endphp
    @endforelse
</div>

@if ($empty == true)
    <div class="paginatoin-area text-center">
        Images not found.
    </div>
@else
    @php
        $previous = '';
        $next = '';
        $firstItem = $products->firstItem() != null ? $products->firstItem() : 0;
        $lastItem = $products->lastItem() != null ? $products->lastItem() : 0;
    @endphp

    @if ($products->currentPage() == 1)
        @php
            $previous = 'pointer-events: none';
        @endphp
    @endif

    @if ($products->currentPage() == $products->lastPage())
        @php
            $next = 'pointer-events: none';
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
@endif
