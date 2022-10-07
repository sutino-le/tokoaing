<?= $this->extend('layout'); ?>

<?= $this->section('isi') ?>
<?= csrf_field(); ?>



<style>
    .right {
        float: right;
    }
</style>

<div class="container py-5">
    <div class="row">


        <div class="col-lg-3">
            <h1 class="h2 pb-4">Kategori</h1>
            <ul class="list-unstyled templatemo-accordion">


                <li class="pb-3">

                    <form action="" method="post">
                        <div class="input-group mb-3">
                            <select class="form-control" name="keywordlink" id="keywordlink">
                                <option value="" selected>Pilih Kategori</option>
                                <option value=""></option>
                                <?php foreach ($kategori as $prokat) : ?>
                                    <option value="<?= $prokat['katid'] ?>"><?= $prokat['katnama'] ?></option>

                                <?php endforeach ?>
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-outline-success" type="submit" name="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>

                    </form>
                    <!-- <ul class="collapse show list-unstyled pl-3">
                            <li><a class="text-decoration-none" href="#">Men</a></li>
                            <li><a class="text-decoration-none" href="#">Women</a></li>
                        </ul> -->
                </li>
            </ul>
        </div>

        <div class="col-lg-9">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-inline shop-top-menu pb-3 pt-1">
                        <li class="list-inline-item">
                            <button type="submit" class="btn btn-outline-none text-success" onclick="linkall()">All</button>
                        </li>
                        <?php foreach ($databranch as $rowDataBranch) : ?>
                            <li class="list-inline-item">
                                <form action="" method="post">
                                    <div class="d-flex">
                                        <div class="input-group mb-3">
                                            <input type="hidden" class="form-control" name="keywordbranch" value="<?= $rowDataBranch['branchid'] ?>">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-outline-none text-success" name="submit"><?= ucwords(strtolower($rowDataBranch['branchnama'])) ?></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
                <div class="col-md-6 pb-4">
                    <form action="" method="post">
                        <div class="d-flex">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Masukan pencarian..." name="keyword" value="<?= old('keyword') ?>">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-success" type="submit" name="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row katalogTampil">
                <input type="hidden" id="iduser" value="<?= session()->iduser ?>">
                <?php foreach ($tampilkatalog as $rowproduct) : ?>

                    <div class="col-md-3">
                        <div class="card mb-4 product-wap rounded-0">
                            <div class="card rounded-0">
                                <img class="card-img rounded-0 img-fluid" src="<?= base_url() ?>/upload/<?= $rowproduct['prodgambar'] ?>">
                                <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                    <ul class="list-unstyled">
                                        <li><a class="btn btn-success text-white" href="#" onclick="tambahFavorit('<?= $rowproduct['prodid'] . ',' . session()->iduser ?>')"><i class="far fa-heart"></i></a></li>
                                        <li><a class="btn btn-success text-white mt-2" href="#" onclick="detailBarang('<?= sha1($rowproduct['prodid']) ?>')"><i class="far fa-eye"></i></a></li>
                                        <li><a class="btn btn-success text-white mt-2" href="#" onclick="tambahKeranjang('<?= $rowproduct['prodid'] . ',' . session()->iduser ?>')"><i class="fas fa-cart-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="#" class="h3 text-decoration-none"><strong><?= $rowproduct['prodnama'] ?></strong></a>
                                <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                    <li>Type : <?= $rowproduct['prodtype'] ?></li>
                                </ul>
                                <!-- <ul class="list-unstyled d-flex justify-content-center mb-1">
                                    <li>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-muted fa fa-star"></i>
                                        <i class="text-muted fa fa-star"></i>
                                    </li>
                                </ul> -->
                                <p class="text mb-0">Deskripsi : <?= substr($rowproduct['proddeskripsi'], 0, 50) ?>...</p>
                            </div>
                        </div>
                    </div>

                <?php endforeach ?>

            </div>

            <div class="right">
                <?= $pager->links('product', 'katalog_pagination') ?>
            </div>


        </div>

    </div>
</div>
<!-- End Content -->


<div class="viewmodal" style="display: none;"></div>



<script>
    // menampilkan semua katalog
    function linkall() {
        window.location.href = '<?= base_url() ?>/home/katalog';
    }

    // tambah ke list Favorit
    function tambahFavorit(id) {
        let iduser = $('#iduser').val();
        let login = "";
        if (iduser == "") {
            Swal.fire({
                title: 'Anda belum login!',
                text: "Apakah Anda ingin login ?",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, login',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#modalLogin').modal('show');
                }
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

    // lihat detail barang
    function detailBarang(id) {
        location.href = "<?= base_url() ?>/home/katalogdetail/" + id;
    }

    // tambah ke keranjang
    function tambahKeranjang(id) {
        let iduser = $('#iduser').val();
        if (iduser == "") {
            Swal.fire({
                title: 'Anda belum login!',
                text: "Apakah Anda ingin login ?",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, login',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#modalLogin').modal('show');
                }
            })
        } else {
            $.ajax({
                type: "post",
                url: "<?= base_url() ?>/home/modalTambahKeranjang/" + id,
                data: {
                    id: id,
                    iduser: iduser
                },
                dataType: "json",
                success: function(response) {
                    if (response.data) {
                        $('.viewmodal').html(response.data).show();
                        $('#modalTambahKeranjang').modal('show');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + thrownError);
                }
            });
        }
    }
</script>

<?= $this->endSection('isi') ?>