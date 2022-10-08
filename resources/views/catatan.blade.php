<script>
    $(function() {
        loadData();

    });

    function loadData() {
        $.ajax({
            url: "",
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

    $(document).on('submit', '.', function(e) {

        e.preventDefault()
        var form = $(this)
        var inputToken = form.find("input[name=_token]")
        var title = form.find("input[name=]")
        $.ajax({
            url: "",
            type: "POST",
            data: {
                _token: inputToken.val(),
                title: title.val(),
            }
        }).done(function(result) {
            inputToken.val(result.newToken)
            if (result.status) {
                $('#').modal('hide'),
                    alert(result.message)
                // loadData()
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
                form.find('input[name=title]').val(data.title))

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
