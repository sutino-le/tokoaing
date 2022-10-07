<?= $this->extend('template/layout') ?>


<?= $this->section('isi') ?>

<style>
    figure {
        border: 1px #cccccc solid;
        padding: 4px;
        margin: auto;
    }

    figcaption {
        background-color: black;
        color: white;
        font-style: italic;
        padding: 2px;
        text-align: center;
    }
</style>


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

        <div class="col-12 d-flex align-items-stretch flex-column">
            <div class="card bg-light d-flex flex-fill">
                <div class="card-body mt-2">
                    <div class="row">
                        <div class="col-7">
                            <h2 class="lead"><b><?= $tampildata['perunama'] ?></b></h2>
                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                <li class="small mb-3"><span class="fa-li"><i class="fas fa-map-marker"></i></span><?= $tampildata['perualamat'] ?></li>
                                <li class="small mb-3"><span class="fa-li"><i class="fas fa-map-marked-alt"></i></span><a class="text-decoration-none" href="<?= $tampildata['perualamatlink'] ?>" target="_blank"><?= $tampildata['perualamatlink'] ?></a></li>
                                <li class="small mb-3"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span><a class="text-decoration-none" href="tel:<?= $tampildata['perutelp'] ?>"><?= $tampildata['perutelp'] ?></a></li>
                                <li class="small mb-3"><span class="fa-li"><i class="fas fa-fax"></i></span><a class="text-decoration-none" href="fax:<?= $tampildata['perufax'] ?>"><?= $tampildata['perufax'] ?></a></li>
                                <li class="small mb-3"><span class="fa-li"><i class="fas fa-mail-bulk"></i></span><a class="text-decoration-none" href="mailto:<?= $tampildata['peruemail'] ?>"><?= $tampildata['peruemail'] ?></a></li>
                                <li class="small mb-3"><span class="fa-li"><i class="fab fa-whatsapp"></i></span><a class="text-decoration-none" href="https://wa.me/<?= $tampildata['peruwa'] ?>?text=Halo Graver..." target="_blank"><?= $tampildata['peruwa'] ?></a></li>
                            </ul>
                        </div>
                        <div class="col-5 text-center">
                            <button class="btn close" title="Edit Gambar" onclick="editgambar('<?= $tampildata['peruid'] ?>')"><i class=" fas fa-edit text-success"></i></button>




                            <figure>
                                <div class="row">
                                    <div class="col">
                                        <img src="<?= base_url() ?>/upload/<?= $tampildata['peruicon'] ?>" alt="Icon Perusahaan" class="img-fluid m-2" width="200px" height="200px" title="Icon Perusahaan">
                                        <figcaption>Icon Perusahaan</figcaption>
                                    </div>
                                    <div class="col">
                                        <img src="<?= base_url() ?>/upload/<?= $tampildata['perufoto'] ?>" alt="Foto Perusahaan" class="img-fluid m-2" width="200px" height="200px" title="Foto Perusahaan">
                                        <figcaption>Foto Perusahaan</figcaption>
                                    </div>
                                </div>
                            </figure>


                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="text-right">
                        <a href="#" class="btn btn-sm btn-primary" onclick="edit('<?= $tampildata['peruid'] ?>')">
                            <i class="fas fa-city"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->


<div class="viewmodal" style="display: none;"></div>

<script>
    function edit(peruid) {
        $.ajax({
            type: "post",
            url: "<?= base_url() ?>/perusahaan/formedit/" + peruid,
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


    function editgambar(peruid) {
        $.ajax({
            type: "post",
            url: "<?= base_url() ?>/perusahaan/formeditgambar/" + peruid,
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.viewmodal').html(response.data).show();
                    $('#modalEditGambar').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
            }
        });
    }
</script>

<?= $this->endSection('isi') ?>