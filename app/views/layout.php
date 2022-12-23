<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $perunama ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>/upload/<?= $peruicon ?>">


    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>


    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/templatemo.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/custom.css">

    <!-- Slick -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/slick.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>/assets/css/slick-theme.css">

    <link rel="stylesheet" href="<?= base_url() ?>/package/dist/sweetalert2.min.css">
    <script src="<?= base_url() ?>/package/dist/sweetalert2.all.min.js"></script>
    <style>
        body {
            user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            -khtml-user-select: none;
            -webkit-user-select: none;
        }
    </style>



</head>

<body>
    <?= csrf_field(); ?>
    <nav class="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
        <div class="container text-light">
            <div class="w-100 d-flex justify-content-between">
                <div>
                    <nav class="navbar navbar-expand-sm">
                        <a class="navbar-sm-brand text-light text-decoration-none" href="mailto:<?= $perunama ?>"><i class="fa fa-envelope mx-2"></i><?= $perunama ?></a>
                        &nbsp;
                        <a class="navbar-sm-brand text-light text-decoration-none" href="tel:<?= $perutelp ?>"><i class="fa fa-phone mx-2"></i><?= $perutelp ?></a>
                        &nbsp;
                        <a class="navbar-sm-brand text-light text-decoration-none" href="https://wa.me/<?= $peruwa ?>?text=Halo Graver..." target="_blank"><i class="fab fa-whatsapp mx-2"></i><?= $peruwa ?></a>
                    </nav>
                </div>
                <div>
                    <nav class="navbar navbar-expand-sm">
                        <a class="navbar-sm-brand text-light text-decoration-none" href="https://www.instagram.com/rackindo.idn/?hl=id" target="_blank"><i class="fab fa-instagram mx-2"></i></a>
                    </nav>
                </div>
            </div>
        </div>
    </nav>


    <nav id="navbar_top" class="navbar navbar-expand-lg navbar-light shadow bg-white">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand text-success logo h1 align-self-center" href="<?= base_url() ?>">
                <?= $perunama ?>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>/home/katalog">Katalog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>/home/about">Tentang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>/home/contact">Bantuan</a>
                        </li>
                    </ul>
                </div>
                <div class="navbar align-self-center d-flex">

                    <?php
                    if (session()->namauser) {
                    ?>
                        <a class="nav-icon position-relative text-decoration-none" href="#" id="tombolLihatKeranjang">
                            <i class="fa fa-fw fa-cart-arrow-down text-dark mr-1"></i>
                            <span class="position-absolute top-0 left-100 translate-middle badge rounded-pill bg-light text-dark" id="totalKeranjang"></span>
                        </a>

                        <input type="hidden" name="jumlahKeranjang" id="jumlahKeranjang">
                        <input type="hidden" name="useridkeranjang" id="useridkeranjang" value="<?= sha1(session()->iduser) ?>">

                        <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">

                            <input type="hidden" id="iduser" value="<?= session()->iduser ?>">

                            <li class="nav-item"><a class="nav-link" href="<?= site_url('profil/index/' . sha1(session()->iduser)) ?>"><?= session()->namauser ?></a></li>
                            <li class="nav-item">
                                <button type="button" class="btn btn-outline-danger" id="logout">Logout</button>
                            </li>
                        </ul>
                    <?php
                    } else {
                    ?>
                        <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                            <li class="nav-item">
                                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modalLogin">
                                    Login
                                </button>
                            </li>
                        </ul>
                    <?php
                    }
                    ?>
                </div>
            </div>

        </div>
    </nav>


    <div class="modal fade" id="modalLogin" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalLoginLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLoginLabel">Silahkan Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModalLogin">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('home/login') ?>" class="formlogin">
                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" autocomplete="off">
                            <div class="invalid-feedback errorEmail"></div>
                        </div>
                        <div class="form-group">
                            <label for="password">Kata Sandi :</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" autocomplete="off">
                            <div class="invalid-feedback errorPassword"></div>
                        </div>
                        <div class="form-group text-right">
                            <label for="forgotpass"><a href="#" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#modalLupaSandi" id="tombolLupaSandi">Lupa Kata Sandi</a> </label>
                        </div>
                        <div class="form-group">
                            <label for="formLogin">Belum punya akun ? klik <a href="#" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#modalDaftar" id="tombolDaftar">disini</a></label></label>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalDaftar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalDaftarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDaftarLabel">Form Daftar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModalDaftar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="<?= base_url('home/daftarUser') ?>" class="formdaftar">

                        <div class="form-group">
                            <label for="">Nama Lengkap</label>
                            <input type="text" name="usernama" id="usernama" class="form-control" placeholder="Masukan Nama Lengkap..." autocomplete="off">
                            <div class="invalid-feedback errorUserNama"></div>
                        </div>

                        <div class="form-group">
                            <label for="">User ID</label>
                            <input type="text" name="userid" id="userid" class="form-control" placeholder="Masukan User Name..." autocomplete="off">
                            <div class="invalid-feedback errorUserID"></div>
                        </div>

                        <div class="form-group">
                            <label for="">Kata Sandi</label>
                            <input type="password" name="userpassword" id="userpassword" class="form-control" placeholder="Masukan Password..." autocomplete="off">
                            <div class="invalid-feedback errorUserPassword"></div>
                        </div>

                        <div class="form-group">
                            <label for="formLogin">Sudah punya akun ? klik <a href="#" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#modalLogin" id="tombolLogin">disini</a></label><input type="hidden" name="userlevel" value="2" class="form-control">
                        </div>

                        <div class="row mb-3 px-3"> <button type="submit" class="btn btn-primary btn-block text-center">Daftar</button> </div>


                    </form>

                </div>
            </div>
        </div>
    </div>


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
                    <form action="<?= base_url('home/lupasandi') ?>" class="formlupasandi">
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

    <?= $this->renderSection('isi'); ?>


    <footer class="bg-dark" id="tempaltemo_footer">
        <div class="container">
            <div class="row">

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-success border-bottom pb-3 border-light logo"><?= $perunama ?></h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li>
                            <a class="text-decoration-none" href="<?= $perualamatlink ?>" target="_blank"><i class="fas fa-map-marker-alt fa-fw"></i><?= $perualamat ?></a>
                        </li>
                        <li>
                            <i class="fa fa-phone fa-fw"></i>
                            <a class="text-decoration-none" href="tel:<?= $perutelp ?>"><?= $perutelp ?></a>
                        </li>
                        <li>
                            <i class="fa fa-envelope fa-fw"></i>
                            <a class="text-decoration-none" href="mailto:<?= $peruemail ?>"><?= $peruemail ?></a>
                        </li>
                    </ul>
                </div>

                <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Produk</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <?php foreach ($databrand as $rowDataBrand) : ?>
                            <li>
                                <form action="<?= base_url() ?>/home/katalog" method="post">
                                    <div class="d-flex">
                                        <div class="input-group">
                                            <input type="hidden" class="form-control" name="keywordbrand" value="<?= $rowDataBrand['brandid'] ?>">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-outline-none text-success" name="submit"><?= ucwords(strtolower($rowDataBrand['brandnama'])) ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>

                <!-- <div class="col-md-4 pt-5">
                    <h2 class="h2 text-light border-bottom pb-3 border-light">Further Info</h2>
                    <ul class="list-unstyled text-light footer-link-list">
                        <li><a class="text-decoration-none" href="#">Home</a></li>
                        <li><a class="text-decoration-none" href="#">About Us</a></li>
                        <li><a class="text-decoration-none" href="#">Shop Locations</a></li>
                        <li><a class="text-decoration-none" href="#">FAQs</a></li>
                        <li><a class="text-decoration-none" href="#">Contact</a></li>
                    </ul>
                </div> -->

            </div>

            <div class="row text-light mb-4">
                <div class="col-12 mb-3">
                    <div class="w-100 my-3 border-top border-light"></div>
                </div>
                <div class="col-auto me-auto">
                    <ul class="list-inline text-left footer-icons">
                        <li class="list-inline-item border border-light rounded-circle text-center">
                            <a class="text-light text-decoration-none" target="_blank" href="https://www.instagram.com/rackindo.idn/?hl=id"><i class="fab fa-instagram fa-lg fa-fw"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-auto">
                    <label class="sr-only" for="subscribeEmail">Email address</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control bg-dark border-light" id="subscribeEmail" placeholder="Email address">
                        <div class="input-group-text btn-success text-light">Subscribe</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-100 bg-black py-3">
            <div class="container">
                <div class="row pt-2">
                    <div class="col-12">
                        <p class="text-left text-light">
                            Copyright &copy; 2021 Graver Furniture
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </footer>


    <script src="<?= base_url() ?>/assets/js/jquery-1.11.0.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/templatemo.js"></script>
    <script src="<?= base_url() ?>/assets/js/custom.js"></script>


    <script src="<?= base_url() ?>/assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/slick.min.js"></script>


    <script>
        $(document).ready(function() {

            // proses daftar akun
            $('.formdaftar').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(response) {
                        if (response.error) {
                            let err = response.error;

                            if (err.errUserNama) {
                                $('#usernama').addClass('is-invalid');
                                $('.errorUserNama').html(err.errUserNama);
                            } else {
                                $('#usernama').removeClass('is-invalid');
                                $('#usernama').addClass('is-valid');
                            }

                            if (err.errUserID) {
                                $('#userid').addClass('is-invalid');
                                $('.errorUserID').html(err.errUserID);
                            } else {
                                $('#userid').removeClass('is-invalid');
                                $('#userid').addClass('is-valid');
                            }

                            if (err.errUserPassword) {
                                $('#userpassword').addClass('is-invalid');
                                $('.errorUserPassword').html(err.errUserPassword);
                            } else {
                                $('#userpassword').removeClass('is-invalid');
                                $('#userpassword').addClass('is-valid');
                            }
                        }

                        if (response.sukses) {

                            let data = response.sukses;

                            let userid = data.userid;
                            let usernama = data.usernama;

                            $.ajax({
                                type: "post",
                                url: "<?= base_url() ?>/home/kirimverifikasi",
                                data: {
                                    userid: userid,
                                    usernama: usernama
                                },
                                dataType: "json",
                                success: function(response) {
                                    if (response.berhasil) {
                                        Swal.fire(
                                            'Berhasil',
                                            response.berhasil,
                                            'success'
                                        ).then((result) => {
                                            window.location.reload();
                                        })
                                    }
                                }
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + '\n' + thrownError);
                    }
                });

                return false;
            });

        });


        // untuk menampilkan total keranjang
        function ambilTotalKeranjang() {
            let iduser = $('#iduser').val();
            $.ajax({
                type: "post",
                url: "<?= base_url() ?>/home/ambilTotalKeranjang",
                data: {
                    iduser: iduser
                },
                dataType: "json",
                success: function(response) {
                    $('#totalKeranjang').html(response.totalkeranjang);
                    $('#jumlahKeranjang').val(response.totalkeranjang);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + thrownError);
                }
            });
        }

        // tombol lihat keranjang
        $(document).ready(function() {
            $('#tombolLihatKeranjang').click(function(e) {
                e.preventDefault();
                let jumlahKeranjang = $('#jumlahKeranjang').val();
                let user = $('#useridkeranjang').val();

                if (jumlahKeranjang == 0) {
                    Swal.fire(
                        'Opss...',
                        'Belum ada product dikeranjang Anda..Lanjut belanja',
                        'error'
                    ).then((result) => {
                        window.location.href = '<?= base_url() ?>/home/katalog';
                    })
                } else {
                    window.location.href = '<?= base_url() ?>/home/keranjang/' + user;
                }

            });
        });


        // untuk form login
        $(document).ready(function() {
            ambilTotalKeranjang();

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

            // close modal login
            $('#closeModalLogin').click(function(e) {
                e.preventDefault();
                $('#modalLogin').modal('hide');
            });

            // close modal daftar
            $('#closeModalDaftar').click(function(e) {
                e.preventDefault();
                $('#modalDaftar').modal('hide');
            });

            // close modal lupa sandi
            $('#closeModalLupaSandi').click(function(e) {
                e.preventDefault();
                $('#modalLupaSandi').modal('hide');
            });

            // jika klik tombol daftar hide modal login
            $('#tombolDaftar').click(function(e) {
                e.preventDefault();
                $('#modalLogin').modal('hide');
            });

            // jika klik tombol login hide modal daftar
            $('#tombolLogin').click(function(e) {
                e.preventDefault();
                $('#modalDaftar').modal('hide');
            });

            // tombol logout
            $('#logout').click(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "<?= base_url() ?>/home/keluar",
                    dataType: "json",
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '<?= base_url() ?>/home/index';
                            }
                        });
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



        document.addEventListener("DOMContentLoaded", function() {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    document.getElementById('navbar_top').classList.add('fixed-top');
                    // add padding top to show content behind navbar
                    navbar_height = document.querySelector('.navbar').offsetHeight;
                    document.body.style.paddingTop = navbar_height + 'px';
                } else {
                    document.getElementById('navbar_top').classList.remove('fixed-top');
                    // remove padding top from body
                    document.body.style.paddingTop = '0';
                }
            });
        });

        $('#carousel-related-product').slick({
            infinite: true,
            arrows: false,
            slidesToShow: 4,
            slidesToScroll: 3,
            dots: true,
            responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 3
                    }
                }
            ]
        });
    </script>

</body>

</html>