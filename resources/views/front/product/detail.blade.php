@extends('front.layouts.master')
@section('styles')
    @parent
    <style>
        .swal2-popup.swal2-toast {
            font-size: 13px;
        }
    </style>
@endsection

@section('content')
    <main>
        <div class="breadcrumb-area common-bg">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-wrap">
                            <nav aria-label="breadcrumb">
                                <h1>product details</h1>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('index') }}"><i class="fa fa-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('product.index', $product->category->slug) }}">{{ $product->category->name }}</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @php
            $product_id  = $product->id;
            $product_name = $product->name;
        @endphp

        <div class="shop-main-wrapper section-space">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 order-1 order-lg-2">
                        <div class="product-details-inner">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="product-large-slider">
                                        @isset($product->images)
                                            @foreach ($product->images as $image)
                                                <div class="pro-large-img img-zoom">
                                                    <img src="{{ asset('uploads/products/' . $image->image) }}"
                                                        alt="product-details" />
                                                </div>
                                            @endforeach
                                        @endisset
                                    </div>

                                    <div class="pro-nav slick-row-10 slick-arrow-style">
                                        @isset($product->images)
                                            @foreach ($product->images as $image)
                                                <div class="pro-nav-thumb">
                                                    <img src="{{ asset('uploads/products/' . $image->image) }}"
                                                        alt="product-details" />
                                                </div>
                                            @endforeach
                                        @endisset
                                    </div>
                                </div>

                                <div class="col-lg-7">
                                    <div class="product-details-des">
                                        <div class="manufacturer-name">
                                            <a href="{{ route('product.detail', ['category' => $product->category->slug, 'slug' => $product->slug]) }}">{{ env('APP_NAME') }}</a>
                                        </div>

                                        <h3 class="product-name">{{ $product->name }}</h3>

                                        <div class="price-box">
                                            <span class="price-regular">{{ '$'.number_format($product->price, 2) }}</span>
                                        </div>

                                        <div class="send-inquiry">
                                            <a class="btn btn-cart2" data-product-id="{{ $product->id }}" id="btn_inquiry">Send Inquiry</a>
                                        </div>

                                        <p class="pro-desc">{{ strip_tags($product->description) }}</p>

                                        @php
                                            $link = route('product.detail', ['category' => $product->category->slug, 'slug' => $product->slug]);
                                        @endphp

                                        <div class="like-icon">
                                            <a class="whatsapp" href="https://api.whatsapp.com/send?text={{ $link }}" target="_blank"><i class="fa fa-whatsapp"></i>share</a>
                                            <a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ $link }}" target="_blank"><i class="fa fa-facebook"></i>like</a>
                                            <a class="twitter" href="https://twitter.com/intent/tweet?text=Check+out+this+Products+by+{{ env('APP_NAME') }}&url={{ $link }}&hashtags=Products,Manufacturing,Boost" target="_blank"><i class="fa fa-twitter"></i>tweet</a>
                                            <a class="linkedin" href="https://www.linkedin.com/cws/share?url={{ $link }}" target="_blank"><i class="fa fa-linkedin"></i>share</a>
                                            <a class="pinterest" href="https://pinterest.com/pin/create/button/?url={{ $link }}" target="_blank"><i class="fa fa-pinterest"></i>save</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="product-details-reviews section-space pb-0">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="product-review-info">
                                        <ul class="nav review-tab">
                                            <li>
                                                <a class="active" data-bs-toggle="tab" href="#tab_one">description</a>
                                            </li>
                                            <li>
                                        </ul>

                                        <div class="tab-content reviews-tab">
                                            <div class="tab-pane fade show active" id="tab_one">
                                                <div class="tab-one">
                                                    <p>{{ strip_tags($product->description) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="related-products section-space pt-0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title text-center">
                            <h2>Related Products</h2>
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
                                                <a href="{{ route('product.detail', ['category' => $product->category->slug, 'slug' => $product->slug]) }}">{{ env('APP_NAME') }}</a>
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
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('modals')
    @parent
    <div class="modal inquiry-modal" tabindex="-1" role="dialog" aria-hidden="true" id="inquiry_modal">
        <div class="modal-dialog" role="document">
            <form id="inquiry_form" method="POST" action="#">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Products Inquiry</h5>
                        <button type="button" class="close" id="modal_close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" name="product_id" id="product_id" value="{{ $product_id }}">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name*">
                                <span class="text-danger" id="name_err"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" name="email" class="form-control" id="email" placeholder="Your Email*">
                                <span class="text-danger" id="email_err"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" name="mobile_no" class="form-control" id="mobile_no" placeholder="Your Mobile No*">
                                <span class="text-danger" id="mobile_no_err"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <textarea name="comment" class="form-control" id="comment" placeholder="Please type your inquiry in detail*">Hi, I am interested in "{{ $product_name }}" and need pricing regarding same. Please contact me.</textarea>
                                <span class="text-danger" id="comment_err"></span>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-cart2" id="inquiry_submit">Send Inquiry</button>
                        <button type="button" class="btn cancle-btn" id="close_modal" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script>
        $(document).on('click', '#btn_inquiry', function() {
            $('#inquiry_modal').modal('show');
        });

        $(document).on('click', '#modal_close, #close_modal', function() {
            $('#name_err').html('');
            $('#email_err').html('');
            $('#mobile_no_err').html('');
            $('#comment_err').html('');
            $('#inquiry_modal').modal('hide');
        });

        $(document).on('click', '#inquiry_submit', function() {
            $('#name_err').html('');
            $('#email_err').html('');
            $('#mobile_no_err').html('');
            $('#comment_err').html('');

            var product_id  = $('#product_id').val();
            var name        = $('#name').val();
            var email       = $('#email').val();
            var mobile_no   = $('#mobile_no').val();
            var comment     = $('#comment').val();

            if (name == '') {
                $('#name_err').html('The name field is required.');
            }

            if (email == '') {
                $('#email_err').html('The email field is required.');
            }

            if (mobile_no == '') {
                $('#mobile_no_err').html('The mobile no field is required.');
            }

            if (comment == '') {
                $('#comment_err').html('The comment field is required.');
            }

            if (product_id != '' && name != '' && email != '' && mobile_no != '' && comment != '') {
                $('#inquiry_submit').attr("disabled", true);

                $.ajax({
                    url: '{{ route('inquiry.store') }}',
                    type: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "product_id": product_id,
                        "name": name,
                        "email": email,
                        "mobile_no": mobile_no,
                        "comment": comment
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#inquiry_submit').attr("disabled", false);
                        if (data.success == true) {
                            $('#inquiry_modal').modal('hide');
                            $('#name').val('');
                            $('#email').val('');
                            $('#mobile_no').val('');

                            setTimeout(function() {
                                Toast.fire("Inquiry Sent!", data.message, "success");
                            }, 2000);
                        } else {
                            setTimeout(function() {
                                Toast.fire("Failed!", data.message, "error");
                            }, 2000);
                        }
                    }
                });
            }
        });
    </script>
@endsection
