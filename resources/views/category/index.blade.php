@extends('layouts.main')

@section('title', 'Category')

@section('page_title', 'Category')

@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="/"> Home</a></li>
    <li class="breadcrumb-item">@yield('page_title')</li>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-5">
            @if (Session::get('message'))
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h6><i class="icon fas fa-exclamation-triangle"></i> {{ Session::get('message') }}</h6>
                </div>
            @endif

        </div>
        <div class="col-md-5"></div>
        <div class="col-md-2">
            <a href="/category/create" class="btn btn-block btn-success"> create</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            {{-- <h3 class="card-title">Responsive Hover Table</h3> --}}
            <form action="{{ route('search') }}" action="GET">
                @csrf
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="search" class="form-control float-right" placeholder="Search"
                            value="{{ old('search') }}">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Created_at</th>
                        <th>updated_at</th>
                        <th>aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($data as $index => $item)
                        <form action="/category/destroy/{{ $item->id }}" method="post">
                            @csrf
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    {{ $item->description == null ? 'data kosong' : $item->description }}
                                </td>
                                <td class={{ $item->is_active == 'NONACTIVE' ? 'text-danger' : 'text-success' }}>

                                    {{ $item->is_active }}

                                </td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default">Action</button>
                                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon"
                                            data-toggle="dropdown">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <a class="dropdown-item" href="/category/edit/{{ $item->id }}">Edit</a>

                                            <input type="submit" class="dropdown-item" value="Delete"
                                                onclick=" return confirm('Apakah anda yakin menghapus data {{ $item->name }}?')">

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </form>
                    @endforeach

                </tbody>
            </table>
            <div class="float-right mr-3 mt-3">
                {{ $data->links('pagination::bootstrap-4') }}
            </div>
        </div>
        <!-- /.card-body -->
    </div>


@endsection
