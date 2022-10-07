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
                <button type="button" class="btn btn-sm btn-primary" id="tambahLevels"><i class="fas fa-plus-circle"></i>
                    Tambah Levels</button>
            </div>
            <div class="card-body mt-1">
                <div class="table-responsive">

                    <table style="width: 100%;" id="dataLevels" class="table table-sm table-bordered table-hover dataTable dtr-inline collapsed">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Levels ID</th>
                                <th>Levels Nama</th>
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

<script>
    function listDataLevels() {
        var table = $('#dataLevels').dataTable({
            destroy: true,
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url() ?>/level/listData",
                "type": "POST",
            },
            "colomnDefs": [{
                "targets": [0, 3],
                "orderable": false,
            }, ],
        });
    }

    $(document).ready(function() {
        listDataLevels();
    });


    $(document).ready(function() {

        $('#tambahLevels').click(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "<?= base_url() ?>/level/formtambah",
                dataType: "json",
                success: function(response) {
                    if (response.data) {
                        $('.viewmodal').html(response.data).show();
                        $('#modalTambah').modal('show');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + '\n' + thrownError);
                }
            });
        });

    });

    function edit(levelid) {
        $.ajax({
            type: "post",
            url: "<?= base_url() ?>/level/formedit/" + levelid,
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.viewmodal').html(response.data).show();
                    $('#modalEdit').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
            }
        });
    }

    function hapus(levelid) {
        $.ajax({
            url: "<?= base_url() ?>/level/hapus/" + levelid,
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
</script>


<?= $this->endSection('isi') ?>