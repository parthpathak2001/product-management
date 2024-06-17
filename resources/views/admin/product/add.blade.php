@extends('admin.layouts.app')
@if (isset($page_title) && $page_title != '')
    @section('title', $page_title . ' | ' . config('app.name'))
@else
    @section('title', config('app.name'))
@endif
@section('styles')
    @parent
@endsection
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">{{ isset($product) ? 'Edit' : 'Add' }} Product</h4>

                <form action="{{ route('admin.product.store') }}" name="addfrm" id="addfrm" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @if (Session::has('alert-message'))
                        <div class="alert alert-{{ Session::get('alert-class') }}">
                            {{ Session::get('alert-message') }}
                        </div>
                    @endif
                    @csrf

                    @isset($product)
                        <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                    @endisset
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3 controls">
                                <label class="form-label @error('category_id') is-invalid @enderror">Category <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="category_id[]" id="category_id" multiple>
                                    <option value="">Select Category</option>
                                    {{-- @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ ((old('category_id') == $category->id) || (isset($product) && $category->id == $product->category_id)) ? 'selected' : '' }}>{{ $category->title }}</option>
                                    @endforeach --}}
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" 
                                            {{ in_array($category->id, old('category_id', isset($product) ? $product->categories->pluck('id')->toArray() : [])) ? 'selected' : '' }}>
                                            {{ $category->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label @error('title') is-invalid @enderror">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" id="title" value="{{ old('title', isset($product) ? $product->title : '') }}">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label @error('price') is-invalid @enderror">Price <span class="text-danger">*</span></label>
                                <input type="text" class="form-control numbers_only" name="price" id="price" value="{{ old('price', isset($product) ? $product->price : '') }}">
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label @error('quantity') is-invalid @enderror">Quantity <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="quantity" id="quantity" value="{{ old('quantity', isset($product) ? $product->quantity : '') }}">
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label @error('description') is-invalid @enderror">Description </label>
                                <div class="controls">
                                    <textarea name="description" class="form-control ckeditor">{{ isset($product) ? $product->description : '' }}</textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label @error('image') is-invalid @enderror">Image @if (!isset($category))
                                    <span class="text-danger">*</span>
                                @endif</label>
                                <input type="file" class="form-control" name="image" id="image">
                                @if (isset($product))
                                    <img src="{{asset("uploads/products/".$product->image)}}" alt="Category Image" style="width:250px">
                                @endif
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                        <a href="{{ route('admin.product.index') }}" class="btn btn-secondary w-md">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    @parent
    <script src="{{ asset('assets/libs/validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/libs/validate/additional-methods.js') }}"></script>
    <script src="{{ asset('assets/libs/ckeditor/ckeditor.js') }}"></script>
    <script>

        $(document).ready(function() {
            $("#addfrm")[0].reset();

            $("#addfrm").validate({
                errorElement: "span",
                errorPlacement: function(label, element) {
                    label.addClass('errorMessage');
                    if(element.attr("type") == "radio" || element.hasClass('select2') || element.attr("name") == "description") {
                        $(element).parents('.controls').append(label)
                    } else {
                        label.insertAfter(element);
                    }
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).closest('.form-group').addClass(errorClass).removeClass(validClass);
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).closest('.form-group').removeClass(errorClass).addClass(validClass)
                },
                ignore: [],
                rules: {
                    category_id: {
                        required: true
                    },
                    title: {
                        required: true
                    },
                    price: {
                        required: true,
                        number: true
                    },
                    quantity: {
                        required: true,
                        digits: true
                    }
                }
            });
        });
    </script>
@endsection


