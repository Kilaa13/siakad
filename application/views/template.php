<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>SIAKAD MHS - Dashboard</title>

    <link href="<?=base_url('assets/vendor/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css')?>" rel="stylesheet">

    <link href="<?=base_url('assets/css/main.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/css/custom_style.css')?>" rel="stylesheet">
    
</head>
<body>

    <header class="header shadow-sm justify-content-between">
        <a href="<?=site_url('dashboard')?>" class="sitename">SIAKAD MHS</a>
        <a href="<?=site_url('login/logout')?>" class="btn btn-danger btn-sm rounded-pill px-4">Logout</a>
    </header>

    <aside class="sidebar">
        <ul class="sidebar-nav">
            <li class="nav-item">
                <a class="nav-link <?=($modul == 'dashboard' ? 'active' : '')?>" href="<?=site_url('dashboard')?>">
                    <i class="bi bi-grid"></i> <span>Dashboard</span>
                </a>
            </li>

            <?php if ($this->session->userdata('role') == 'admin'): ?>
                <li class="nav-heading">Data Master</li>
                <li class="nav-item"><a class="nav-link" href="<?=site_url('mahasiswa')?>"><i class="bi bi-person"></i> Data Mahasiswa</a></li>
                <li class="nav-item"><a class="nav-link" href="<?=site_url('dosen')?>"><i class="bi bi-person"></i> Data Dosen</a></li>
                <li class="nav-item"><a class="nav-link" href="<?=site_url('kelas')?>"><i class="bi bi-door-open"></i> Data Kelas</a></li>
                <li class="nav-item"><a class="nav-link" href="<?=site_url('matkul')?>"><i class="bi bi-book"></i> Data Mata Kuliah</a></li>
                <li class="nav-item"><a class="nav-link" href="<?=site_url('absen')?>"><i class="bi bi-door-open"></i> Data Absensi</a></li>
            <?php endif; ?>

            <?php if ($this->session->userdata('role') == 'admin'): ?>
            <li class="nav-heading">Laporan & Pengaturan</li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="<?= site_url('rekap') ?>">
                        <i class="bi bi-file-earmark-bar-graph"></i> <span>Rekapitulasi</span>
                    </a>
             </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= site_url('semester') ?>">
                    <i class="bi bi-calendar-event"></i> <span>Data Semester</span>
                </a>
            </li>
            <?php endif; ?>

            <?php if ($this->session->userdata('role') == 'dosen'): ?>
            <li class="nav-heading">Laporan Absensi</li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="<?= site_url('rekap') ?>">
                        <i class="bi bi-file-earmark-bar-graph"></i> <span>Rekapitulasi</span>
                    </a>
             </li>
             <?php endif; ?>

            <?php if ($this->session->userdata('role') == 'mahasiswa'): ?>
                <li class="nav-heading">Mahasiswa</li>
                <li class="nav-item"><a class="nav-link" href="<?=site_url('dashboard/riwayat_saya')?>"><i class="bi bi-clock-history"></i> Kehadiran Saya</a></li>
            <?php endif; ?>
        </ul>
    </aside>

    <main id="main">
    <div class="container-fluid">
        <?php $this->load->view($main_view); ?>
    </div>
    </main>

    <footer id="footer" class="footer mt-auto">
    <div class="container copyright text-center mt-4">
        &copy; <?= date('Y'); ?> <span>Copyright</span> <strong class="px-1 sitename">SIAKAD MHS</strong> <span>All Rights Reserved</span></p>
        <div class="credits">
        Sistem Informasi Akademik v1.0
        </div>
    </div>
    </footer>
    


    <script src="<?=base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
</body>
</html>