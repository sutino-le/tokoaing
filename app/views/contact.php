<?= $this->extend('layout'); ?>

<?= $this->section('isi') ?>
<?= csrf_field(); ?>

<!-- Start Contact -->
<div class="container py-5">
    <div class="row py-5">

        <form action="<?= base_url('home/simpanpesan') ?>" class="formsimpan">
            <?= csrf_field(); ?>


            <div class="row">
                <div class="form-group col-md-6 mb-3">
                    <label for="inputname">Nama Lengkap</label>
                    <input type="text" class="form-control mt-1" id="sernama" name="sernama" placeholder="Name" autocomplete="off">
                    <div class="invalid-feedback errorSernama"></div>
                </div>

                <div class="form-group col-md-6 mb-3">
                    <label for="inputemail">Email</label>
                    <input type="email" class="form-control mt-1" id="seremail" name="seremail" placeholder="Email" autocomplete="off">
                    <div class="invalid-feedback errorSeremail"></div>
                </div>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Judul</label>
                <input type="text" class="form-control mt-1" id="sersubject" name="sersubject" placeholder="Subject" autocomplete="off">
                <div class="invalid-feedback errorSersubject"></div>
            </div>
            <div class="mb-3">
                <label for="inputmessage">Pesan</label>
                <textarea class="form-control mt-1" id="serisi" name="serisi" placeholder="Message" rows="8" autocomplete="off"></textarea>
                <div class="invalid-feedback errorSerisi"></div>
            </div>
            <div class="row">
                <div class="col text-end mt-2">
                    <button type="submit" class="btn btn-success btn-lg px-3">Kirim</button>
                </div>
            </div>
        </form>


    </div>
</div>
<!-- End Contact -->


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

                        if (err.errSernama) {
                            $('#sernama').addClass('is-invalid');
                            $('.errorSernama').html(err.errSernama);
                        } else {
                            $('#sernama').removeClass('is-invalid');
                            $('#sernama').addClass('is-valid');
                        }

                        if (err.errSeremail) {
                            $('#seremail').addClass('is-invalid');
                            $('.errorSeremail').html(err.errSeremail);
                        } else {
                            $('#seremail').removeClass('is-invalid');
                            $('#seremail').addClass('is-valid');
                        }

                        if (err.errSersubject) {
                            $('#sersubject').addClass('is-invalid');
                            $('.errorSersubject').html(err.errSersubject);
                        } else {
                            $('#sersubject').removeClass('is-invalid');
                            $('#sersubject').addClass('is-valid');
                        }

                        if (err.errSerisi) {
                            $('#serisi').addClass('is-invalid');
                            $('.errorSerisi').html(err.errSerisi);
                        } else {
                            $('#serisi').removeClass('is-invalid');
                            $('#serisi').addClass('is-valid');
                        }
                    }

                    if (response.sukses) {

                        Swal.fire(
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


<?= $this->endSection('isi') ?>