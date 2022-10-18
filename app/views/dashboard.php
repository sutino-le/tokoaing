<?= $this->extend('layout'); ?>

<?= $this->section('isi') ?>
<?= csrf_field(); ?>

<div class="row tampilBaner">

</div>


<section class="container py-5">
    <div class="row text-center pt-3">
        <div class="col-lg-6 m-auto">
            <h1 class="h1">Kategori</h1>
        </div>
    </div>
    <div class="row">
        <?php foreach ($databranch as $rowDataBranch) : ?>
            <div class="col-12 col-md-4 p-5 mt-3">
                <a href="#"><img src="<?= base_url() ?>/assets/img/<?= $rowDataBranch['branchgambar'] ?>" class="rounded img-fluid"></a>
                <h5 class="text-center mt-3 mb-3"><?= ucwords(strtolower($rowDataBranch['branchnama'])) ?></h5>
                <p class="text-center"><a class="btn btn-success" href="<?= base_url() ?>/home/katalog">Pergi Belanja</a></p>
            </div>
        <?php endforeach ?>
    </div>
</section>



<script>
    function tampilBaner() {
        $.ajax({
            url: "<?= base_url() ?>/home/tampilBaner",
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.tampilBaner').html(response.data);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + thrownError);
            }
        });
    }

    $(document).ready(function() {
        tampilBaner();
    });
</script>


<?= $this->endSection('isi') ?>