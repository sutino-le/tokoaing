<?= $this->extend('layout'); ?>

<?= $this->section('isi') ?>

<section class="bg-success py-5">
    <div class="container">
        <div class="row align-items-center py-5">
            <div class="col-md-12 text-white">
                <h1>COMPANY HISTORY</h1>
                <p align="justify">
                    Founded in the late 1980, initially we started as a home industry furniture that used raw materials of solid wood in the production process. At that time, the main activity of our business were to receive various orders, cooperate with small tenders, and customized furnishing to houses. The applied marketing way was still conventional, named door-to-door marketing. Along with the development of industry, we acquired a company in 1992 and merged it into an entity called PT Rackindo Setara Perkasa.
                </p>
                <p align="justify">
                    While running previous business, PT Rackindo Setara Perkasa started innovating to differentiate product as a new alternative for consumers. Our factory mass-produced knocked-down furnishings using Particle Board (PB), Medium Density Fibreboard (MDF) and laminated with paper or polyvinyl chloride (PVC). Our featured products were bedroom set (bed, nakkas, wardrobe, and dresser table), kitchen set, living room set (decorative cabinet), shoes rack, credenza, bookcase, coffee table and audio video rack. By the method of business-to-business (B2B), product marketing were done to furniture shops in Jakarta and Greater area (Jabodetabek). We also cooperated with outsourcing agents or distributors spread throughout the major cities in Indonesia.
                </p>
                <p align="justify">
                    In 2001 PT Rackindo Setara Perkasa did another acquisition with a furniture company in which it remained to survive today. Three companies merged under the name of Rackindo Group then had different segmenting, targeting and positioning in market for each business. Still in the same core business, namely furniture, PT Rackindo Setara Perkasa (Rackindo) remained to focus on home furniture market, while PT Mitra Rackindo Perkasa Gemilang (Mitra) had a segment of high-end office furnitureand PT Surya Citra Indah Perkasa (Sucitra) was directed to the low-end office furniture.
                </p>
            </div>
        </div>
    </div>
</section>

<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="#59ab6e" fill-opacity="1" d="M0,128L80,106.7C160,85,320,43,480,48C640,53,800,107,960,128C1120,149,1280,139,1360,133.3L1440,128L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z"></path>
</svg>

<div class="container-fluid text-center">
    <video controls width="1200" height="800" autoplay>
        <source src="<?= base_url() ?>/upload/graver.mp4" type="video/mp4" />
    </video>
</div>

<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="#59ab6e" fill-opacity="1" d="M0,192L48,208C96,224,192,256,288,272C384,288,480,288,576,261.3C672,235,768,181,864,176C960,171,1056,213,1152,229.3C1248,245,1344,235,1392,229.3L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
</svg>


<?php include "about_test.php"; ?>



<?= $this->endSection('isi') ?>