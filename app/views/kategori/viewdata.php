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
                <button type="button" class="btn btn-sm btn-primary" id="tambahKategori"><i class="fas fa-plus-circle"></i>
                    Tambah Kategori</button>
            </div>
            <div class="card-body mt-1">
                <div class="table-responsive">

                    <table style="width: 100%;" id="dataKategori" class="table table-sm table-bordered table-hover dataTable dtr-inline collapsed">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori ID</th>
                                <th>Kategori Nama</th>
                                <th>Aksi</th>
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



<?= $this->endSection('isi') ?>