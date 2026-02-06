<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?= base_url('assets/js/dashboard-chart.js') ?>"></script>

<div class="pagetitle mb-4">
    <h1 style="color: #012970; font-weight: 700;">Dashboard</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?=site_url('dashboard')?>">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div>

<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4 bg-primary text-white">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h4 class="fw-bold mb-1 text-white">Halo, <?php echo $this->session->userdata('nama_lengkap'); ?>!</h4>
                        <p class="mb-0">Selamat datang di Sistem Absensi. Anda masuk sebagai <strong><?php echo strtoupper($this->session->userdata('role')); ?></strong>.</p>
                    </div>
                    <div class="flex-shrink-0 d-none d-md-block">
                        <i class="bi bi-person-badge" style="font-size: 3rem; opacity: 0.5;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($this->session->userdata('role') == 'admin') : ?>
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 text-center p-4 h-100">
                <i class="bi bi-people text-primary fs-1 mb-2"></i>
                <h6 class="text-muted small fw-bold">Total Mahasiswa</h6>
                <h2 class="fw-bold mb-0"><?= $total_mhs ?></h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 text-center p-4 h-100">
                <i class="bi bi-person-badge text-success fs-1 mb-2"></i>
                <h6 class="text-muted small fw-bold">Total Dosen</h6>
                <h2 class="fw-bold mb-0"><?= $total_dosen ?></h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 text-center p-4 h-100">
                <i class="bi bi-door-open text-warning fs-1 mb-2"></i>
                <h6 class="text-muted small fw-bold">Total Kelas</h6>
                <h2 class="fw-bold mb-0"><?= $total_kelas ?></h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 text-center p-4 h-100">
                <i class="bi bi-book text-danger fs-1 mb-2"></i>
                <h6 class="text-muted small fw-bold">Total Mata Kuliah</h6>
                <h2 class="fw-bold mb-0"><?= $total_matkul ?></h2>
            </div>
        </div>
    </div> <div class="row g-4 mb-4">
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 bg-primary text-white h-100">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="flex-shrink-0 bg-white bg-opacity-25 rounded-circle p-3">
                        <i class="bi bi-calendar-check fs-2"></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="text-white mb-0 opacity-75 small">Semester Sekarang</h6>
                        <h4 class="text-white fw-bold mb-0">
                            <?= $semester_aktif ? "Semester " . $semester_aktif->id_semester : 'Belum Diatur'; ?>
                        </h4>
                        <small class="opacity-75 text-white">
                            Tahun Akademik: <?= date('Y') . '/' . (date('Y') + 1); ?>
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between mb-2">
                        <h6 class="fw-bold m-0" style="color: #012970;">Papan Informasi</h6>
                        <span class="badge bg-info text-dark small">Penting</span>
                    </div>
                    <p class="small text-muted mb-0">Selamat Datang di SIAKAD MHS. Pastikan data mahasiswa dan mata kuliah sudah sesuai sebelum melakukan rekapitulasi akhir semester.</p>
                </div>
            </div>
        </div>
    </div> <div class="row g-4 mb-4">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4 text-center">
                    <h6 class="fw-bold text-start mb-4" style="color: #012970;">Statistik Kehadiran</h6>
                    <div style="max-width: 250px; margin: auto;">
                        <?php 
                            $h = 0; $s = 0; $i = 0; $a = 0;
                            foreach($grafik as $g) {
                                if($g->absen == 'H') $h = $g->total;
                                if($g->absen == 'S') $s = $g->total;
                                if($g->absen == 'I') $i = $g->total;
                                if($g->absen == 'A') $a = $g->total;
                            }
                            $stats_json = json_encode(['h' => $h, 's' => $s, 'i' => $i, 'a' => $a]);
                        ?>
                        <canvas id="absenChart" data-stats='<?= $stats_json ?>'></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3" style="color: #012970;">Aktivitas Absensi Terbaru</h6>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light text-muted small">
                                <tr>
                                    <th>Mahasiswa</th>
                                    <th>Mata Kuliah</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($recent_absen)) : ?>
                                    <?php foreach ($recent_absen as $ra) : ?>
                                        <tr>
                                            <td><div class="fw-bold text-dark small"><?= $ra->nama ?></div></td>
                                            <td class="small text-muted"><?= $ra->matkul ?></td>
                                            <td class="text-center">
                                                <?php
                                                $badge = ['H'=>'bg-success','S'=>'bg-info','I'=>'bg-warning text-dark','A'=>'bg-danger','T'=>'bg-dark'];
                                                $cls = isset($badge[$ra->absen]) ? $badge[$ra->absen] : 'bg-secondary';
                                                ?>
                                                <span class="badge <?= $cls ?> shadow-sm" style="width: 30px;"><?= $ra->absen ?></span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr><td colspan="3" class="text-center text-muted small py-4">Belum ada aktivitas hari ini.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <?php endif; ?>

<?php if ($this->session->userdata('role') == 'mahasiswa') : ?>
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white py-3 border-bottom">
        <?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success border-0 shadow-sm mb-3">
        <i class="bi bi-check-circle me-2"></i> <?= $this->session->flashdata('success'); ?>
    </div>
