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
        <div class="col-md-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">
                Create Data News
            </button>
        </div>


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
                                <th>Id Category</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Update At</th>
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
                        <h5 class="modal-title" id="exampleModalLabel">Create Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label> Title </label>
                            <input type="text" name="title" class="form-control" placeholder="Enter Title" required>
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </form>

            </div>

        </div>

    </div>

    {{-- modal update --}}
    <div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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

    </div>
@endsection



@push('custom-script')
    <script>
        $(function() {
            loadData();

        });

        function loadData() {
            $.ajax({
                url: "/news/getData",
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
                            "data": "category.name"
                        }, {
                            "data": "title"
                        }, {
                            "data": "description"
                        },
                        {
                            "data": "tgl"
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

        $(document).on('submit', '.form-create', function(e) {

            e.preventDefault()
            var form = $(this)
            var inputToken = form.find("input[name=_token]")
            var title = form.find("input[name=title]")
            var descrip = form.find("textarea[name=description]")
            var id_cat = form.find("select[name=id_category]")
            $.ajax({
                url: "/news/createData",
                type: "POST",
                data: {
                    _token: inputToken.val(),
                    title: title.val(),
                    description: descrip.val(),
                    id_category: id_cat.val()

                }
            }).done(function(result) {
                inputToken.val(result.newToken)
                if (result.status) {
                    $('#modalCreate').modal('hide'),
                        alert(result.message)
                    loadData()
                } else {
                    alert(result.message)
                }
            }).fail(function(xhr, error) {
                console.log('xhr', xhr.status)
                console.log('error', error)
                loadData()
            })
        })
        $(document).on('click', '.btn-edit', function(e) {
            e.preventDefault();
            var form = $(this)
            window.onload = () => {
                $('#onload').modal('show');
            }

            $.ajax({
                url: "/news/getData",
                Type: "POST",
                data: {
                    id: $(this).data('id'),

                }
            }).done(function(result) {
                if (result.data) {
                    var form = $('.form-update')
                    var data = result.data
                    form.find('input[name=title]').val(data.title)
                    form.find('textarea[name=description]').val(data.description)
                    form.find('select[name=id_category]').val(data.id_category)
                    form.find('input[name=id]').val(data.id)

                    $('#modalUpdate').modal('show')
                } else {
                    alert('data not found')
                }
            }).fail(function(xhr, error) {
                console.log('xhr', xhr.status)
                console.log('error', error)
            })
        })
        $(document).on('submit', '.form-update', function(e) {
            // java script
            e.preventDefault()
            var form = $(this)
            var inputToken = form.find("input[name=_token]")
            $.ajax({
                url: "/news/updateData/" + form.find("input[name=id]").val(),
                type: "POST",
                data: {
                    // name=form(*didefinisikan var diatas, mengambilkan form this). temukan("input merupakan type[name=name]").ambil
                    _token: inputToken.val(),
                    title: form.find("input[name=title]").val(),
                    description: form.find("textarea[name=description]").val(),
                    id_category: form.find("select[name=id_category]").val(),

                }
            }).done(function(result) {
                inputToken.val(result.newToken)
                if (result.status) {
                    $('#modalUpdate').modal('hide'),
                        alert(result.message)
                    loadData()
                } else {
                    alert(result.message)
                }
            }).fail(function(xhr, error) {
                console.log('xhr', xhr.status)
                console.log('error', error)
                loadData()
            })

        })
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault()

            if (confirm("Are you sure to delete data?")) {
                var inputToken = $("input[name=_token]")

                $.ajax({
                    url: "/news/deleteData/" + $(this).data('id'),
                    type: "POST",
                    data: {
                        _token: inputToken.val()
                    }
                }).done(function(result) {
                    inputToken.val(result.newToken)
                    if (result.status) {
                        loadData()
                        // alert(result.message)

                    } else {
                        alert(result.message)
                    }
                }).fail(function(xhr, error) {
                    console.log('xhr', xhr.status)
                    console.log('error', error)
                })
            }


        })
    </script>
@endpush
