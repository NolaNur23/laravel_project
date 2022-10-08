@extends('layouts.main')

@section('title', 'News')
@section('page_title', 'News')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="/"> Home</a></li>
    <li class="breadcrumb-item">@yield('page_title')</li>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-10"></div>
        {{-- <div class="col-md-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">
                Tambah Data
            </button>
        </div> --}}


        <div class="col-md-12 mt-3">
            <div class="card-header">
                <h3 class="card-title"> List Data</h3>
            </div>
            <div class="card">
                <div class="card-body table-responsive">
                    <table id="dataTable" class="table table-bordered text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Asal</th>
                                <th>jumlah</th>
                                <th>PIC</th>
                                <th>Tanggal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- //modal create --}}
    <div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">


                <form action="#" class="form-create" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Tamu</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label> Asal </label>
                            <input type="text" name="asal" class="form-control" placeholder="Enter Asal" required>
                        </div>
                        <div class="form-group">
                            <label> Jumlah </label>
                            <input type="text" name="asal" class="form-control" placeholder="Enter Asal" required>
                        </div>
                       
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </form>

            </div>

        </div>

    </div>

    {{-- modal update --}}
    {{-- <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">


                <form action="#" class="form-update" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label> Title </label>
                            <input type="text" name="title" class="form-control" placeholder="Enter Title" required>
                            <input type="text" name="id" class="form-control" placeholder="Enter Title" required>
                        </div>
                        <div class="form-group">
                            <label> Id Category </label>
                            <select name="id_category" class="form-control">
                                @foreach ($data as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach>
                            </select>
                        </div>
                        <div class="form-group">
                            <label> Description</label>
                            <textarea name="description" rows="3" class="form-control" placeholder="Enter Description" required></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                </form>

            </div>

        </div>

    </div> --}}
@endsection



@push('custom-script')
    <script>
        $(function() {
            loadData();

        });

        function loadData() {
            $.ajax({
                url: "tamu/getData",
                type: "GET",
                data: {}
            }).done(function(result) {
                $('#dataTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "destroy": true,
                    "responsive": true,
                    "data": result.data,
                    "columns": [{
                            "data": "no"
                        }, {
                            "data": "asal"
                        }, {
                            "data": "jumlah"
                        }, {
                            "data": "pic"
                        },
                        {
                            "data": "created_at"
                        }, {
                            "data": "id"
                        }
                    ],
                    "columnDefs": [{
                            "targets": 5,
                            "data": "id",
                            "render": function(data, type, row) {
                                return '<div class="btn-group">' +
                                    '<button type="button" class="btn btn-default">Action</button>' +
                                    '<button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">' +
                                    '<span class="sr-only">Toggle Dropdown</span>' +
                                    '</button>' +
                                    '<div class="dropdown-menu" role="menu">' +
                                    '<a class="dropdown-item btn-edit" data-id="' + row.id +
                                    '" href="#">Edit</a>' +


                                    '<input type="submit" class="dropdown-item btn-delete" data-id="' +
                                    row.id + '" value="Delete" href="#">' +


                                    '</div></div>';
                            }
                        },


                        //tempat mengubah warna, button dll

                    ]
                })
            }).fail(function(xhr, error) {
                console.log('xhr', xhr.status)
                console.log('error', error)
            })
        }

       
    </script>
@endpush
