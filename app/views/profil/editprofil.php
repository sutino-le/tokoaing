<?= $this->extend('layout'); ?>

<?= $this->section('isi') ?>



<div class="container-fluid mt-lg-5 mb-lg-5">
    <div class="row justify-content-center">
        <!-- left column -->
        <div class="col-md-6 text">
            <!-- general form elements -->
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h3 class="card-title">Edit Profil</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <?= form_open_multipart(base_url() . '/profil/simpanprofil', 'class="formsimpan"'); ?>
                <?= csrf_field(); ?>


                <div class="card-body bg-secondary">

                    <div class="form-group">
                        <label for="userid" class="text-white">Alamat Email</label>
                        <input type="email" class="form-control" name="userid" id="userid" value="<?= $userid ?>" readonly>
                        <input type="hidden" class="form-control" name="userid" id="userid" value="<?= $userid ?>">
                    </div>

                    <div class="form-group">
                        <label for="usernama" class="text-white">Nama Lengkap</label>
                        <input type="text" class="form-control" name="usernama" id="usernama" value="<?= $usernama ?>" placeholder="Masukan Nama Lengkap" autocomplete="off">
                        <div class="invalid-feedback errorUserNama"></div>
                    </div>

                    <div class="form-group">
                        <label for="usergender" class="text-white">Jenis Kelamin</label>
                        <select name="usergender" id="usergender" class="form-control">
                            <option value="<?= $usergender ?>" selected><?= $usergender ?></option>
                            <option value=""></option>
                            <option value="Pria">Pria</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                        <div class="invalid-feedback errorUserGender"></div>
                    </div>

                    <div class="form-group">
                        <label for="userlahir" class="text-white">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="userlahir" id="userlahir" value="<?= $userlahir ?>" placeholder="Masukan Tanggal Lahir">
                        <div class="invalid-feedback errorUserLahir"></div>
                    </div>

                    <div class="form-group">
                        <label for="useralamatid" class="text-white">Pilih Wilayah (Pengiriman)</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Masukan Kode Wilayah" name="useralamatid" id="useralamatid" value="<?= $useralamatid ?>" readonly>
                            <input type="hidden" name="id_wilayah" id="id_wilayah" value="<?= $useralamatid ?>">
                            <div class="input-group-append">
                                <button class="btn btn-success" type="button" id="tombolCariWilayah" title="Cari Wilayah"><i class="fas fa-search"></i></button>
                            </div>
                            <div class="invalid-feedback errorUserAlamatId"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="useralamat" class="text-white">Alamat (Nama Jalan, Gedung, No. Rumah)</label>
                        <div class="row">
                            <div class="col-8">
                                <input type="text" class="form-control" name="useralamat" id="useralamat" value="<?= $useralamat ?>" placeholder="Masukan Alamat" autocomplete="off">
                                <div class="invalid-feedback errorUserAlamat"></div>
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control" name="userrt" id="userrt" value="<?= $userrt ?>" placeholder="RT" autocomplete="off">
                                <div class="invalid-feedback errorUserRt"></div>
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control" name="userrw" id="userrw" value="<?= $userrw ?>" placeholder="RW" autocomplete="off">
                                <div class="invalid-feedback errorUserRw"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <input type="text" class="form-control" name="kelurahan" id="kelurahan" value="<?= $kelurahan ?>" placeholder="Kelurahan" readonly>
                                <div class="invalid-feedback errorUserKelurahan"></div>
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" name="kecamatan" id="kecamatan" value="<?= $kecamatan ?>" placeholder="Kecamatan" readonly>
                                <div class="invalid-feedback errorUserKecamatan"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <input type="text" class="form-control" name="kota_kabupaten" id="kota_kabupaten" value="<?= $kota_kabupaten ?>" placeholder="Kota/Kabupaten" readonly>
                                <div class="invalid-feedback errorUserKabupaten"></div>
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" name="propinsi" id="propinsi" value="<?= $propinsi ?>" placeholder="Propinsi" readonly>
                                <div class="invalid-feedback errorUserPropinsi"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <input type="text" class="form-control" name="kodepos" id="kodepos" value="<?= $kodepos ?>" placeholder="Kodepos" readonly>
                                <div class="invalid-feedback errorUserKodepos"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="usernote" class="text-white">Detail Lainnya (Cth: Blok / Unit No., Patokan)</label>
                        <input type="text" class="form-control" name="usernote" id="usernote" value="<?= $usernote ?>" placeholder="Masukan Keterangan" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label for="usertelp" class="text-white">Nomor Telp./Wa</label>
                        <input type="text" class="form-control" name="usertelp" id="usertelp" value="<?= $usertelp ?>" onkeypress="return checkInput(event,'+0123456789',this)" placeholder="Masukan Nomor Telp./Wa" autocomplete="off">
                        <div class="invalid-feedback errorUserTelp"></div>
                    </div>




                </div>
                <!-- /.card-body -->

                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>


                <?= form_close(); ?>


            </div>
            <!-- /.card -->
        </div>
    </div>
