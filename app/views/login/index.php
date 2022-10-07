<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Graver Furnitur</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>/upload/favicon.png">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url() ?>/assets_admin/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets_admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets_admin/dist/css/adminlte.min.css">


    <link rel="stylesheet" href="<?= base_url() ?>/assets_admin/plugins/sweetalert2/sweetalert2.min.css">
    <script src="<?= base_url() ?>/assets_admin/plugins/sweetalert2/sweetalert2.all.min.js"></script>


    <!-- icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?= base_url() ?>"><b>Graver Furniture</b></a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Silahkan Login</p>

                <form action="<?= base_url() ?>/auth/login" class="formlogin">
                    <div class="input-group mb-3">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback errorEmail"></div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback errorPassword"></div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>

                <p class="mb-1 mt-2">
                    <a href="#" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#modalLupaSandi" id="tombolLupaSandi">Lupa Kata Sandi</a>
                </p>
            </div>
        </div>
    </div>



    <!-- Modal Lupa kata sandi -->
    <div class="modal fade" id="modalLupaSandi" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalLupaSandiLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLupaSandiLabel">Ganti Sandi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModalLupaSandi">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('auth/lupasandi') ?>" class="formlupasandi">
                        <div class="form-group">
                            <label for="emailuser">Masukan Email :</label>
                            <input type="email" name="emailuser" class="form-control" id="emailuser" placeholder="Enter email" autocomplete="off">
                            <div class="invalid-feedback errorEmail"></div>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary">Kirim Verifikasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>








    <script src="<?= base_url() ?>/assets_admin/plugins/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>/assets_admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/assets_admin/dist/js/adminlte.min.js"></script>





    <script>
        $(document).ready(function() {
            // proses form login
            $('.formlogin').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(response) {
                        if (response.error) {
                            let err = response.error;

                            if (err.errEmail) {
                                $('#email').addClass('is-invalid');
                                $('.errorEmail').html(err.errEmail);
                            } else {
                                $('#email').removeClass('is-invalid');
                                $('#email').addClass('is-valid');
                            }

                            if (err.errPassword) {
                                $('#password').addClass('is-invalid');
                                $('.errorPassword').html(err.errPassword);
                            } else {
                                $('#password').removeClass('is-invalid');
                                $('#password').addClass('is-valid');
                            }
                        }

                        if (response.sukses) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.href = "<?= base_url() ?>/main";
                                }
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + '\n' + thrownError);
                    }
                });

            });


            // untuk reset password
            $('.formlupasandi').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(response) {
                        if (response.error) {
                            let err = response.error;

                            if (err.errEmail) {
                                $('#emailuser').addClass('is-invalid');
                                $('.errorEmail').html(err.errEmail);
                            } else {
                                $('#emailuser').removeClass('is-invalid');
                                $('#emailuser').addClass('is-valid');
                            }
                        }

                        if (response.berhasil) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.berhasil
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location
                                        .reload();
                                }
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + '\n' + thrownError);
                    }
                });

            });




        });
    </script>






</body>

</html>