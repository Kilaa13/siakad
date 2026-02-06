<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Sistem Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card border-0 shadow-lg rounded-4 mt-5">
                    <div class="card-body p-5">
                        <h3 class="fw-bold text-center mb-3" style="color: #012970;">Lupa Password?</h3>
                        <p class="text-muted text-center mb-4 small">Masukkan alamat email yang terdaftar pada akun Anda untuk menerima tautan reset password.</p>
                        
                        <?php if($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger border-0 small"><?= $this->session->flashdata('error') ?></div>
                        <?php endif; ?>
                        <?php if($this->session->flashdata('info')): ?>
                            <div class="alert alert-info border-0 small"><?= $this->session->flashdata('info') ?></div>
                        <?php endif; ?>

                        <form action="<?= site_url('login/proses_lupa_password') ?>" method="post">
                            <div class="mb-3">
                                <label class="form-label small fw-bold">Alamat Email</label>
                                <input type="email" name="email" class="form-control rounded-pill" placeholder="nama@email.com" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 rounded-pill py-2">Kirim Tautan Reset</button>
                            <div class="text-center mt-3">
                                <a href="<?= site_url('login') ?>" class="small text-decoration-none">Kembali ke Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>