@extends('layouts.main')
@section('title', 'Dashboard')

@section('page_title', 'Dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">@yield('page_title')</li>

@endsection

@section('content')
    <h1> WELCOME</h1>

@endsection
@push('custom-script')
@endpush