</div>



<div class="viewmodal" style="display: none;"></div>

<script>
    $(document).ready(function() {
        $('#tombolCariWilayah').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url() ?>/wilayah/modalData",
                dataType: "json",
                success: function(response) {
                    if (response.data) {
                        $('.viewmodal').html(response.data).show();
                        $('#modalDataWilayah').modal('show');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + thrownError);
                }
            });
        });





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

                        if (err.errUserNama) {
                            $('#usernama').addClass('is-invalid');
                            $('.errorUserNama').html(err.errUserNama);
                        } else {
                            $('#usernama').removeClass('is-invalid');
                            $('#usernama').addClass('is-valid');
                        }

                        if (err.errUserGender) {
                            $('#usergender').addClass('is-invalid');
                            $('.errorUserGender').html(err.errUserGender);
                        } else {
                            $('#usergender').removeClass('is-invalid');
                            $('#usergender').addClass('is-valid');
                        }

                        if (err.errUserLahir) {
                            $('#userlahir').addClass('is-invalid');
                            $('.errorUserLahir').html(err.errUserLahir);
                        } else {
                            $('#userlahir').removeClass('is-invalid');
                            $('#userlahir').addClass('is-valid');
                        }

                        if (err.errUserAlamatId) {
                            $('#kelurahan').addClass('is-invalid');
                            $('#kecamatan').addClass('is-invalid');
                            $('#kota_kabupaten').addClass('is-invalid');
                            $('#propinsi').addClass('is-invalid');
                            $('#kodepos').addClass('is-invalid');
                            $('#useralamatid').addClass('is-invalid');
                            $('.errorUserAlamatId').html(err.errUserAlamatId);
                        } else {
                            $('#kelurahan').removeClass('is-invalid');
                            $('#kecamatan').removeClass('is-invalid');
                            $('#kota_kabupaten').removeClass('is-invalid');
                            $('#propinsi').removeClass('is-invalid');
                            $('#kodepos').removeClass('is-invalid');
                            $('#useralamatid').removeClass('is-invalid');
                            $('#kelurahan').addClass('is-valid');
                            $('#kecamatan').addClass('is-valid');
                            $('#kota_kabupaten').addClass('is-valid');
                            $('#propinsi').addClass('is-valid');
                            $('#kodepos').addClass('is-valid');
                            $('#useralamatid').addClass('is-valid');
                        }

                        if (err.errUserAlamat) {
                            $('#useralamat').addClass('is-invalid');
                            $('.errorUserAlamat').html(err.errUserAlamat);
                        } else {
                            $('#useralamat').removeClass('is-invalid');
                            $('#useralamat').addClass('is-valid');
                        }

                        if (err.errUserRt) {
                            $('#userrt').addClass('is-invalid');
                            $('.errorUserRt').html(err.errUserRt);
                        } else {
                            $('#userrt').removeClass('is-invalid');
                            $('#userrt').addClass('is-valid');
                        }

                        if (err.errUserRw) {
                            $('#userrw').addClass('is-invalid');
                            $('.errorUserRw').html(err.errUserRw);
                        } else {
                            $('#userrw').removeClass('is-invalid');
                            $('#userrw').addClass('is-valid');
                        }

                        if (err.errUserTelp) {
                            $('#usertelp').addClass('is-invalid');
                            $('.errorUserTelp').html(err.errUserTelp);
                        } else {
                            $('#usertelp').removeClass('is-invalid');
                            $('#usertelp').addClass('is-valid');
                        }

                    }

                    if (response.sukses) {
                        Swal.fire(
                            'Berhasil',
                            response.success,
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
    });
</script>

<script type="text/javascript">
    function checkInput(e, chars, field) {
        if (chars.indexOf(e.key) != -1) {
            return true;
        } else {
            return false;
        }
    }
</script>

<?= $this->endSection('isi') ?>