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
            <h3 class="card-title">Form Create</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="/category/store">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                </div>
                <div class="form-group">
                    <label>Select</label>
                    <select name="is_active" class="form-control">
                        <option value="ACTIVE">Active</option>
                        <option value="NONACTIVE">Non Active</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea type="text" class="form-control" name="description" placeholder="Enter Description" required>
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
