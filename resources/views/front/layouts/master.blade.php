<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>

    @section('styles')
        <link rel="shortcut icon" href="{{ asset('assets/img/favicon.jpg') }}" type="image/x-icon" />
        <link href="https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,900" rel="stylesheet">
        <link href="{{ asset('assets/css/vendor.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    @show
</head>

<body>
    @include('front.layouts.header')

    @yield('content')

    @section('modals')
        <div class="modal" id="quick_view">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="product-details-inner" id="product_modal_data">
                            <div class="row">
                                <div class="col-lg-5 col-md-5">
                                    <div class="product-large-slider" id="div_main_images">
                                    </div>
                                    <div class="pro-nav slick-row-10 slick-arrow-style" id="div_slick_images">
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-7">
                                    <div class="product-details-des quick-details">
                                        <div class="manufacturer-name">
                                            <a href="{{ route('index') }}">{{ env('APP_NAME') }}</a>
                                        </div>
                                        <h3 class="product-name" id="product_name"></h3>
                                        <div class="ratings d-flex">
                                            <span><i class="lnr lnr-star"></i></span>
                                            <span><i class="lnr lnr-star"></i></span>
                                            <span><i class="lnr lnr-star"></i></span>
                                            <span><i class="lnr lnr-star"></i></span>
                                            <span><i class="lnr lnr-star"></i></span>
                                            <div class="pro-review">
                                                <span>1 Reviews</span>
                                            </div>
                                        </div>
                                        <div class="price-box">
                                            <span class="price-regular" id="product_price"></span>
                                        </div>
                                        <div class="availability">
                                            <i class="fa fa-check-circle"></i>
                                            <span>200 in stock</span>
                                        </div>
                                        <p class="pro-desc" id="product_description"></p>
                                        <div class="quantity-cart-box d-flex align-items-center">
                                            <h5>qty:</h5>
                                            <div class="quantity">
                                                <div class="pro-qty"><input type="text" value="1"></div>
                                            </div>
                                            <div class="action_link">
                                                <a class="btn btn-cart2" href="#">Add to cart</a>
                                            </div>
                                        </div>
                                        <div class="color-option">
                                            <h5>color :</h5>
                                            <ul class="color-categories">
                                                <li>
                                                    <a class="c-lightblue" href="#" title="LightSteelblue"></a>
                                                </li>
                                                <li>
                                                    <a class="c-darktan" href="#" title="Darktan"></a>
                                                </li>
                                                <li>
                                                    <a class="c-grey" href="#" title="Grey"></a>
                                                </li>
                                                <li>
                                                    <a class="c-brown" href="#" title="Brown"></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="useful-links">
                                            <a href="#" data-bs-toggle="tooltip" title="Compare"><i
                                                    class="lnr lnr-sync"></i>compare</a>
                                            <a href="#" data-bs-toggle="tooltip" title="Wishlist"><i
                                                    class="lnr lnr-heart"></i>wishlist</a>
                                        </div>
                                        <div class="like-icon">
                                            <a class="facebook" href="#"><i class="fa fa-facebook"></i>like</a>
                                            <a class="twitter" href="#"><i class="fa fa-twitter"></i>tweet</a>
                                            <a class="pinterest" href="#"><i class="fa fa-pinterest"></i>save</a>
                                            <a class="google" href="#"><i class="fa fa-google-plus"></i>share</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @show

    @include('front.layouts.footer')

    @section('modals')
        @show

    <div class="scroll-top not-visible">
        <i class="fa fa-angle-up"></i>
    </div>

    @section('scripts')
        <script src="{{ asset('assets/js/vendor.js') }}"></script>
        <script src="{{ asset('assets/js/active.js') }}"></script>
        <script src="{{ asset('assets/libs/sweetalert2/sweetalert2.js') }}"></script>
        <script src="{{ asset('assets/common/common.js') }}"></script>
        <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/libs/jquery/jquery.validate.min.js') }}"></script>
        <script>
            // mobile-menu
            $(document).ready(function() {
                $('.mobile-main-menu').hide();
            });

            $('#mobile-menu').on('click', function() {
                $('.mobile-main-menu').toggle();
            });

            $('.quick_view').on('click', function() {
                var product_id = $(this).data('id');
            });

            function product_detail_modal(product_id) {
                $.ajax({
                    url: '{{ route('product.modal.detail') }}',
                    type: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "product_id": product_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        $('#product_name').html(data.product_name);
                        $('#product_price').html(data.product_price);
                        $('#product_description').html(data.product_desc);
                        var main_imgs = '';
                        var slick_imgs = '';
                        $.each(data.product_imgs, function(key, val) {
                            main_imgs += '<div class="pro-large-img img-zoom"><img src="' + val +
                                '" alt="product-details" /></div>';
                            slick_imgs += '<div class="pro-nav-thumb"><img src="' + val +
                                '" alt="product-details" /></div>';
                        });

                        $('#quick_view').modal('show');
                    }
                });
            }

            $("#frm_newsletter").validate({
                ignore: [],
                rules: {
                    email: {
                        required: true,
                        maxlength: 50,
                        email: true,
                    },
                },
                messages: {
                    email: {
                        required: "Please enter email",
                        email: "Please enter valid email",
                        maxlength: "The email name should less than or equal to 50 characters",
                    }
                },
                submitHandler: function(form) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $("#nl_submit").attr("disabled", true);
                    $.ajax({
                        url: "{!! route('newsletter.store') !!}",
                        type: "POST",
                        data: $('#frm_newsletter').serialize(),
                        success: function(data) {
                            $("#nl_submit").attr("disabled", false);
                            if (data.success == true) {
                                form.reset();
                                setTimeout(function() {
                                    Toast.fire("Success!", data.message, "success");
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
    @show
</body>

</html>
