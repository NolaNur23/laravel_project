@extends('layouts.main')

@section('title', 'Profile')
@section('page_title', 'User Profile')
@section('breadcrumb')
    <li class="breadcrumb-item active"> <a href="/"> Home</a></li>
    <li class="breadcrumb-item">@yield('page_title')</li>
@endsection
@section('content')
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" src="/adminLTE/dist/img/user4-128x128.jpg"
                    alt="User profile picture">
            </div>

            <h3 class="profile-username text-center">{{ Auth::User()->name }}</h3>

            {{-- <p class="text-muted text-center">Software Engineer</p> --}}

            <div class="col-md-10"></div>
            <div class="col-md-2">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPassword">
                    Update Password
                </button>
            </div>


            <form action="#" class="form-update" method="POST">
                @csrf
                <div class="input-group mb-3">
                    <input type="hidden" name="id" value="{{ Auth::User()->id }}">
                    <input type="text" class="form-control" name="name">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="text mb-3">
                    {{-- < href="">Created At</> --}}
                    <input type="text" class="form-control" name="created_at">

                </div>
                <div class="row">
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                    </div>
                    {{-- <div class="col-4 ">
                        <button type="" class="btn btn-primary btn-block">Update Password</button>
                    </div> --}}
                    <!-- /.col -->
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <div class="modal fade" id="modalPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">


                <form action="#" class="form-password" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>old password</label>
                            <input type="password" name="old_password" class="form-control" required>
                            <input type="hidden" name="id" class="form-control" value="{{ Auth::User()->id }}"
                                required>
                        </div>
                        <div class="form-group">
                            <label>new password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>repassword</label>
                            <input type="password" name="repassword" class="form-control" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </div>

                </form>

            </div>

        </div>

    </div>


@endsection

@push('custom-script')
    <script>
        $(function() {
            getData();

        })

        // $.ajax({
        //         url: "",
        //         type: ,
        //         data: {}
        //     }).done(function(result) {

        //     }).fail(function(xhr, error) {

        //     }) {}

        function getData() {
            $.ajax({
                url: "/user/profile/getData",
                type: "GET",
                data: {}
            }).done(function(result) {
                var form = $('.form-update')
                form.find('input[name=name]').val(result.name);
                form.find('input[name=email]').val(result.email);
                form.find('input[name=created_at]').val(result.created_at);


            }).fail(function(xhr, error) {
                console.log('xhr', xhr.status)
                console.log('error', error)
            });
        }
        $(document).on('submit', '.form-update', function(e) {
            // java script
            e.preventDefault()
            var form = $(this)
            var inputToken = form.find("input[name=_token]")
            $.ajax({
                url: "/user/updateData/" + form.find("input[name=id]").val(),
                type: "POST",
                data: {
                    // name=form(*didefinisikan var diatas, mengambilkan form this). temukan("input merupakan type[name=name]").ambil
                    _token: inputToken.val(),
                    name: form.find("input[name=name]").val(),
                    email: form.find("input[name=email]").val(),

                    // id_category: form.find("select[name=id_category]").val(),

                }
            }).done(function(result) {
                inputToken.val(result.newToken)
                if (result.status) {
                    alert(result.message)
                    // getData();
                    location.reload()
                } else {
                    alert(result.message)
                }
            }).fail(function(xhr, error) {
                console.log('xhr', xhr.status)
                console.log('error', error)
                // loadData()
            })

        })
    </script>
    <script>
        $(document).on('submit', '.form-password', function(e) {
            // java script
            e.preventDefault()
            var form = $(this)
            var inputToken = form.find("input[name=_token]")
            $.ajax({
                url: "/user/updatePassword/" + form.find("input[name=id]").val(),
                type: "POST",
                data: {
                    // name=form(*didefinisikan var diatas, mengambilkan form this). temukan("input merupakan type[name=name]").ambil
                    _token: inputToken.val(),
                    oldPassword: form.find("input[name=old_password]").val(),
                    newPassword: form.find("input[name=password]").val(),
                    confirmPassword: form.find("input[name=repassword]").val(),
                    // is_active: form.find("select[name=is_active]").val(),

                }
            }).done(function(result) {
                inputToken.val(result.newToken)
                if (result.status) {
                    $('#modalUpdate').modal('hide'),
                        alert(result.message)
                    window.location.href = '/logout'
                    // loadData()
                } else {
                    alert(result.message)
                }
            }).fail(function(xhr, error) {
                console.log('xhr', xhr.status)
                console.log('error', error)
                // loadData()
            })

        })
    </script>
@endpush
