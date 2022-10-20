<?= $this->extend('template/layout') ?>


<?= $this->section('isi') ?>


<!-- SELECT2 EXAMPLE -->
<div class="card card-default">
    <div class="card-header bg-success">
        <h3 class="card-title"><?= $title ?></h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus text-white"></i>
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">

        <div class="card">
            <div class="card-header">

                <h5 class="modal-title" id="staticBackdropLabel">Edit Brand</h5>
            </div>
            <div class="card-body mt-1">
                <div class="table-responsive">

                    <form action="<?= base_url('brand/updatedata') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>

                        <input type="hidden" name="brandid" id="brandid" value="<?= $brandid ?>">

                        <div class="form-group">
                            <label for="">Brand</label>
                            <input type="text" name="brandnama" id="brandnama" class="form-control <?= ($validation->hasError('brandnama')) ? 'is-invalid' : '' ?>" value="<?= ($validation->hasError('brandnama')) ? old('brandnama')  :  $brandnama ?>" placeholder="Masukan Brand..." autocomplete="off">

                            <div class="invalid-feedback"><?= $validation->getError('brandnama') ?></div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-4">
                                    <img src="<?= base_url() ?>/upload/<?= $brandgambar ?>" alt="<?= $brandgambar ?>" width="350px">
                                </div>
                                <div class="col-8">
                                    <label for="">Gambar</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="brandgambar" name="brandgambar">
                                        <label class="custom-file-label" for="brandgambar">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
                            <a href="<?= base_url() ?>/brand/index" class="btn btn-sm btn-danger u-inline">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->






<?= $this->endSection('isi') ?>