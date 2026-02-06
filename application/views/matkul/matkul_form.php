<?php
$form = array(
    'kd_matkul' => array(
        'name'        => 'kd_matkul',
        'id'          => 'kd_matkul',
        'class'       => 'form-control',
        'placeholder' => 'Contoh: INF01',
        'value'       => set_value('kd_matkul', isset($form_value['kd_matkul']) ? $form_value['kd_matkul'] : '')
    ),
    'matkul' => array(
        'name'        => 'matkul',
        'id'          => 'matkul',
        'class'       => 'form-control',
        'placeholder' => 'Nama Mata Kuliah',
        'value'       => set_value('matkul', isset($form_value['matkul']) ? $form_value['matkul'] : '')
    ),
    'jm_sks' => array(
        'name'        => 'jm_sks',
        'id'          => 'jm_sks',
        'type'        => 'number',
        'class'       => 'form-control',
        'placeholder' => '0',
        'value'       => set_value('jm_sks', isset($form_value['jm_sks']) ? $form_value['jm_sks'] : '')
    ),
    // Input Baru: Jam
    'jam' => array(
        'name'        => 'jam',
        'id'          => 'jam',
        'class'       => 'form-control',
        'placeholder' => 'Contoh: 08:00 - 10:30',
        'value'       => set_value('jam', isset($form_value['jam']) ? $form_value['jam'] : '')
    ),
    // Input Baru: Ruangan
    'ruangan' => array(
        'name'        => 'ruangan',
        'id'          => 'ruangan',
        'class'       => 'form-control',
        'placeholder' => 'Contoh: LAB-01 atau R.302',
        'value'       => set_value('ruangan', isset($form_value['ruangan']) ? $form_value['ruangan'] : '')
    ),
    'submit' => array(
        'name'  => 'submit',
        'id'    => 'submit',
        'class' => 'btn btn-primary rounded-pill px-4 shadow-sm',
        'value' => 'Simpan Data'
    )
);
?>

<div class="pagetitle mb-4">
    <nav>
        <ol class="breadcrumb mb-1">
            <li class="breadcrumb-item"><a href="<?=site_url('dashboard')?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?=site_url('matkul')?>">Mata Kuliah</a></li>
            <li class="breadcrumb-item active">Form</li>
        </ol>
    </nav>
    <h1 style="color: #012970; font-weight: 700;"><?php echo $breadcrumb ?></h1>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <h5 class="card-title mb-4" style="color: #012970; font-size: 1.2rem;">Detail Jadwal Mata Kuliah</h5>

                <?php if ($this->session->flashdata('pesan')) : ?>
                    <div class="alert alert-success border-0 shadow-sm mb-4">
                        <i class="bi bi-check-circle me-2"></i> <?php echo $this->session->flashdata('pesan'); ?>
                    </div>
                <?php endif ?>

                <?php echo form_open($form_action, ['class' => 'row g-3']); ?>
                    
                    <div class="col-md-4">
                        <label for="kd_matkul" class="form-label fw-bold">Kode Mata Kuliah</label>
                        <?php echo form_input($form['kd_matkul']); ?>
                        <?php echo form_error('kd_matkul', '<small class="text-danger mt-1 d-block">', '</small>'); ?>
                    </div>

                    <div class="col-md-8">
                        <label for="matkul" class="form-label fw-bold">Nama Mata Kuliah</label>
                        <?php echo form_input($form['matkul']); ?>
                        <?php echo form_error('matkul', '<small class="text-danger mt-1 d-block">', '</small>'); ?>
                    </div>

                    <div class="col-md-4">
                        <label for="jm_sks" class="form-label fw-bold">SKS</label>
                        <?php echo form_input($form['jm_sks']); ?>
                        <?php echo form_error('jm_sks', '<small class="text-danger mt-1 d-block">', '</small>'); ?>
                    </div>

                    <div class="col-md-8">
                        <label for="id_dosen" class="form-label fw-bold">Dosen Pengampu</label>
                        <?php echo form_dropdown('id_dosen', $option_dosen, set_value('id_dosen', isset($form_value['id_dosen']) ? $form_value['id_dosen'] : ''), 'class="form-select" id="id_dosen"'); ?>
                        <?php echo form_error('id_dosen', '<small class="text-danger mt-1 d-block">', '</small>'); ?>
                    </div>

                    <div class="col-md-6">
                        <label for="jam" class="form-label fw-bold">Waktu</label>
                        <?php echo form_input($form['jam']); ?>
                        <?php echo form_error('jam', '<small class="text-danger mt-1 d-block">', '</small>'); ?>
                    </div>

                    <div class="col-md-6">
                        <label for="ruangan" class="form-label fw-bold">Ruangan / Lokasi</label>
                        <?php echo form_input($form['ruangan']); ?>
                        <?php echo form_error('ruangan', '<small class="text-danger mt-1 d-block">', '</small>'); ?>
                    </div>

                    <div class="col-12 mt-4 pt-3 border-top d-flex align-items-center">
                        <?php echo form_submit($form['submit']); ?>
                        <a href="<?=site_url('matkul')?>" class="btn btn-warning rounded-pill px-4 ms-2 shadow-sm text-dark">
                            <i class="bi bi-x-circle me-1"></i> Batal
                        </a>
                    </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>