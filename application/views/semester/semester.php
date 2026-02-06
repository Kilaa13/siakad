<div class="row">
    <div class="col-lg-4">
        <div class="card bg-primary text-white shadow-sm rounded-4">
            <div class="card-body p-4 text-center">
                <h6 class="text-uppercase opacity-75 small text-white">Sistem Aktif</h6>
                <h3 class="fw-bold mb-0 text-white"><?php echo $semester_aktif; ?></h3>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <?php echo form_open($form_action); ?>
                    <div class="table-responsive">
                        <?php echo $tabel_data; ?>
                    </div>
                    <div class="text-end mt-3">
                        <button type="submit" name="submit" value="Simpan" class="btn btn-primary rounded-pill px-4">
                            Aktivasi Semester
                        </button>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>