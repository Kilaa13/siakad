<!DOCTYPE html>
<html>
<head>
    <title>Laporan Absensi</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .info-table { width: 100%; margin-bottom: 10px; border: none; }
        .info-table td { border: none; text-align: left; padding: 2px; }
        table.main-table { width: 100%; border-collapse: collapse; }
        table.main-table th, table.main-table td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="header">
        <h2 style="margin-bottom: 5px;">LAPORAN REKAPITULASI ABSENSI</h2>
        <hr>
    </div>

    <table class="info-table">
        <tr>
            <td width="15%">Mata Kuliah</td>
            <td width="2%">:</td>
            <td width="33%"><strong><?= $nama_matkul ?></strong> (<?= $kd_matkul ?>)</td>
            <td width="15%">Kelas</td>
            <td width="2%">:</td>
            <td width="33%"><?= $kelas ?></td>
        </tr>
        <tr>
            <td>Dosen Pengampu</td>
            <td>:</td>
            <td><?= $nama_dosen ?></td>
            <td>Tanggal Cetak</td>
            <td>:</td>
            <td><?= $tanggal ?></td>
        </tr>
    </table>

    <table class="main-table">
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama Mahasiswa</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach($detail as $row): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row->nim ?></td>
                <td style="text-align: left;"><?= $row->nama ?></td>
              <td>
                <?php 
                    switch($row->absen) {
                        case 'H': echo 'Hadir'; break;
                        case 'S': echo 'Sakit'; break;
                        case 'I': echo 'Ijin'; break;
                        case 'A': echo 'Alpha'; break;
                        case 'T': echo 'Terlambat'; break;
                        default: echo '<span style="color:red">Belum Absen</span>';
                    }
                ?>
            </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>