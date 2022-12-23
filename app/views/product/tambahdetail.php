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


        <div class="viewmodal" style="display: none;"></div>

        <div class="card">
            <div class="card-header">

                <h5 class="modal-title" id="staticBackdropLabel">Detail <a href="#" onclick="adddetail('<?= $prodid ?>')" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle"></i>
                        Add Detail</a></h5>

            </div>
            <div class="card-body mt-1">
                <div class="table-responsive">

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <?php foreach ($tampildetail->getResultArray() as $rowdatail) : ?>
                                    <div class="col-2 text-center mb-2">
                                        <img src="<?= base_url() ?>/upload/<?= $rowdatail['detprofoto'] ?>" class="img-thumbnail" width="100px" height="100px"><br>
                                        <a href="#" onclick="hapusdetail('<?= $rowdatail['detid'] ?>')" class="btn btn-sm btn-danger mt-1" title="hapus"><i class="fas fa-trash"></i></a>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

<script>
    // tombol edit foto
    function adddetail(prodid) {
        $.ajax({
            type: "post",
            url: "<?= base_url() ?>/product/adddetail/" + prodid,
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.viewmodal').html(response.data).show();
                    $('#modalAddDetail').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
            }
        });
    }

    function hapusdetail(detid) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url() ?>/product/hapusdetail/" + detid,
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
                            swal.fire(
                                'Success',
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
            }
        })

    }
</script>

<?= $this->endSection('isi') ?>