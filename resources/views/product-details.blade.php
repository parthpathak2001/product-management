@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Product Details') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="mb-4">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>{{$product->title}}</h4>
                                <p>{!!$product->description!!}</p>
                                <p>Price: ₹<span id="price">{{$product->price}}</span></p>
                                <form action="{{route('addToCart')}}" method="POST">
                                    @csrf
                                    <input type="hidden" value="{{$product->id}}" name="product_id">
                                    <div class="form-group">
                                        <label class="mb-2" for="qty">Quantity: </label>
                                        <input type="number" min="1" value="1" class="form-control" id="qty" name="qty" placeholder="Quantity">
                                    </div>
                                    @auth
                                        <button type="submit" class="btn btn-primary mt-3">Add To Cart</button>
                                    @endauth
                                </form>
                                <h5 class="mt-3" id="total">Total: ₹{{$product->price}}</h5>
                            </div>
                            <div class="col-md-6">
                                <img src="{{asset('uploads/products/'.$product->image)}}" alt="Product Image" width="200px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script>
        $(document).ready(function(){
            $("#qty").change(function(){
                var qty = $(this).val();
                var price = $('#price').html();

                var total = qty * price;

                $('#total').html("Total ₹" + total);
            });
        });
    </script>
@endsection