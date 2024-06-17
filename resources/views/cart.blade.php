@extends('layouts.app')
@section('css')
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
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
                    <div class="table-rep-plugin">
                        <div class="mb-0 table-responsive" data-pattern="priority-columns">
                            <table id="dataTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price (₹)</th>
                                        <th>Quantity</th>
                                        <th>Total (₹)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($cart->count() > 0)
                                        @foreach ($cart as $item)
                                            <tr>
                                                <td>{{$item->product->title}}</td>
                                                <td>{{$item->product->price}}</td>
                                                <td>{{$item->quantity}}</td>
                                                <td>{{$item->product->price * $item->quantity}}</td>
                                                <td><a class="btn btn-outline-secondary btn-sm" href="{{route('cartDestroy', [$item->id])}}" title="Delete"><i class="fas fa-trash-alt"></i></a></td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <td colspan="5" class="text-center">Your cart is empty!</td>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{ asset('assets/libs/dataTables/dataTables.min.js') }}"></script>
@endsection

