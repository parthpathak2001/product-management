@extends('front.layouts.master')
@section('content')
    <main>
        @include('front.layouts.breadcrumb')

        <div class="shop-main-wrapper section-space">
            <div class="container">
                <div class="row">
                    <input type="hidden" id="category_id" value="{{ $category->id }}">
                    <div>
                    </div>
                    <div class="col-lg-12">
                        <div class="shop-product-wrapper">
                            <div class="shop-top-bar">
                                <div class="row align-items-center">
                                    <div class="col-lg-7 col-md-6 order-2 order-md-1">
                                        <div class="top-bar-left">
                                            <div class="product-view-mode">
                                                <a class="active" href="#" data-target="grid-view">
                                                    <i class="fa fa-th"></i>
                                                </a>
                                                <a href="#" data-target="list-view"><i class="fa fa-list"></i></a>
                                            </div>
                                            <div class="product-amount" id="page_showing">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-6 order-1 order-md-2">
                                        <div class="top-bar-right">
                                            <div class="product-short">
                                                <p>Sort By : </p>
                                                <select class="nice-select" name="sort_by" id="sort_by">
                                                    <option value="">All</option>
                                                    <option value="1">Name (A - Z)</option>
                                                    <option value="2">Name (Z - A)</option>
                                                    <option value="3">Price (Low to High)</option>
                                                    <option value="4">Price (High to Low)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="product_list_div">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            var category_id = $('#category_id').val();
            get_product_list(category_id);
        });

        $(document).on('click', '.list .option', function() {
            var category_id = $('#category_id').val();
            var sort_by = $(this).data('value');

            get_product_list(category_id, sort_by);
        });

        $(document).on('click', '.pagination-box a', function(e) {
            e.preventDefault();
            var category_id = $('#category_id').val();
            var sort_by = $('#sort_by').val();
            var page = $(this).attr('href').split('page=')[1];

            get_product_list(category_id, sort_by, page);
        });

        function get_product_list(category_id, sort_by = 0, page = 0) {
            if (page != 0) {
                url = '{{ route('product.get.product.list') }}?page='+page;
            } else {
                url = '{{ route('product.get.product.list') }}';
            }

            $.ajax({
                url: url,
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "category_id": category_id,
                    "sort_by": sort_by
                },
                dataType: 'html',
                success: function(data) {
                    $('#product_list_div').html(data);
                }
            });
        }
    </script>
@endsection
