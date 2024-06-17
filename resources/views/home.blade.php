@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Categories') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        @foreach ($categories as $category)
                            <div class="col-md-4 d-flex align-items-stretch mb-3">
                                <div class="card" style="width: 18rem;">
                                    <img class="card-img-top" src="{{asset('uploads/categories/'.$category->image)}}" alt="Category Image">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">{{$category->title}}</h5>
                                        <a href="{{route('categoryDetails', [$category->id])}}" class="btn btn-primary mt-auto">More Details</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
