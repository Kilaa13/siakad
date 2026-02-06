<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-4">
                    <h4 class="fw-bold text-center mb-4">Ganti Password Baru</h4>
                    <form action="<?= site_url('login/ganti_password_fix') ?>" method="post">
                        <input type="hidden" name="email" value="<?= $email ?>">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Password Baru</label>
                            <input type="password" name="pass1" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Ulangi Password Baru</label>
                            <input type="password" name="pass2" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 rounded-pill">Simpan Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>