<!-- Modal -->
<div class="modal fade" id="modalEdit" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">


            <form action="<?= base_url('brand/updatedata') ?>" class="formsimpan">
                <?= csrf_field(); ?>

                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="staticBackdropLabel">Edit Brand</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">


                    <input type="hidden" name="katidlama" id="katidlama" value="<?= $katid ?>">

                    <div class="form-group">
                        <label for="">Brand</label>
                        <input type="text" name="brandnama" id="brandnama" value="<?= $brandnama ?>" class="form-control" placeholder="Masukan Brand...">
                        <div class="invalid-feedback errorBrandNama"></div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <img src="<?= base_url() ?>/upload/<?= $brandgambar ?>" alt="<?= $brandgambar ?>" width="20px" height="20px">
                            </div>
                        </div>
                        <label for="">Brand</label>
                        <input type="file" name="brandgambar" id="brandgambar" class="form-control">
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
        $('#brandnama').val('');
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

                        if (err.errBrandNama) {
                            $('#brandnama').addClass('is-invalid');
                            $('.errorBrandNama').html(err.errBrandNama);
                        } else {
                            $('#brandnama').removeClass('is-invalid');
                            $('#brandnama').addClass('is-valid');
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