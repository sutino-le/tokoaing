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
                <button type="button" class="btn btn-sm btn-primary" id="tambahUsers"><i class="fas fa-plus-circle"></i>
                    Tambah User</button>
            </div>
            <div class="card-body mt-1">
                <div class="table-responsive">

                    <table style="width: 100%;" id="dataUsers" class="table table-sm table-bordered table-hover dataTable dtr-inline collapsed">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>User ID</th>
                                <th>Nama</th>
                                <th>Level</th>
                                <th>Status</th>
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
    function listDataUsers() {
        var table = $('#dataUsers').dataTable({
            destroy: true,
            "processing": true,
            "serverSide": true,
            "order": [],
            "ajax": {
                "url": "<?= base_url() ?>/user/listData",
                "type": "POST",
            },
            "colomnDefs": [{
                "targets": [0, 5],
                "orderable": false,
            }, ],
        });
    }

    $(document).ready(function() {
        listDataUsers();
    });


    $(document).ready(function() {

        $('#tambahUsers').click(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "<?= base_url() ?>/user/formtambah",
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

    function edit(userid) {
        $.ajax({
            type: "post",
            url: "<?= base_url() ?>/user/formedit/" + userid,
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

    function hapus(userid) {
        Swal.fire({
            title: 'Opss...',
            text: "Apakah anda ingin menghapus data user ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url() ?>/user/hapus/" + userid,
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
            } else {
                window.location.reload();
            }
        })


    }
</script>


<?= $this->endSection('isi') ?>