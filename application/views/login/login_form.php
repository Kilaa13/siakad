<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Login - SIAKAD MHS</title>

  <link href="<?=base_url('assets/img/favicon.png')?>" rel="icon">
  <link href="<?=base_url('assets/img/apple-touch-icon.png')?>" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <link href="<?=base_url('assets/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
  <link href="<?=base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css')?>" rel="stylesheet">
  <link href="<?=base_url('assets/vendor/aos/aos.css')?>" rel="stylesheet">

  <link href="<?=base_url('assets/css/main.css')?>" rel="stylesheet">
  <link href="<?=base_url('assets/css/custom_style.css')?>" rel="stylesheet">

</head>

<body>

  <div class="login-container">
    <div class="login-card" data-aos="fade-up">
      <div class="text-center mb-4">
        <h1 class="h3" style="color: #012970; font-weight: 800;"> SIAKAD MHS</h1>
        <p class="text-muted small">Sistem Informasi Akademik</p>
      </div>

      <?php if (!empty($pesan)) : ?>
        <div class="alert alert-danger border-0 small py-2" role="alert">
          <i class="bi bi-exclamation-circle me-2"></i> <?php echo $pesan; ?>
        </div>
      <?php endif ?>

      <?php 
        $attributes = array('name' => 'login_form', 'id' => 'login_form', 'autocomplete' => 'off');
        echo form_open('login', $attributes); 
      ?>
        <div class="mb-3">
          <label class="form-label small fw-bold text-secondary">Username</label>
          <input type="text" name="username" class="form-control" placeholder="Masukkan username" value="<?php echo set_value('username');?>">
          <?php echo form_error('username', '<small class="text-danger mt-1 d-block">', '</small>');?>
        </div>

        <div class="mb-4">
          <label class="form-label small fw-bold text-secondary">Password</label>
          <input type="password" name="password" class="form-control" placeholder="Masukkan password">
          <?php echo form_error('password', '<small class="text-danger mt-1 d-block">', '</small>');?>
        </div>

        <button type="submit" class="btn btn-login w-100 mb-3 shadow-sm">MASUK</button>
        
        <div class="text-center">
          <a href="<?= site_url('login/lupa_password') ?>" class="text-decoration-none small text-muted">Lupa Password?</a>
        </div>
      <?php echo form_close(); ?>

      <div class="mt-5 text-center">
        <p class="small text-muted mb-0">© 2026 SIAKAD MHS Dashboard</p>
      </div>
    </div>
  </div>

  <script src="<?=base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
  <script src="<?=base_url('assets/vendor/aos/aos.js')?>"></script>
  <script>
    AOS.init({
      duration: 1000,
      easing: 'ease-in-out',
      once: true,
      mirror: false
    });
  </script>

</body>
</html>