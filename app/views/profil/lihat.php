<?= $this->extend('layout'); ?>

<?= $this->section('isi') ?>
<style>
    * {
        margin: 0;
        padding: 0
    }


    .card {
        width: 800px;
        background-color: #efefef;
        border: none;
        cursor: pointer;
        transition: all 0.5s;
    }

    .image img {
        transition: all 0.5s
    }

    .card:hover .image img {
        transform: scale(1.5)
    }
</style>



<div class="container mt-4 mb-4 p-3 d-flex justify-content-center">
    <div class="card p-4">
        <div class="image d-flex flex-column justify-content-center align-items-center">
            <table class="table table-striped">
                <thead>
                    <tr align="center">
                        <th>
                            <img src="<?= base_url() ?>/upload/<?= $userfoto ?>" width="200px" height="300px" class="image rounded-circle" onclick="gantifoto('<?= $userid ?>')">
                            <br>
                            <br>
                        </th>
                    </tr>
                </thead>
            </table>
        </div>

        <!-- Control the column width, and how they should appear on different devices -->
        <div class="row mb-2">
            <div class="col-sm-6 text-left bg-success">
                <h6 class="mt-1">Nama Lengkap</h6>
            </div>
            <div class="col-sm-6 text-right" style="background-color:LightGray;">
                <h6 class=" mt-1" onclick="gantinama('<?= $userid ?>')"><?= $usernama ?></h6>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-6 text-left bg-success">
                <h6 class="mt-1">Email</h6>
            </div>
            <div class="col-sm-6 text-right" style="background-color:LightGray;">
                <h6 class=" mt-1" onclick="gantinama('<?= $userid ?>')"><?= $userid ?></h6>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-6 text-left bg-success">
                <h6 class="mt-1">Jenis Kelamin</h6>
            </div>
            <div class="col-sm-6 text-right" style="background-color:LightGray;">
                <h6 class=" mt-1" onclick="gantinama('<?= $userid ?>')"><?= $usergender ?></h6>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-6 text-left bg-success">
                <h6 class="mt-1">Tanggal Lahir</h6>
            </div>
            <div class="col-sm-6 text-right" style="background-color:LightGray;">
                <h6 class=" mt-1" onclick="gantinama('<?= $userid ?>')"><?= date('d-m-Y', strtotime($userlahir)) ?></h6>
            </div>
        </div>
        <hr>
        <div class="row mb-2">
            <div class="col-sm-6 text-left bg-success">
                <h6 class="mt-1">Alamat</h6>
            </div>
            <div class="col-sm-6 text-right" style="background-color:LightGray;">
                <h6 class=" mt-1" onclick="gantialamat('<?= $userid ?>')"><?= $useralamat ?>, RT/RW <?= $userrt . '/' . $userrw ?></h6>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-6 text-left bg-success">
                <h6 class="mt-1">Kelurahan</h6>
            </div>
            <div class="col-sm-6 text-right" style="background-color:LightGray;">
                <h6 class=" mt-1"><?= $kelurahan ?></h6>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-6 text-left bg-success">
                <h6 class="mt-1">Kecamatan</h6>
            </div>
            <div class="col-sm-6 text-right" style="background-color:LightGray;">
                <h6 class=" mt-1"><?= $kecamatan ?></h6>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-6 text-left bg-success">
                <h6 class="mt-1">Kota/Kabupaten</h6>
            </div>
            <div class="col-sm-6 text-right" style="background-color:LightGray;">
                <h6 class=" mt-1"><?= $kota_kabupaten ?></h6>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-6 text-left bg-success">
                <h6 class="mt-1">Propinsi</h6>
            </div>
            <div class="col-sm-6 text-right" style="background-color:LightGray;">
                <h6 class=" mt-1"><?= $propinsi ?></h6>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-6 text-left bg-success">
                <h6 class="mt-1">Kode Pos</h6>
            </div>
            <div class="col-sm-6 text-right" style="background-color:LightGray;">
                <h6 class=" mt-1"><?= $kodepos ?></h6>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-6 text-left bg-success">
                <h6 class="mt-1">Nomor HP</h6>
            </div>
            <div class="col-sm-6 text-right" style="background-color:LightGray;">
                <h6 class=" mt-1"><?= $usertelp ?></h6>
            </div>
        </div>
        <div class="row mb-2">
            <button type="submit" id="editProfil" class="btn btn-block btn-primary btn-lg"><i class="fas fa-edit"></i> Edit Profil</button>
        </div>
    </div>
</div>

<div class="viewmodal" style="display: none;"></div>

<input type="hidden" name="userprofil" id="userprofil" value="<?= sha1(session()->iduser) ?>">

<script>
    $(document).ready(function() {
        $('#editProfil').click(function(e) {
            e.preventDefault();

            let user = $('#userprofil').val();

            window.location.href = "<?= base_url() ?>/profil/editprofil/" + user;
        });
    });
</script>

<?= $this->endSection('isi') ?>