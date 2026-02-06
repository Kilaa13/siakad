<div class="pagetitle mb-4">
    <nav>
        <ol class="breadcrumb mb-1">
            <li class="breadcrumb-item"><a href="<?=site_url('dashboard')?>">Home</a></li>
            <li class="breadcrumb-item active">Rekapitulasi</li>
        </ol>
    </nav>
    <h1 style="color: #012970; font-weight: 700;"><?php echo $breadcrumb; ?></h1>
</div>

<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-4">
        <h5 class="card-title mb-3" style="color: #012970; font-size: 1rem;">Filter Laporan</h5>
        <?php echo form_open($form_action, ['class' => 'row g-3 align-items-center']); ?>
            <div class="col-md-4">
                <label class="form-label fw-bold">Pilih Kelas</label>
                <?php echo form_dropdown('id_kelas', $option_kelas, isset($form_value['id_kelas']) ? $form_value['id_kelas'] : '', 'class="form-select"'); ?>
            </div>
            
            <div class="col-md-4">
                <label class="form-label fw-bold">Pilih Mata Kuliah</label>
                <?php echo form_dropdown('kd_matkul', $option_matkul, isset($form_value['kd_matkul']) ? $form_value['kd_matkul'] : '', 'class="form-select"'); ?>
            </div>

            <div class="col-md-4 mt-md-4 pt-md-2">
                <button type="submit" name="submit" value="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                    <i class="bi bi-search me-1"></i> Tampilkan Rekap
                </button>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>

<?php if ($pesan) : ?>
    <div class="alert alert-warning border-0 shadow-sm" role="alert">
        <i class="bi bi-exclamation-triangle me-2"></i> <?php echo $pesan; ?>
    </div>
<?php endif; ?>

<?php if ($tabel_data): ?>
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center border-bottom">
            <h5 class="card-title m-0 fw-bold" style="color: #012970; font-size: 1.1rem;">
                Laporan Kelas: <span class="text-primary"><?php echo $kelas; ?></span> 
                <br>
                <small class="text-muted">Mata Kuliah: <b><?php echo $matkul; ?></b> (Semester <?php echo $id_semester; ?>)</small>
            </h5>
            <div class="btn-group">
                <div class="export-buttons">
        <?php if (!empty($tabel_data)): ?>
    <div class="mb-3">
        <a href="<?= $link_excel ?>" class="btn btn-success btn-sm">
            <i class="fa fa-file-excel"></i> Download Excel
        </a>
        
        <a href="<?= $link_pdf ?>" class="btn btn-danger btn-sm">
            <i class="fa fa-file-pdf"></i> Download PDF
        </a>
    </div>
<?php endif; ?>
                </div>
            </div>
        </div>
        <div class="card-body p-0"> 
            <div class="table-responsive p-3">
                <div>
                    <?php echo $tabel_data; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>