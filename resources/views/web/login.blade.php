@extends('web.layouts.auth')

@section('page-css')
    <link rel="stylesheet" media="screen, print" href="{{asset('web_assets/plugins/sweetalert2/sweetalert2.min.css')}}">
    <link rel="stylesheet" media="screen, print" href="{{asset('web_assets/plugins/toastr/toastr.min.css')}}">
@endsection

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>MiLuKu</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form id="login-form">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Account" id="account" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" id="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">登入</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
@endsection

@section('page-js')
    <script type="text/javascript" src="{{asset('web_assets/plugins/CryptoJS/rollups/md5.js')}}"></script>
    <script type="text/javascript" src="{{asset('web_assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('web_assets/plugins/toastr/toastr.min.js')}}"></script>
@endsection

@section('inline-js')
    <script>

        function swal(title, text, type) {
            Swal.fire(title, text, type);
        }

         $(function () {
            //
            $('#account').val(localStorage.getItem('web.account'));
            $('#password').val(localStorage.getItem('web.password'));
            if (localStorage.getItem('web.remember') == 'true') {
                $('#remember').prop("checked", true);
            } else {
                $('#remember').prop("checked", false);
            }

            // Validation
            $("#login-form").submit(function(e) {
                e.preventDefault(); // avoid to execute the actual submit of the form.
                let $form = $(this);

                $(':input[type="submit"]').prop('disabled', true);
                let data = {};
                data.account = $("#account").val();
                data.password = CryptoJS.MD5($("#password").val()).toString(CryptoJS.enc.Base64);
                //data.password = $("#password").val();
                console.log(data);
                $.ajax({
                    url: '/web_api/login',
                    data: data,
                    type: "POST",
                    resetForm: true,
                    success: function (rtndata) {
                        console.log(rtndata);
                        if (rtndata.status == 0x00000000) {
                            swal("", "登入成功", "success");

                            if ($('#remember').prop("checked")) {
                                localStorage.setItem('web.account', $("#account").val());
                                localStorage.setItem('web.password', CryptoJS.MD5($("#password").val()).toString(CryptoJS.enc.Base64));
                                localStorage.setItem('web.remember', true);
                            } else {
                                localStorage.setItem('web.account', '');
                                localStorage.setItem('web.password', '');
                                localStorage.setItem('web.remember', false);
                            }
                            setTimeout(function () {
                                location.href = rtndata.data.rtnurl;
                            }, 1000);
                        } else {
                            swal("", rtndata.message, "error");
                            $(':input[type="submit"]').prop('disabled', false);
                        }
                    },
                    error: function (XMLHttpRequest) {
                        toastr.error( XMLHttpRequest.responseJSON.message);
                        if ($('#remember').prop("checked")) {
                            localStorage.setItem('web.account', $("#account").val());
                            localStorage.setItem('web.password', CryptoJS.MD5($("#password").val()).toString(CryptoJS.enc.Base64));
                            localStorage.setItem('web.remember', true);
                        } else {
                            localStorage.setItem('web.account', '');
                            localStorage.setItem('web.password', '');
                            localStorage.setItem('web.remember', false);
                        }
                    }
                });
            });
        });
    </script>
@endsection
