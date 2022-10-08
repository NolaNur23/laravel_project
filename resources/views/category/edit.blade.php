@extends('layouts.main')
@section('title', 'Category')
@section('page_title', 'Category')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="/"> Home</a></li>
    <li class="breadcrumb-item active"><a href="/category"> @yield('page_title')</a></li>
    <li class="breadcrumb-item "> Create Category</li>
@endsection
@section('content')
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Form Edit</h3>
        </div>
        <div class="col-md-5">
            @if (Session::get('message'))
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h6><i class="icon fas fa-exclamation-triangle"></i> {{ Session::get('message') }}</h6>
                </div>
            @endif

        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="/category/update/{{ $data->id }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Name"
                        value="{{ $data->name }}" required>
                </div>
                <div class="form-group">
                    <label>Select</label>
                    <select name="is_active" class="form-control">
                        <option value="ACTIVE" {{ $data->is_active == 'ACTIVE' ? 'selected' : '' }}>Active</option>
                        <option value="NONACTIVE" {{ $data->is_active == 'ACTIVE' ? '' : 'selected' }}>Non Active</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description" required>
                   {{ $data->description }}
                    </textarea>
                    {{-- <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div> --}}
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
        </form>
    </div>

@endsection
