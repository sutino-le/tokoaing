<?= $this->extend('layout'); ?>

<?= $this->section('isi') ?>
<?= csrf_field(); ?>

<input type="hidden" id="namauser" value="<?= session()->namauser ?>">

<!-- Open Content -->
<section class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-5 mt-5">
                <div class="card mb-3">
                    <img class="card-img img-fluid" src="<?= base_url() ?>/upload/<?= $prodgambar ?>" alt="<?= $prodnama ?>" id="product-detail"">
                </div>
                <div class=" row">
                    <!--Start Carousel Wrapper-->
                    <div id="multi-item-example" class="col-10 carousel slide carousel-multi-item" data-bs-ride="carousel">
                        <!--Start Slides-->
                        <div class="carousel-inner product-links-wap" role="listbox">

                            <!--First slide-->
                            <div class="carousel-item active">
                                <div class="row">
                                    <?php
                                    $nomor = 1;
                                    foreach ($productDetail->getResultArray() as $rowGambar) :
                                    ?>
                                        <div class="col-2">
                                            <a href="#">
                                                <img class="card-img img-fluid" src="<?= base_url() ?>/upload/<?= $rowGambar['detprofoto'] ?>" alt="Product Image <?= $nomor++ ?>">
                                            </a>
                                        </div>

                                    <?php endforeach ?>
                                </div>
                            </div>
                            <!--/.First slide-->

                        </div>
                        <!--End Slides-->
                    </div>
                    <!--End Carousel Wrapper-->
                </div>
            </div>
            <!-- col end -->
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h1 class="h2"><?= $prodnama ?></h1>
                        <p class="h3 py-2">Rp. <?= number_format($prodharga) ?></p>
                        <p class="py-2">
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-secondary"></i>
                            <span class="list-inline-item text-dark">Rating 4.8 | 36 Comments</span>
                        </p>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <h6>Brand:</h6>
                            </li>
                            <li class="list-inline-item">
                                <p class="text-muted"><strong><?= $branchnama ?></strong></p>
                            </li>
                        </ul>

                        <h6>Description:</h6>
                        <p><?= $proddeskripsi ?></p>

                        <!-- <ul class="list-inline">
                            <li class="list-inline-item">
                                <h6>Avaliable Color :</h6>
                            </li>
                            <li class="list-inline-item">
                                <p class="text-muted"><strong>White / Black</strong></p>
                            </li>
                        </ul> -->

                        <!-- <h6>Specification:</h6>
                        <ul class="list-unstyled pb-3">
                            <li>Lorem ipsum dolor sit</li>
                            <li>Amet, consectetur</li>
                            <li>Adipiscing elit,set</li>
                            <li>Duis aute irure</li>
                            <li>Ut enim ad minim</li>
                            <li>Dolore magna aliqua</li>
                            <li>Excepteur sint</li>
                        </ul> -->

                        <form action="" method="GET">
                            <input type="hidden" name="product-title" value="Activewear">
                            <div class="row">
                                <!-- <div class="col-auto">
                                    <ul class="list-inline pb-3">
                                        <li class="list-inline-item">Size :
                                            <input type="hidden" name="product-size" id="product-size" value="S">
                                        </li>
                                        <li class="list-inline-item"><span class="btn btn-success btn-size">S</span></li>
                                        <li class="list-inline-item"><span class="btn btn-success btn-size">M</span></li>
                                        <li class="list-inline-item"><span class="btn btn-success btn-size">L</span></li>
                                        <li class="list-inline-item"><span class="btn btn-success btn-size">XL</span></li>
                                    </ul>
                                </div> -->
                                <div class="form-group row">

                                    <?php
                                    if (empty($tampildatakeranjang['kerjml'])) {
                                        $jumlahker = 1;
                                    } else {
                                        $jumlahker = $tampildatakeranjang['kerjml'];
                                    }
                                    ?>

                                    <input type="hidden" class="form-control" name="kerbrgid" id="kerbrgid" value="<?= $prodid ?>">
                                    <input type="hidden" class="form-control" name="keruser" id="keruser" value="<?= session()->iduser ?>">
                                    <input type="hidden" class="form-control" name="kertanggal" id="kertanggal" value="<?= date("Y-m-d") ?>">

                                    <label for="jumlah" class="col-sm-4 col-form-label">Jumlah</label>
                                    <div class="col-sm-5">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-danger btn-number" data-type="minus" data-field="kerjml">
                                                    <span class="glyphicon glyphicon-minus"><i class="fa fa-minus"></i></span>
                                                </button>
                                            </span>
                                            <input type="text" name="kerjml" id="kerjml" class="form-control input-number" value="<?= $jumlahker ?>" min="1" max="<?= $prodstock ?>">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="kerjml">
                                                    <span class="glyphicon glyphicon-plus"><i class="fa fa-plus"></i></span>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row pb-3">
                                <div class="col d-grid">
                                    <button type="button" class="btn btn-success btn-lg" onclick="pesanSekarang('<?= $prodid ?>')">Pesan</button>
                                </div>
                                <div class="col d-grid">
                                    <button type="button" class="btn btn-success btn-lg" onclick="addKeranjang('<?= $prodid ?>')">Tambah ke Keranjang</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Close Content -->


<script>
    // tambah pesanan
    function pesanSekarang(id) {
        let namauser = $('#namauser').val();
        if (namauser == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Anda belum login!',
            })
        } else {
            Swal.fire({
                title: 'Maaf...',
                text: 'Kami sedang mengembangkan tahap ini.',
                imageUrl: '<?= base_url() ?>/assets/img/maintenance.gif',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Custom image',
            })
        }
    }


    // tambah ke keranjang
    function addKeranjang(id) {
        let namauser = $('#namauser').val();
        if (namauser == "") {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Anda belum login!',
            })
        } else {
            let kertanggal = $('#kertanggal').val();
            let kerbrgid = id;
            let kerjml = $('#kerjml').val();
            let keruser = $('#keruser').val();

            $.ajax({
                type: "post",
                url: "<?= base_url() ?>/home/simpanKeranjang",
                data: {
                    kertanggal: kertanggal,
                    kerbrgid: kerbrgid,
                    kerjml: kerjml,
                    keruser: keruser,
                },
                dataType: "json",
                success: function(response) {

                    if (response.sukses) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        })
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + thrownError);
                }
            });
        }
    }
</script>





<!-- untuk tombol tambah dan kurang -->
<script>
    $('.btn-number').click(function(e) {
        e.preventDefault();

        fieldName = $(this).attr('data-field');
        type = $(this).attr('data-type');
        var input = $("input[name='" + fieldName + "']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if (type == 'minus') {

                if (currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                }
                if (parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }

            } else if (type == 'plus') {

                if (currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
                if (parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }
    });
    $('.input-number').focusin(function() {
        $(this).data('oldValue', $(this).val());
    });
    $('.input-number').change(function() {

        minValue = parseInt($(this).attr('min'));
        maxValue = parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());

        name = $(this).attr('name');
        if (valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if (valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }


    });
    $(".input-number").keydown(function(e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
</script>


<?= $this->endSection('isi') ?>