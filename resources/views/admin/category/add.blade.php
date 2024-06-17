@extends('admin.layouts.app')
@if (isset($page_title) && $page_title != '')
    @section('title', $page_title . ' | ' . config('app.name'))
@else
    @section('title', config('app.name'))
@endif

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">{{ isset($category) ? 'Edit' : 'Add' }} Category</h4>

                <form action="{{ route('admin.category.store') }}" name="addfrm" id="addfrm" method="POST" enctype="multipart/form-data" autocomplete="off">
                    @if (Session::has('alert-message'))
                        <div class="alert alert-{{ Session::get('alert-class') }}">
                            {{ Session::get('alert-message') }}
                        </div>
                    @endif
                    @csrf
                    
                    @if (isset($category))
                        <input type="hidden" name="category_id" value="{{ $category->id }}">
                        <input type="hidden" id="actionType" value="edit" />
                    @else
                        <input type="hidden" id="actionType" value="add" />                        
                    @endif

                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label @error('title') is-invalid @enderror">Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" id="title" value="{{ old('title', isset($category) ? $category->title : '') }}">
                                @error('title')
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
                                <label class="form-label @error('description') is-invalid @enderror">Description</label>
                                <div class="controls">
                                    <textarea name="description" class="form-control ckeditor">{{ isset($category) ? $category->description : '' }}</textarea>

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
                                @if (isset($category))
                                    <img src="{{asset("uploads/categories/".$category->image)}}" alt="Category Image" style="width:250px">
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
                        <a href="{{ route('admin.category.index') }}" class="btn btn-secondary w-md">Cancel</a>
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
            $("#addfrm").validate({
                errorElement: "span",
                errorPlacement: function(label, element) {
                    label.addClass('errorMessage');
                    if(element.attr("type") == "radio") {
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
                    title: {
                        required: true
                    },
                    image: {
                        required: actionType === "add"
                    },
                }
            })
        });
    </script>
@endsection


