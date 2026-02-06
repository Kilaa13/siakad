<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>404 - Halaman Tidak Ditemukan</title>

  <link href="<?=base_url('assets/img/favicon.png')?>" rel="icon">

  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <link href="<?=base_url('assets/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
  <link href="<?=base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css')?>" rel="stylesheet">

  <link href="<?=base_url('assets/css/main.css')?>" rel="stylesheet">
  <link href="<?=base_url('assets/css/custom_style.css')?>" rel="stylesheet">
  
</head>

<body>

  <main>
    <div class="container">
      <section class="section error-404">
        <i class="bi bi-exclamation-triangle-fill icon-404"></i>
        <h1>404</h1>
        <h2>Kamu Mau Kemana Bro?</h2>
        <p>Halaman di belakangmu tidak akan pernah kembali lagi. Jangan lagi kamu berkunjung di halamanku yang sepi ini.</p>
        <a class="btn-back" href="<?=base_url('absen');?>">
          <i class="bi bi-house-door me-2"></i>Kembalilah, Kamu Tidak Akan Kuat
        </a>
      </section>
    </div>
  </main>

  <script src="<?=base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>

</body>
</html>