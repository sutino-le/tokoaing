<!-- Modal -->
<div class="modal fade" id="modalEdit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">


            <form class="formsimpan" action="<?= base_url() ?>/perusahaan/updateperusahaan" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Perusahaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">


                    <input type="hidden" name="peruidlama" id="peruidlama" value="<?= $peruid ?>">

                    <div class="form-group">
                        <label for="">Nama Perusahaan</label>
                        <input type="text" name="perunama" id="perunama" value="<?= $perunama ?>" class="form-control" placeholder="Masukan Nama Perusahaan..." autocomplete="off">
                        <div class="invalid-feedback errorPeruNama"></div>
                    </div>

                    <div class="form-group">
                        <label for="">Alamat Perusahaan</label>
                        <textarea name="perualamat" id="perualamat" cols="10" rows="2" class="form-control"><?= $perualamat ?></textarea>
                        <div class="invalid-feedback errorPeruAlamat"></div>
                    </div>

                    <div class="form-group">
                        <label for="">Link Map Perusahaan</label>
                        <textarea name="perualamatlink" id="perualamatlink" cols="10" rows="5" class="form-control"><?= $perualamatlink ?></textarea>
                        <div class="invalid-feedback errorPeruAlamatLink"></div>
                    </div>

                    <div class="form-group">
                        <label for="">Telp Perusahaan</label>
                        <input type="text" name="perutelp" id="perutelp" value="<?= $perutelp ?>" class="form-control" placeholder="Masukan Telp. Perusahaan..." autocomplete="off">
                        <div class="invalid-feedback errorPeruTelp"></div>
                    </div>

                    <div class="form-group">
                        <label for="">WhatsApp Perusahaan</label>
                        <input type="text" name="peruwa" id="peruwa" value="<?= $peruwa ?>" class="form-control" placeholder="Masukan WhatsApp Perusahaan..." autocomplete="off">
                        <div class="invalid-feedback errorPeruWa"></div>
                    </div>

                    <div class="form-group">
                        <label for="">Fax Perusahaan</label>
                        <input type="text" name="perufax" id="perufax" value="<?= $perufax ?>" class="form-control" placeholder="Masukan Fax Perusahaan..." autocomplete="off">
                        <div class="invalid-feedback errorPeruFax"></div>
                    </div>

                    <div class="form-group">
                        <label for="">Email Perusahaan</label>
                        <input type="email" name="peruemail" id="peruemail" value="<?= $peruemail ?>" class="form-control" placeholder="Masukan Email Perusahaan..." autocomplete="off">
                        <div class="invalid-feedback errorPeruEmail"></div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success" id="tombolsimpan" autocomplete="off">Simpan</button>
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" id="batal">Batal</button>
                </div>


            </form>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalEditGambar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">


            <form class="formsimpangambar" action="<?= base_url() ?>/perusahaan/updategambar" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Gambar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">


                    <input type="hidden" name="peruidlama" id="peruidlama" value="<?= $peruid ?>">

                    <div class="form-group">
                        <label for="">Icon Perusahaan</label>
                        <div class="row">
                            <div class="col-2">
                                <img src="<?= base_url() ?>/upload/<?= $peruicon ?>" alt="<?= $peruicon ?>" width="30px" height="30px">
                            </div>
                            <div class="col-10">
                                <input type="file" name="peruicon" id="peruicon" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Foto Perusahaan</label>
                        <div class="row">
                            <div class="col-2">
                                <img src="<?= base_url() ?>/upload/<?= $perufoto ?>" alt="<?= $perufoto ?>" width="30px" height="30px">
                            </div>
                            <div class="col-10">
                                <input type="file" name="perufoto" id="perufoto" class="form-control">
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success" autocomplete="off">Simpan</button>
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" id="batal">Batal</button>
                </div>


            </form>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.formsimpan').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.error) {
                        let err = response.error;

                        if (err.errPeruNama) {
                            $('#perunama').addClass('is-invalid');
                            $('.errorPeruNama').html(err.errPeruNama);
                        } else {
                            $('#perunama').removeClass('is-invalid');
                            $('#perunama').addClass('is-valid');
                        }

                        if (err.errPeruAlamat) {
                            $('#perualamat').addClass('is-invalid');
                            $('.errorPeruAlamat').html(err.errPeruAlamat);
                        } else {
                            $('#perualamat').removeClass('is-invalid');
                            $('#perualamat').addClass('is-valid');
                        }

                        if (err.errPeruTelp) {
                            $('#perutelp').addClass('is-invalid');
                            $('.errorPeruTelp').html(err.errPeruTelp);
                        } else {
                            $('#perutelp').removeClass('is-invalid');
                            $('#perutelp').addClass('is-valid');
                        }

                        if (err.errPeruWa) {
                            $('#peruwa').addClass('is-invalid');
                            $('.errorPeruWa').html(err.errPeruWa);
                        } else {
                            $('#peruwa').removeClass('is-invalid');
                            $('#peruwa').addClass('is-valid');
                        }

                        if (err.errPeruEmail) {
                            $('#peruemail').addClass('is-invalid');
                            $('.errorPeruEmail').html(err.errPeruEmail);
                        } else {
                            $('#peruemail').removeClass('is-invalid');
                            $('#peruemail').addClass('is-valid');
                        }

                    }

                    if (response.sukses) {
                        $('#modalEdit').modal('hide');
                        swal.fire(
                            'Berhasil',
                            response.sukses,
                            'success'
                        ).then((result) => {
                            window.location.reload();
                        })
                    }

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + thrownError);
                }
            });

            return false;
        });

        $('#batal').click(function(e) {
            e.preventDefault();
            window.location.reload();
        });

    });
</script>