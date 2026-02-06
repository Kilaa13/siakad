<?php
$form = array(
    'nim' => array(
        'name'        => 'nim',
        'id'          => 'nim',
        'class'       => 'form-control',
        'placeholder' => 'Masukkan NIM Mahasiswa',
        'value'       => set_value('nim', isset($form_value['nim']) ? $form_value['nim'] : '')
    ),
    'nama' => array(
        'name'        => 'nama',
        'id'          => 'nama',
        'class'       => 'form-control',
        'placeholder' => 'Masukkan Nama Lengkap',
        'value'       => set_value('nama', isset($form_value['nama']) ? $form_value['nama'] : '')
    ),
    // Input Email Baru
    'email' => array(
        'name'        => 'email',
        'id'          => 'email',
        'type'        => 'email',
        'class'       => 'form-control',
        'placeholder' => 'Masukkan Email Mahasiswa',
        'value'       => set_value('email', isset($form_value['email']) ? $form_value['email'] : '')
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
            <li class="breadcrumb-item"><a href="<?=site_url('mahasiswa')?>">Mahasiswa</a></li>
            <li class="breadcrumb-item active">Form</li>
        </ol>
    </nav>
    <h1 style="color: #012970; font-weight: 700;"><?php echo $breadcrumb ?></h1>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <h5 class="card-title mb-4" style="color: #012970; font-size: 1.2rem;">Biodata Mahasiswa</h5>

                <?php if (!empty($pesan)) : ?>
                    <div class="alert alert-info border-0 shadow-sm mb-4">
                        <i class="bi bi-info-circle me-2"></i> <?php echo $pesan; ?>
                    </div>
                <?php endif ?>

                <?php echo form_open($form_action, ['class' => 'row g-3']); ?>
                    
                    <div class="col-md-6">
                        <label for="nim" class="form-label fw-bold">NIM (Nomor Induk Mahasiswa)</label>
                        <?php echo form_input($form['nim']); ?>
                        <?php echo form_error('nim', '<small class="text-danger mt-1 d-block">', '</small>'); ?>
                    </div>

                    <div class="col-md-6">
                        <label for="id_kelas" class="form-label fw-bold">Kelas</label>
                        <?php echo form_dropdown('id_kelas', $option_kelas, set_value('id_kelas', isset($form_value['id_kelas']) ? $form_value['id_kelas'] : ''), 'class="form-select" id="id_kelas"'); ?>
                        <?php echo form_error('id_kelas', '<small class="text-danger mt-1 d-block">', '</small>'); ?>
                    </div>

                    <div class="col-12">
                        <label for="nama" class="form-label fw-bold">Nama Lengkap</label>
                        <?php echo form_input($form['nama']); ?>
                        <?php echo form_error('nama', '<small class="text-danger mt-1 d-block">', '</small>'); ?>
                    </div>

                    <div class="col-12">
                        <label for="email" class="form-label fw-bold">Email Mahasiswa</label>
                        <?php echo form_input($form['email']); ?>
                        <?php echo form_error('email', '<small class="text-danger mt-1 d-block">', '</small>'); ?>
                    </div>

                    <div class="col-12 mt-4 pt-3 border-top">
                        <?php echo form_submit($form['submit']); ?>
                        <a href="<?=site_url('mahasiswa')?>" class="btn btn-warning rounded-pill px-4 ms-2 shadow-sm text-dark">
                            <i class="bi bi-x-circle me-1"></i> Batal
                        </a>
                    </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>