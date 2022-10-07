<!-- Modal -->
<div class="modal fade" id="modalTambah" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">


            <form action="<?= base_url('user/simpan') ?>" class="formsimpan">
                <?= csrf_field(); ?>

                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="staticBackdropLabel">Input User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="">User ID</label>
                        <input type="email" name="userid" id="userid" class="form-control" placeholder="Masukan User ID..." autocomplete="off">
                        <div class="invalid-feedback errorUserId"></div>
                    </div>

                    <div class="form-group">
                        <label for="">Nama Lengkap</label>
                        <input type="text" name="usernama" id="usernama" class="form-control" placeholder="Masukan Nama Lengkap..." autocomplete="off">
                        <div class="invalid-feedback errorUserNama"></div>
                    </div>

                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="text" name="userpassword" id="userpassword" class="form-control" placeholder="Masukan Password..." autocomplete="off">
                        <div class="invalid-feedback errorUserPassword"></div>
                    </div>

                    <div class="form-group">
                        <label for="">Level</label>
                        <select name="userlevel" id="userlevel" class="form-control">
                            <option value="" selected>Pilih Level</option>
                            <option value=""></option>
                            <?php foreach ($datalevel as $rowlevel) : ?>
                                <option value="<?= $rowlevel['levelid'] ?>"><?= $rowlevel['levelnama'] ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback errorUserLevel"></div>
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

<script>
    function kosong() {
        $('#userid').val('');
        $('#usernama').val('');
        $('#userpassword').val('');
        $('#userlevel').val('');
    }

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

                        if (err.errUserId) {
                            $('#userid').addClass('is-invalid');
                            $('.errorUserId').html(err.errUserId);
                        } else {
                            $('#userid').removeClass('is-invalid');
                            $('#userid').addClass('is-valid');
                        }

                        if (err.errUserNama) {
                            $('#usernama').addClass('is-invalid');
                            $('.errorUserNama').html(err.errUserNama);
                        } else {
                            $('#usernama').removeClass('is-invalid');
                            $('#usernama').addClass('is-valid');
                        }

                        if (err.errUserPassword) {
                            $('#userpassword').addClass('is-invalid');
                            $('.errorUserPassword').html(err.errUserPassword);
                        } else {
                            $('#userpassword').removeClass('is-invalid');
                            $('#userpassword').addClass('is-valid');
                        }

                        if (err.errUserLevel) {
                            $('#userlevel').addClass('is-invalid');
                            $('.errorUserLevel').html(err.errUserLevel);
                        } else {
                            $('#userlevel').removeClass('is-invalid');
                            $('#userlevel').addClass('is-valid');
                        }
                    }

                    if (response.sukses) {

                        let data = response.sukses;

                        let userid = data.userid;
                        let usernama = data.usernama;

                        $.ajax({
                            type: "post",
                            url: "<?= base_url() ?>/user/kirimverifikasi",
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

        $('#batal').click(function(e) {
            e.preventDefault();
            window.location.reload();
        });

    });
</script>