<?= $this->extend('template/layout') ?>


<?= $this->section('isi') ?>




<!-- text editor -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>

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

                <h5 class="modal-title" id="staticBackdropLabel">Input Product</h5>
            </div>
            <div class="card-body mt-1">
                <div class="table-responsive">

                    <form action="<?= base_url('product/simpan') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field(); ?>



                        <div class="form-group">
                            <label for="">Product</label>
                            <input type="text" name="prodnama" id="prodnama" class="form-control <?= ($validation->hasError('prodnama')) ? 'is-invalid' : '' ?>" value="<?= old('prodnama') ?>" placeholder="Enter Product..." autocomplete="off">
                            <div class="invalid-feedback"><?= $validation->getError('prodnama') ?></div>
                        </div>

                        <div class="form-group">
                            <label for="">Type</label>
                            <input type="text" name="prodtype" id="prodtype" class="form-control <?= ($validation->hasError('prodtype')) ? 'is-invalid' : '' ?>" value="<?= old('prodtype') ?>" placeholder="Enter Type Product..." autocomplete="off">
                            <div class="invalid-feedback"><?= $validation->getError('prodtype') ?></div>
                        </div>

                        <div class="form-group">
                            <label for="">Category</label>
                            <select name="prodkat" id="prodkat" class="form-control <?= ($validation->hasError('prodkat')) ? 'is-invalid' : '' ?>">
                                <option value="" selected>Select Category</option>
                                <?php foreach ($tampilkategori as $rowkat) : ?>
                                    <option value="<?= $rowkat['katid'] ?>"><?= $rowkat['katnama'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback"><?= $validation->getError('prodkat') ?></div>
                        </div>

                        <div class="form-group">
                            <label for="">Brand</label>
                            <select name="prodbrand" id="prodbrand" class="form-control <?= ($validation->hasError('prodbrand')) ? 'is-invalid' : '' ?>">
                                <option value="" selected>Select Brand</option>
                                <?php foreach ($tampilbrand as $rowbrand) : ?>
                                    <option value="<?= $rowbrand['brandid'] ?>"><?= $rowbrand['brandnama'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback"><?= $validation->getError('prodbrand') ?></div>
                        </div>

                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="proddeskripsi" id="proddeskripsi" class="form-control <?= ($validation->hasError('proddeskripsi')) ? 'is-invalid' : '' ?>"><?= old('proddeskripsi')  ?>
                            P :  mm<br>
                            L :  mm<br>
                            T :  mm<br>
                            Berat : - kg<br>
                            <br>
                            Deskripsi :

                            </textarea>
                            <div class="invalid-feedback"><?= $validation->getError('proddeskripsi') ?></div>
                        </div>

                        <div class="form-group">
                            <label for="">Price</label>
                            <input type="number" name="prodharga" id="prodharga" class="form-control <?= ($validation->hasError('prodharga')) ? 'is-invalid' : '' ?>" value="<?= old('prodharga') ?>" placeholder="Enter Price..." autocomplete="off">
                            <div class="invalid-feedback"><?= $validation->getError('prodharga') ?></div>
                        </div>

                        <div class="form-group">
                            <label for="">Stock</label>
                            <input type="number" name="prodstock" id="prodstock" class="form-control <?= ($validation->hasError('prodstock')) ? 'is-invalid' : '' ?>" value="<?= old('prodstock') ?>" placeholder="Enter Stock..." autocomplete="off">
                            <div class="invalid-feedback"><?= $validation->getError('prodstock') ?></div>
                        </div>

                        <div class="form-group">
                            <label for="">Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="prodgambar" name="prodgambar">
                                <label class="custom-file-label" for="prodgambar">Choose file</label>
                            </div>
                        </div>


                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-success">Save</button>
                            <a href="<?= base_url() ?>/product/index" class="btn btn-sm btn-danger u-inline">Cancel</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->


<script>
    $("textarea#proddeskripsi").summernote({
        placeholder: "Enter Description...",
        tabsize: 2,
        height: 100,
        toolbar: [
            ["style", ["style"]],
            ["font", ["bold", "italic", "underline", "clear"]],
            // ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
            //['fontname', ['fontname']],
            // ['fontsize', ['fontsize']],
            ["color", ["color"]],
            ["para", ["ul", "ol", "paragraph"]],
            ["height", ["height"]],
            ["table", ["table"]],
            ["insert", ["link", "picture", "hr"]],
            //['view', ['fullscreen', 'codeview']],
            ["help", ["help"]],
        ],
    });
</script>

<?= $this->endSection('isi') ?>