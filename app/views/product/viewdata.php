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
                <a href="<?= base_url() ?>/product/formtambah" class="btn btn-sm btn-primary"><i class="fas fa-plus-circle"></i>
                    Tambah Product</a>
            </div>
            <div class="card-body mt-1">
                <div class="table-responsive">

                    <table style="width: 100%;" id="dataProduct" class="table table-sm table-bordered table-hover dataTable dtr-inline collapsed">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Product</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->


<div class="viewmodal" style="display: none;"></div>

<script>
    function listDataProduct() {
        var table = $('#dataProduct').dataTable({
            destroy: true,
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url() ?>/product/listData",
                "type": "POST",
            },
            "colomnDefs": [{
                "targets": [0, 3],
                "orderable": false,
            }, ],
        });
    }

    $(document).ready(function() {
        listDataProduct();
    });


    function edit(prodid) {
        window.location.href = "<?= base_url() ?>/product/formedit/" + prodid;
    }

    function hapus(prodid) {
        Swal.fire({
            title: 'Anda yakin?',
            text: "ingin menghapus data ini...!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url() ?>/product/hapus/" + prodid,
                    dataType: "json",
                    success: function(response) {
                        if (response.sukses) {
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
            }
        })



    }
</script>

<?= $this->endSection('isi') ?>