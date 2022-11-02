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

                <h5 class="modal-title" id="staticBackdropLabel">Input Brand</h5>
            </div>
            <div class="card-body mt-1">
                <div class="table-responsive">

                    <form action="<?= base_url('brand/simpan') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>



                        <div class="form-group">
                            <label for="">Brand</label>
                            <input type="text" name="brandnama" id="brandnama" class="form-control <?= ($validation->hasError('brandnama')) ? 'is-invalid' : '' ?>" value="<?= old('brandnama') ?>" placeholder="Enter Brand..." autocomplete="off">

                            <div class="invalid-feedback"><?= $validation->getError('brandnama') ?></div>
                        </div>

                        <div class="form-group">
                            <label for="">Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="brandgambar" name="brandgambar">
                                <label class="custom-file-label" for="brandgambar">Choose file</label>
                            </div>
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-success">Save</button>
                            <a href="<?= base_url() ?>/brand/index" class="btn btn-sm btn-danger u-inline">Cancel</a>
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