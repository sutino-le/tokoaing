<?= $this->extend('layout'); ?>

<?= $this->section('isi') ?>
<?= csrf_field(); ?>


<div class="container-fluid mb-5">
    <h1 class="text-center mt-3 mb-3">Daftar Belanja</h1>
    <div class="row m-2">

        <div class="row">
            <div class="col-sm-8">

                <?php
                $noker = 1;
                $totalProduct = 0;
                $totalBelanja = 0;
                foreach ($datakeranjang->getResultArray() as $rowKeranjang) :
                ?>

                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <img src="<?= base_url() ?>/upload/<?= $rowKeranjang['prodgambar'] ?>" alt="<?= $rowKeranjang['prodgambar'] ?>" width="100px" height="100px">
                        </div>
                        <div class="col-sm-10">
                            <h4><?= $rowKeranjang['prodnama'] ?></h4>
                            <b>Rp. <?= number_format($rowKeranjang['prodharga']) ?></b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="ketproduct" id="ketproduct" placeholder="Tambah Catatan">
                        </div>
                        <div class="col-sm-6">
                            <div class="row mt-2">
                                <div class="col text-right mt-2">
                                    Qty :
                                </div>
                                <div class="col">
                                    <input type="number" name="kerjml" id="kerjml" class="form-control input-number" value="<?= $rowKeranjang['kerjml'] ?>" min="1" max="<?= $rowKeranjang['prodstock'] ?>">
                                </div>
                                <div class="col text-center">
                                    <button type="button" class="btn btn-danger" onclick="hapusItemKeranjang('<?= sha1($rowKeranjang['kerid']) ?>')"><i class='fas fa-trash-alt'></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr style="height:2px;border-width:0;color:gray;background-color:gray">

                <?php
                    $totalProduct += $rowKeranjang['kerjml'];
                    $totalBelanja += $rowKeranjang['prodharga'] * $rowKeranjang['kerjml'];
                endforeach
                ?>
            </div>
            <div class="col-sm-4">
                <div class="row">
                    <h4>Ringkasan Belanja</h4>
                </div>
                <div class="row">
                    <div class="col">
                        Total ( <?= $totalProduct ?> Barang )
                    </div>
                    <div class="col text-right">
                        Rp. <?= number_format($totalBelanja) ?>
                    </div>
                </div>
                <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                <div class="row">

                    <div class="col">
                        <h4>Total Harga </h4>
                    </div>
                    <div class="col text-right">
                        <h4>Rp. <?= number_format($totalBelanja) ?></h4>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-6 text-right">
            </div>
            <div class="col-6 text-right">
                <button type="button" class="btn btn-danger mb-1" onclick="hapusSemuaeranjang('<?= sha1(session()->iduser) ?>')">Kosongkan Kerajang</button>
                <button type="button" class="btn btn-primary mb-1" onclick="lanjutBelanja()">Lanjutkan Belanja</button>
                <button type="button" class="btn btn-success mb-1" onclick="pesanSekarang('<?= sha1(session()->iduser) ?>')">Lanjutkan Pemesanan</button>
            </div>
        </div>

    </div>
</div>



<script>
    // untuk menghapus keranjang satu persatu
    function hapusItemKeranjang(id) {
        Swal.fire({
            title: 'Apakah kamu yakin ?',
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= base_url() ?>/home/hapusItemKeranjang/" + id,
                    dataType: "json",
                    success: function(response) {
                        Swal.fire(
                            'Berhasil!',
                            response.sukses,
                            'success'
                        ).then((result) => {
                            window.location.reload();
                        })
                    }
                });
            }
        })
    }

    // untuk menghapus semua keranjang
    function hapusSemuaeranjang(iduser) {
        Swal.fire({
            title: 'Apakah kamu yakin ?',
            text: "Mengosongkan keranjang Anda!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Kosongkan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= base_url() ?>/home/hapusSemuaKeranjang/" + iduser,
                    dataType: "json",
                    success: function(response) {
                        Swal.fire(
                            'Berhasil!',
                            response.sukses,
                            'success'
                        ).then((result) => {
                            window.location.reload();
                        })
                    }
                });
            }
        })
    }

    // untuk lanjut belanja
    function lanjutBelanja() {
        window.location.href = '<?= base_url() ?>/home/katalog';
    }

    // tambah pesanan
    function pesanSekarang(id) {
        Swal.fire({
            title: 'Maaf...',
            text: 'Kami sedang mengembangkan tahap ini.',
            imageUrl: '<?= base_url() ?>/assets/img/maintenance.gif',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        })
    }
</script>


<?= $this->endSection('isi') ?>