<?php endif; ?>
            <h5 class="card-title m-0 fw-bold" style="color: #012970;">Jadwal Mata Kuliah</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
               <div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead>
            <tr class="text-dark">
                <th class="bg-primary text-white p-3">Kode</th>
                <th class="bg-primary text-white p-3">Mata Kuliah</th>
                <th class="bg-primary text-white p-3">Ruangan</th>
                <th class="bg-primary text-white p-3">Tanggal</th>
                <th class="bg-primary text-white p-3">Waktu</th>
                <th class=" bg-primary text-white p-3 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($jadwal)): ?>
                <?php foreach ($jadwal as $j) : ?>
                    <tr>
                        <td><?= $j->kd_matkul ?></td>
                        <td class="fw-bold text-primary"><?= $j->matkul ?></td>
                        <td><i class="bi bi-geo-alt text-danger"></i> <?= $j->ruangan ?></td>
                        <td><i class="bi bi-clock"></i> <?= $j->tanggal ?></td>
                        <td><i class="bi bi-clock"></i> <?= $j->jam ?></td>
                        <td class="text-center">
                            <a href="<?= site_url('dashboard/form_absen/'.$j->kd_matkul) ?>" class="btn btn-sm btn-primary rounded-pill">
                                Absen Sekarang
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center py-4">Belum ada mata kuliah yang terdaftar untuk kelas Anda.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</div>
</div>
<?php endif; ?>

<?php if ($this->session->userdata('role') == 'dosen') : ?>
    <div class="row g-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <h5 class="card-title m-0 fw-bold" style="color: #012970;">Ringkasan Pengajaran</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-4">Berikut adalah mata kuliah yang Anda ampu pada semester ini.</p>
                    <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-0"> <div class="table-responsive">
                        <table class="table table-hover align-middle shadow-sm">
                            <thead>
                                <tr class="text-dark">
                                    <th class="bg-primary text-white p-3">Tanggal</th>
                                    <th class="bg-primary text-white p-3">Mata Kuliah</th>
                                    <th class="bg-primary text-white p-3">Ruangan</th>
                                    <th class="bg-primary text-white p-3">Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($jadwal_kuliah)): ?>
                                    <?php foreach ($jadwal_kuliah as $row): ?>
                                    <tr>
                                        <td class="ps-4">
                                            <span class="fw-bold text-primary">
                                                <?php 
                                                    $hari_indo = [
                                                        'Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa',
                                                        'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'
                                                    ];
                                                    echo $hari_indo[date('l', strtotime($row->tanggal))];
                                                ?>
                                            </span>
                                            <div class="small text-muted"><?= date('d M Y', strtotime($row->tanggal)) ?></div>
                                        </td>
                                        <td class="fw-bold" style="color: #011e2c;"><?= $row->matkul ?></td>
                                        <td><i class="bi bi-geo-alt text-danger me-1"></i> <?= $row->ruangan ?></td>
                                        <td class="pe-4 text-muted"><i class="bi bi-clock me-1"></i> <?= $row->jam ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">Tidak ada jadwal kuliah.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
                      
                    <div class="alert alert-info border-0 rounded-3 shadow-sm">
                        <i class="bi bi-info-circle-fill me-2"></i> Mahasiswa melakukan absensi secara mandiri. Gunakan menu <strong>Rekap</strong> untuk memverifikasi kehadiran mereka.
                    </div>
                    
                    <div class="text-center py-4">
                        <a href="<?= site_url('rekap') ?>" class="btn btn-primary rounded-pill px-5 shadow-sm py-2">
                            <i class="bi bi-file-earmark-bar-graph me-2"></i> Buka Menu Rekapitulasi
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
    <div class="card border-0 shadow-sm rounded-4 h-100 p-3">
        <div class="card-body">
            <div class="text-center mb-4">
                <i class="bi bi-book-half text-primary fs-1"></i>
                <h6 class="text-muted text-uppercase small fw-bold mt-2">Total Mata Kuliah Ampuan</h6>
                <h1 class="fw-bold text-primary display-4 mb-0"><?= isset($total_ajar) ? $total_ajar : 0; ?></h1>
            </div>
            
            <hr class="text-muted opacity-25">
            
            <h6 class="fw-bold mb-3" style="color: #012970; font-size: 0.9rem;">Mata Kuliah Anda:</h6>
            <div class="list-group list-group-flush">
                <?php if(!empty($list_matkul)): foreach($list_matkul as $lm): ?>
                    <div class="list-group-item d-flex align-items-center border-0 px-0 py-2 bg-transparent">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-2 me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="bi bi-journal-text small"></i>
                        </div>
                        <div>
                            <span class="d-block fw-bold small text-dark"><?= $lm->matkul ?></span>
                            <span class="text-muted" style="font-size: 0.75rem;"><?= $lm->kd_matkul ?></span>
                        </div>
                    </div>
                <?php endforeach; else: ?>
                    <p class="text-muted small italic">Data mata kuliah belum tersedia.</p>
                <?php endif; ?>
            </div>
            
            <p class="small text-muted mb-0 mt-3 border-top pt-2">Daftar otomatis terupdate berdasarkan data sistem.</p>
        </div>
    </div>
</div>
    </div>
<?php endif; ?>