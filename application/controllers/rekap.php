<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rekap extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        if($this->session->userdata('role') == 'mahasiswa') {
            redirect('dashboard');
        }
        
        $this->load->model('Rekap_model', 'm_rekap');
        $this->load->model('Semester_model', 'm_semester');
        $this->load->model('Kelas_model', 'm_kelas');
        $this->load->model('Matkul_model', 'm_matkul');
        $this->load->helper('to_excel'); 
        $this->load->library('pdf');

        $this->data = [
            'modul'          => 'rekap',
            'breadcrumb'     => 'Rekap Absensi',
            'main_view'      => 'rekap/rekap',
            'form_action'    => 'rekap',
            'pesan'          => '',
            'tabel_data'     => '',
            'option_kelas'   => $this->_get_opt_kelas(),
            'option_matkul'  => $this->_get_opt_matkul()
        ];
    }

   
    private function _get_opt_kelas() {
        $kelas = $this->m_kelas->cari_semua();
        $opt = ['' => '-- Pilih Kelas --'];
        if ($kelas) { foreach ($kelas as $row) { $opt[$row->id_kelas] = $row->kelas; } }
        return $opt;
    }

    private function _get_opt_matkul() {
        $matkul = $this->m_matkul->cari_semua(); 
        $opt = ['' => '-- Pilih Mata Kuliah --'];
        if ($matkul) { foreach ($matkul as $row) { $opt[$row->kd_matkul] = $row->matkul; } }
        return $opt;
    }

    public function index()
    {
        $active_smt  = $this->m_semester->cari_aktif();
        $id_semester = $active_smt->id_semester;
        $this->data['id_semester'] = $id_semester;

        if ($this->input->post('submit')) {
            $id_kelas    = $this->input->post('id_kelas');
            $kd_matkul   = $this->input->post('kd_matkul');

            if ($id_kelas && $kd_matkul) {
                $rekap_data = $this->m_rekap->rekap($id_kelas, $id_semester, $kd_matkul);

                if ($rekap_data) {
                    $this->data['form_value']['id_kelas'] = $id_kelas;
                    $this->data['form_value']['kd_matkul'] = $kd_matkul;
                    
                    $kls_row = $this->db->get_where('kelas', ['id_kelas' => $id_kelas])->row();
                    $mtk_row = $this->db->get_where('matkul', ['kd_matkul' => $kd_matkul])->row();
                    
                    $this->data['kelas'] = $kls_row ? $kls_row->kelas : '';
                    $this->data['matkul'] = $mtk_row ? $mtk_row->matkul : '';
                    $this->data['tabel_data'] = $this->m_rekap->buat_tabel($rekap_data);

                    $this->data['link_excel'] = site_url("rekap/download_excel/$id_kelas/$id_semester/$kd_matkul");
                    $this->data['link_pdf']   = site_url("rekap/download_pdf/$id_kelas/$id_semester/$kd_matkul");
                } else {
                    $this->data['pesan'] = 'Data tidak ditemukan.';
                }
            }
        }
        $this->load->view('template', $this->data);
    }

    public function download_excel($id_kelas = NULL, $id_semester = NULL, $kd_matkul = NULL) {
    if (!$id_kelas || !$id_semester || !$kd_matkul) {
        die("Data tidak lengkap.");
    }

    $rekap_data = $this->m_rekap->rekap($id_kelas, $id_semester, $kd_matkul);

    if (ob_get_level() > 0) ob_end_clean();
    
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Rekap_Absen_$id_kelas.xls");
    
    echo '<table border="1">
            <tr>
                <th style="background-color:#eee">No</th>
                <th style="background-color:#eee">NIM</th>
                <th style="background-color:#eee">Nama</th>
                <th style="background-color:#eee">Hadir</th>
                <th style="background-color:#eee">Sakit</th>
                <th style="background-color:#eee">Ijin</th>
                <th style="background-color:#eee">Alpha</th>
                <th style="background-color:#eee">Terlambat</th>
            </tr>';
            
    $no = 1;
    foreach ($rekap_data as $row) {

        echo "<tr>
                <td>".$no++."</td>
                <td>'".$row->nim."</td> <td>".$row->nama."</td>
                <td>".($row->hadir ?? 0)."</td>
                <td>".($row->sakit ?? 0)."</td>
                <td>".($row->ijin ?? 0)."</td>
                <td>".($row->alpha ?? 0)."</td>
                <td>".($row->terlambat ?? 0)."</td>
              </tr>";
    }
    echo '</table>';
    exit;
}

public function download_pdf($id_kelas = NULL, $id_semester = NULL, $kd_matkul = NULL) {
    if (!$id_kelas || !$id_semester || !$kd_matkul) {
        die("Data tidak lengkap.");
    }
    $data['detail'] = $this->m_rekap->get_detail_absen($id_kelas, $id_semester, $kd_matkul);

    $this->db->select('matkul.matkul, dosen.nama_dosen'); 
    $this->db->from('matkul');
    $this->db->join('dosen', 'dosen.id_dosen = matkul.id_dosen');
    $this->db->where('matkul.kd_matkul', $kd_matkul);
    $matkul_info = $this->db->get()->row();
    
    $data['kd_matkul']       = $kd_matkul;
    $data['nama_matkul'] = ($matkul_info) ? $matkul_info->matkul : 'Mata Kuliah Tidak Ditemukan';
    $data['nama_dosen']  = ($matkul_info) ? $matkul_info->nama_dosen : 'Dosen Belum Diatur';
    $data['tanggal'] = date('d F Y'); 
    $data['kelas'] = $id_kelas;

    if (ob_get_level() > 0) ob_end_clean();
    $html = $this->load->view('rekap/export', $data, true);
    $this->load->library('pdf');
    $this->pdf->generate($html, "Rekap_Absen_".$id_kelas, 'A4', 'landscape');
}

}