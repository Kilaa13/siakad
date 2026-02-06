<?php
// Penyesuaian atribut form agar sinkron dengan Bootstrap 5
$form = array(
    'id_kelas' => array(
        'name'        => 'id_kelas',
        'id'          => 'id_kelas',
        'class'       => 'form-control',
        'placeholder' => 'Contoh: KLS01',
        'value'       => set_value('id_kelas', isset($form_value['id_kelas']) ? $form_value['id_kelas'] : '')
    ),
    'kelas' => array(
        'name'        => 'kelas',
        'id'          => 'kelas',
        'class'       => 'form-control',
        'placeholder' => 'Nama Kelas (Misal: Teknik Informatika A)',
        'value'       => set_value('kelas', isset($form_value['kelas']) ? $form_value['kelas'] : '')
    ),
    'jm_mhs' => array(
        'name'        => 'jm_mhs',
        'id'          => 'jm_mhs',
        'type'        => 'number',
        'class'       => 'form-control',
        'placeholder' => '0',
        'value'       => set_value('jm_mhs', isset($form_value['jm_mhs']) ? $form_value['jm_mhs'] : '')
    ),
    'submit' => array(
        'name'        => 'submit',
        'id'          => 'submit',
        'class'       => 'btn btn-primary rounded-pill px-4 shadow-sm',
        'value'       => 'Simpan Data'
    )
);
?>

<div class="pagetitle mb-4">
    <nav>
        <ol class="breadcrumb mb-1">
            <li class="breadcrumb-item"><a href="<?=site_url('dashboard')?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?=site_url('kelas')?>">Kelas</a></li>
            <li class="breadcrumb-item active">Form Kelas</li>
        </ol>
    </nav>
    <h1 style="color: #012970; font-weight: 700;"><?php echo $breadcrumb ?></h1>
</div>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <h5 class="card-title mb-4" style="color: #012970; font-size: 1.2rem;">Data Detail Kelas</h5>

                <?php $flash_pesan = $this->session->flashdata('pesan')?>
                <?php if (!empty($flash_pesan)) : ?>
                    <div class="alert alert-success border-0 shadow-sm mb-4">
                        <i class="bi bi-check-circle me-2"></i> <?php echo $flash_pesan; ?>
                    </div>
                <?php endif ?>

                <?php echo form_open($form_action, ['class' => 'row g-3']); ?>
                    
                    <div class="col-md-5">
                        <label for="id_kelas" class="form-label fw-bold">Kode Kelas</label>
                        <?php echo form_input($form['id_kelas']); ?>
                        <?php echo form_error('id_kelas', '<small class="text-danger mt-1 d-block">', '</small>'); ?>
                    </div>

                    <div class="col-md-7">
                        <label for="kelas" class="form-label fw-bold">Nama Kelas</label>
                        <?php echo form_input($form['kelas']); ?>
                        <?php echo form_error('kelas', '<small class="text-danger mt-1 d-block">', '</small>'); ?>
                    </div>

                    <div class="col-md-6">
                        <label for="jm_mhs" class="form-label fw-bold">Jumlah Mahasiswa</label>
                        <?php echo form_input($form['jm_mhs']); ?>
                        <?php echo form_error('jm_mhs', '<small class="text-danger mt-1 d-block">', '</small>'); ?>
                    </div>

                    <div class="col-12 mt-4 pt-3 border-top">
                        <?php echo form_submit($form['submit']); ?>
                        <a href="<?=site_url('kelas')?>" class="btn btn-warning rounded-pill px-4 ms-2 shadow-sm text-dark">
                             <i class="bi bi-x-circle me-1"></i> Batal
                        </a>
                    </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>