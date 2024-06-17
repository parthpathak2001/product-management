@extends('admin.layouts.app')
@if (isset($pageTitle) && $pageTitle != '')
    @section('title', $pageTitle . ' | ' . config('app.name'))
@else
    @section('title', config('app.name'))
@endif
@section('styles')
    @parent

@endsection
@section('content')

@endsection
@section('modals')

@endsection
@section('scripts')
    @parent

@endsection
