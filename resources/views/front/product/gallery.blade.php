@extends('front.layouts.master')
@section('content')
    <main>
        @include('front.layouts.breadcrumb')

        <div class="blog-main-wrapper section-space">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="blog-item-wrapper" id="gallery_list_div">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('modals')
    <div class="modal" id="quick_view">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content" style="height: 650px;">
                <div class="modal-header">
                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="product-details-inner">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="product-large-slider">
                                    <div class="pro-large-img img-zoom custom_img_size">
                                        <img src="" id="image_0" alt="product-details" />
                                    </div>
                                    <div class="pro-large-img img-zoom custom_img_size">
                                        <img src="" id="image_1" alt="product-details" />
                                    </div>
                                    <div class="pro-large-img img-zoom custom_img_size">
                                        <img src="" id="image_2" alt="product-details" />
                                    </div>
                                    <div class="pro-large-img img-zoom custom_img_size">
                                        <img src="" id="image_3" alt="product-details" />
                                    </div>
                                    <div class="pro-large-img img-zoom custom_img_size">
                                        <img src="" id="image_4" alt="product-details" />
                                    </div>
                                    <div class="pro-large-img img-zoom custom_img_size">
                                        <img src="" id="image_5" alt="product-details" />
                                    </div>
                                    <div class="pro-large-img img-zoom custom_img_size">
                                        <img src="" id="image_6" alt="product-details" />
                                    </div>
                                    <div class="pro-large-img img-zoom custom_img_size">
                                        <img src="" id="image_7" alt="product-details" />
                                    </div>
                                </div>

                                <div class="pro-nav slick-row-10 slick-arrow-style">
                                    <div class="pro-nav-thumb custom_img_slide">
                                        <img src="" id="slide_image_0" alt="product-details" />
                                    </div>
                                    <div class="pro-nav-thumb custom_img_slide">
                                        <img src="" id="slide_image_1" alt="product-details" />
                                    </div>
                                    <div class="pro-nav-thumb custom_img_slide">
                                        <img src="" id="slide_image_2" alt="product-details" />
                                    </div>
                                    <div class="pro-nav-thumb custom_img_slide">
                                        <img src="" id="slide_image_3" alt="product-details" />
                                    </div>
                                    <div class="pro-nav-thumb custom_img_slide">
                                        <img src="" id="slide_image_4" alt="product-details" />
                                    </div>
                                    <div class="pro-nav-thumb custom_img_slide">
                                        <img src="" id="slide_image_5" alt="product-details" />
                                    </div>
                                    <div class="pro-nav-thumb custom_img_slide">
                                        <img src="" id="slide_image_6" alt="product-details" />
                                    </div>
                                    <div class="pro-nav-thumb custom_img_slide">
                                        <img src="" id="slide_image_7" alt="product-details" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            var type = $('#type').val();
            get_gallery_list(type);
        });

        $(document).on('click', '.pagination-box a', function(e) {
            e.preventDefault();
            var type = $('#type').val();
            var page = $(this).attr('href').split('page=')[1];

            get_gallery_list(type, page);
        });

        function get_gallery_list(type, page = 0) {
            if (page != 0) {
                url = '{{ route('product.get.gallery.list') }}?page=' + page;
            } else {
                url = '{{ route('product.get.gallery.list') }}';
            }

            $.ajax({
                url: url,
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "type": type,
                },
                dataType: 'html',
                success: function(data) {
                    $('#gallery_list_div').html(data);

                    for (let i = 0; i < 8; i++) {
                        let img = $('#image_count_'+i).attr('src');
                        $('#image_'+i).closest('.custom_img_size');
                        $('#image_'+i).attr('src', img);
                        $('#slide_image_'+i).attr('src', img);
                    }
                }
            });
        }
    </script>
@endsection
