<div class="card border-0 shadow-sm rounded-4">
    <div class="card-header bg-white py-3">
        <h5 class="fw-bold m-0" style="color: #012970;">Riwayat Kehadiran Saya</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="bg-primary text-white p-3">No</th>
                        <th class="bg-primary text-white p-3">Mata Kuliah</th>
                        <th class="bg-primary text-white p-3">Tanggal</th>
                        <th class="bg-primary text-white p-3 text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($riwayat)): ?>
                        <tr><td colspan="4" class="text-center py-4 text-muted">Belum ada riwayat absensi.</td></tr>
                    <?php else: $no=1; foreach($riwayat as $r): ?>
                        <tr>
                            <td class="ps-4"><?= $no++ ?></td>
                            <td><strong><?= $r->matkul ?></strong></td>
                            <td><?= date('d M Y', strtotime($r->tanggal)) ?></td>
                            <td class="text-center">
                                <?php 
                                    $bg = ($r->absen == 'H') ? 'bg-success' : (($r->absen == 'I' || $r->absen == 'S') ? 'bg-warning' : 'bg-danger');
                                    $label = ($r->absen == 'H') ? 'Hadir' : (($r->absen == 'I') ? 'Izin' : (($r->absen == 'S') ? 'Sakit' : 'Alpha'));
                                ?>
                                <span class="badge <?= $bg ?> rounded-pill px-3"><?= $label ?></span>
                            </td>
                        </tr>
                    <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>