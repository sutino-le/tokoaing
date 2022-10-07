<?= csrf_field(); ?>


<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <?php
        foreach ($tampildata as $rowBaner) :
        ?>
            <div class="carousel-item <?= $rowBaner['banerclass'] ?>" style="background-image: url(<?= base_url() ?>/assets/img/<?= $rowBaner['banerbackground'] ?>); background-repeat: no-repeat; background-size: cover; background-position: center; width:100%">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="<?= base_url() ?>/assets/img/<?= $rowBaner['banerfoto'] ?>" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <h1 class="h1 text-black"><b><?= $rowBaner['banernama'] ?></b><?= $rowBaner['banerjudul'] ?></h1>
                                <h3 class="h2"><?= $rowBaner['banersubjudul'] ?></h3>
                                <p>
                                    <?= $rowBaner['banerdeskripsi'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
    <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
        <i class="fas fa-chevron-left"></i>
    </a>
    <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
        <i class="fas fa-chevron-right"></i>
    </a>
</div>