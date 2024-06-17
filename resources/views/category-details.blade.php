@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Category Details') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>{{$category->title}}</h4>
                                <p>{!!$category->description!!}</p>
                            </div>
                            <div class="col-md-6">
                                <img src="{{asset('uploads/categories/'.$category->image)}}" alt="Category Image" width="200px">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($category->products as $product)
                            <div class="col-md-4 d-flex align-items-stretch mb-3">
                                <div class="card" style="width: 18rem;">
                                    <img class="card-img-top" src="{{asset('uploads/products/'.$product->image)}}" alt="Product Image">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">{{$product->title}}</h5>
                                        <p class="card-text">Price: ₹{{$product->price}}</p>
                                        <a href="{{route('productDetails', [$product->id])}}" class="btn btn-primary mt-auto">More Details</a>
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
