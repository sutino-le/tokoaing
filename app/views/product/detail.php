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

            </div>
            <div class="card-body mt-1">
                <div class="table-responsive">

                    <table style="width: 100%;" id="detailProduct" class="table table-sm table-bordered table-hover dataTable dtr-inline collapsed">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Product</th>
                                <th>Image Detail</th>
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
    function listDetailProduct() {
        var table = $('#detailProduct').dataTable({
            destroy: true,
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url() ?>/product/listDetail",
                "type": "POST",
            },
            "colomnDefs": [{
                "targets": [0, 3],
                "orderable": false,
            }, ],
        });
    }

    $(document).ready(function() {
        listDetailProduct();
    });
</script>

<?= $this->endSection('isi') ?>