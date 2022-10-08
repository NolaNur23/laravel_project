@extends('layouts.main')

@section('title', 'News Restore')
@section('page_title', 'News Restore')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="/"> Home</a></li>
    <li class="breadcrumb-item">@yield('page_title')</li>
@endsection
@section('content')
    <div class="row">
        {{-- <div class="col-md-10"></div>
        <div class="col-md-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">
                Create Data News
            </button>
        </div> --}}


        <div class="col-md-12 mt-3">
            <div class="card-header">
                <h3 class="card-title"> List Data</h3>
            </div>
            <div class="card">
                <div class="card-body table-responsive">
                    <table id="dataTable" class="table table-bordered text-nowrap">
                        @csrf
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id Category</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Update At</th>
                                <th>Restore</th>
                            </tr>
                        </thead>
                    </table>
                </div>
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
                url: "/news/getDataRestore",
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
                                return '<input type="click" class="dropdown-item btn-restore" data-id="' +
                                    row.id + '" value="Restore" href="#">';
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
        $(document).on('click', '.btn-restore', function(e) {
            e.preventDefault()

            if (confirm("Are you sure to Restore data?")) {
                var inputToken = $("input[name=_token]")

                $.ajax({
                    url: "/news/restoreData/" + $(this).data('id'),
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
