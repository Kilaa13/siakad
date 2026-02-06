<?php

$attr_nim = [
    'name'        => 'nim',
    'id'          => 'nim',
    'class'       => 'form-control',
    'placeholder' => 'Masukkan NIM',
    'value'       => set_value('nim', isset($form_value['nim']) ? $form_value['nim'] : '')
];

$attr_tanggal = [
    'name'        => 'tanggal',
    'id'          => 'tanggal',
    'class'       => 'form-control', 
    'type'        => 'date',
    'value'       => set_value('tanggal', isset($form_value['tanggal']) ? $form_value['tanggal'] : date('Y-m-d'))
];

$attr_submit = [
    'name'  => 'submit',
    'id'    => 'submit',
    'class' => 'btn btn-primary rounded-pill px-4 shadow-sm',
    'value' => 'Simpan Data'
];
?>

<div class="pagetitle mb-4">
    <nav>
        <ol class="breadcrumb mb-1">
            <li class="breadcrumb-item"><a href="<?=site_url('dashboard')?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?=site_url('absen')?>">Absensi</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </nav>
    <h1 style="color: #012970; font-weight: 700;"><?php echo $breadcrumb ?></h1>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <h5 class="card-title mb-4" style="color: #012970; font-size: 1.2rem;">Input Kehadiran Mahasiswa</h5>

                <?php if (!empty($pesan)) : ?>
                    <div class="alert alert-info alert-dismissible fade show border-0" role="alert">
                        <i class="bi bi-info-circle me-2"></i> <?php echo $pesan; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif ?>

                <?php echo form_open($form_action, ['class' => 'row g-3']); ?>
                    
                <div class="mb-3">
                    <label class="form-label text-muted">Nomor Induk Mahasiswa (NIM)</label>
                    <input type="text" name="nim" class="form-control bg-light" 
                        value="<?= $mhs->nim ?>" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted">Nama Lengkap</label>
                    <input type="text" class="form-control bg-light" 
                        value="<?= $mhs->nama ?>" readonly>
                </div>

                    <div class="col-md-6">
                        <label for="tanggal" class="form-label fw-bold">Tanggal</label>
                        <?php echo form_input($attr_tanggal); ?>
                        <?php echo form_error('tanggal', '<small class="text-danger mt-1 d-block">', '</small>'); ?>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold d-block mb-2">Status Absen</label>
                        <div class="d-flex flex-wrap gap-3 p-3 bg-light rounded-3">
                            <div class="form-check">
                                <?php echo form_radio('absen', 'H', set_radio('absen', 'H', (isset($form_value['absen']) && $form_value['absen'] == 'H')), 'class="form-check-input" id="abs-h"'); ?>
                                <label class="form-check-label" for="abs-h">Hadir</label>
                            </div>
                            <div class="form-check">
                                <?php echo form_radio('absen', 'S', set_radio('absen', 'S', (isset($form_value['absen']) && $form_value['absen'] == 'S')), 'class="form-check-input" id="abs-s"'); ?>
                                <label class="form-check-label" for="abs-s">Sakit</label>
                            </div>
                            <div class="form-check">
                                <?php echo form_radio('absen', 'I', set_radio('absen', 'I', (isset($form_value['absen']) && $form_value['absen'] == 'I')), 'class="form-check-input" id="abs-i"'); ?>
                                <label class="form-check-label" for="abs-i">Izin</label>
                            </div>
                            <div class="form-check">
                                <?php echo form_radio('absen', 'A', set_radio('absen', 'A', (isset($form_value['absen']) && $form_value['absen'] == 'A')), 'class="form-check-input" id="abs-a"'); ?>
                                <label class="form-check-label" for="abs-a">Alpha</label>
                            </div>
                            <div class="form-check">
                                <?php echo form_radio('absen', 'T', set_radio('absen', 'T', (isset($form_value['absen']) && $form_value['absen'] == 'T')), 'class="form-check-input" id="abs-t"'); ?>
                                <label class="form-check-label" for="abs-t">Terlambat</label>
                            </div>
                        </div>
                        <?php echo form_error('absen', '<small class="text-danger mt-1 d-block">', '</small>'); ?>
                    </div>

                    <div class="col-12">
                        <label for="kd_matkul" class="form-label fw-bold">Mata Kuliah</label>
                        <?php 
                            echo form_dropdown('kd_matkul', $option_matkul, set_value('kd_matkul', isset($form_value['kd_matkul']) ? $form_value['kd_matkul'] : ''), 'class="form-select" id="kd_matkul"'); 
                        ?>
                        <?php echo form_error('kd_matkul', '<small class="text-danger mt-1 d-block">', '</small>'); ?>
                    </div>

                    <div class="col-12 mt-4 pt-3 border-top">
                        <?php echo form_submit($attr_submit); ?>
                        <a href="<?=site_url('absen')?>" class="btn btn-warning rounded-pill px-4 ms-2 shadow-sm text-dark">Batal</a>
                    </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>