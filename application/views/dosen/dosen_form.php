<?php
$form = array(
    'nidn' => array(
        'name'  => 'nidn',
        'id'    => 'nidn',
        'class' => 'form-control',
        'placeholder' => 'Masukkan NIDN Dosen',
        'value' => set_value('nidn', isset($form_value['nidn']) ? $form_value['nidn'] : '')
    ),
    'nama_dosen' => array(
        'name'  => 'nama_dosen',
        'id'    => 'nama_dosen',
        'class' => 'form-control',
        'placeholder' => 'Masukkan Nama Lengkap beserta Gelar',
        'value' => set_value('nama_dosen', isset($form_value['nama_dosen']) ? $form_value['nama_dosen'] : '')
    ),
    'email' => array(
        'name'  => 'email',
        'id'    => 'email',
        'type'  => 'email',
        'class' => 'form-control',
        'placeholder' => 'Masukkan Alamat Email Aktif',
        'value' => set_value('email', isset($form_value['email']) ? $form_value['email'] : '')
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
            <li class="breadcrumb-item"><a href="<?=site_url('dosen')?>">Dosen</a></li>
            <li class="breadcrumb-item active">Form</li>
        </ol>
    </nav>
    <h1 style="color: #012970; font-weight: 700;"><?php echo $breadcrumb ?></h1>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <h5 class="card-title mb-4" style="color: #012970; font-size: 1.2rem;">Biodata Dosen Pengampu</h5>

                <?php if (!empty($pesan)) : ?>
                    <div class="alert alert-info border-0 shadow-sm mb-4">
                        <i class="bi bi-info-circle me-2"></i> <?php echo $pesan; ?>
                    </div>
                <?php endif ?>

                <?php echo form_open($form_action, ['class' => 'row g-3']); ?>
                    
                    <div class="col-md-6">
                        <label for="nidn" class="form-label fw-bold">NIDN (Nomor Induk Dosen Nasional)</label>
                        <?php echo form_input($form['nidn']); ?>
                        <?php echo form_error('nidn', '<small class="text-danger mt-1 d-block">', '</small>'); ?>
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label fw-bold">Alamat Email</label>
                        <?php echo form_input($form['email']); ?>
                        <?php echo form_error('email', '<small class="text-danger mt-1 d-block">', '</small>'); ?>
                    </div>

                    <div class="col-12">
                        <label for="nama_dosen" class="form-label fw-bold">Nama Lengkap</label>
                        <?php echo form_input($form['nama_dosen']); ?>
                        <?php echo form_error('nama_dosen', '<small class="text-danger mt-1 d-block">', '</small>'); ?>
                    </div>

                    <div class="col-12 mt-4 pt-3 border-top">
                        <?php echo form_submit($form['submit']); ?>
                        <a href="<?=site_url('dosen')?>" class="btn btn-warning rounded-pill px-4 ms-2 shadow-sm text-dark">
                            <i class="bi bi-x-circle me-1"></i> Batal
                        </a>
                    </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>