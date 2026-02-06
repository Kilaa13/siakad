<div class="pagetitle mb-4">
    <nav>
        <ol class="breadcrumb mb-1">
            <li class="breadcrumb-item"><a href="<?=site_url('dashboard')?>">Home</a></li>
            <li class="breadcrumb-item active">Absensi</li>
        </ol>
    </nav>
    <h1 style="color: #012970; font-weight: 700;"><?php echo $breadcrumb ?></h1>
</div>

<?php $flash_pesan = $this->session->flashdata('pesan'); ?>
<?php if (!empty($flash_pesan) || !empty($pesan)) : ?>
    <div class="alert alert-info alert-dismissible fade show border-0 shadow-sm" role="alert" style="background-color: #e7f1ff; color: #084298;">
        <i class="bi bi-info-circle me-2"></i>
        <?php echo $flash_pesan ? $flash_pesan : $pesan; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif ?>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
        <h5 class="card-title m-0 fw-bold" style="color: #012970;">Daftar Kehadiran</h5>
    </div>

    <div class="card-body mt-2">
        <div class="table-responsive">
            <?php if (!empty($tabel_data)) : ?>
                <div class="custom-table-container">
                    <?php echo $tabel_data; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <img src="<?=base_url('assets/img/news-1.jpg')?>" alt="No Data" class="img-fluid mb-3" style="max-width: 150px; opacity: 0.5; filter: grayscale(100%);">
                    <p class="text-muted fw-medium">Belum ada data absensi untuk ditampilkan.</p>
                </div>
            <?php endif ?>
        </div>

        <?php if (!empty($pagination)) : ?>
            <div class="d-flex justify-content-center mt-4">
                <nav aria-label="Page navigation">
                    <?php echo $pagination; ?>
                </nav>
            </div>
        <?php endif ?>
    </div>
</div>
