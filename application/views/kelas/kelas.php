<div class="pagetitle mb-4">
    <nav>
        <ol class="breadcrumb mb-1">
            <li class="breadcrumb-item"><a href="<?=site_url('dashboard')?>">Home</a></li>
            <li class="breadcrumb-item active">Kelas</li>
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
        <h5 class="card-title m-0 fw-bold" style="color: #012970; font-size: 1.1rem;">Daftar Kelas</h5>
        
        <a href="<?=site_url('kelas/tambah/')?>" class="btn btn-primary btn-sm rounded-pill px-3 shadow-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah Kelas
        </a>
    </div>

    <div class="card-body mt-2">
        <div class="table-responsive">
            <?php if (!empty($tabel_data)) : ?>
                <div>
                    <?php echo $tabel_data; ?>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="bi bi-door-closed text-muted" style="font-size: 3rem; opacity: 0.3;"></i>
                    <p class="mt-2 text-muted fw-medium">Belum ada data kelas yang terdaftar.</p>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>
