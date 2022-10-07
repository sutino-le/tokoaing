<?= $this->extend('layout'); ?>

<?= $this->section('isi') ?>
<?= csrf_field(); ?>

<!-- Start Contact -->
<div class="container py-5">
    <div class="row py-5">
        <form class="col-md-9 m-auto" method="post" role="form">
            <div class="row">
                <div class="form-group col-md-6 mb-3">
                    <label for="inputname">Nama Lengkap</label>
                    <input type="text" class="form-control mt-1" id="name" name="name" placeholder="Name">
                </div>
                <div class="form-group col-md-6 mb-3">
                    <label for="inputemail">Email</label>
                    <input type="email" class="form-control mt-1" id="email" name="email" placeholder="Email">
                </div>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Judul</label>
                <input type="text" class="form-control mt-1" id="subject" name="subject" placeholder="Subject">
            </div>
            <div class="mb-3">
                <label for="inputmessage">Pesan</label>
                <textarea class="form-control mt-1" id="message" name="message" placeholder="Message" rows="8"></textarea>
            </div>
            <div class="row">
                <div class="col text-end mt-2">
                    <button type="button" class="btn btn-success btn-lg px-3" onclick="kirimkanPesan('')">Kirim</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Contact -->


<script>
    function kirimkanPesan() {
        Swal.fire({
            title: 'Maaf...',
            text: 'Kami sedang mengembangkan tahap ini.',
            imageUrl: '<?= base_url() ?>/assets/img/maintenance.gif',
            imageWidth: 400,
            imageHeight: 200,
            imageAlt: 'Custom image',
        })
    }
</script>


<?= $this->endSection('isi') ?>