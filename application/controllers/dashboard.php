<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Mahasiswa_model', 'm_mhs');
        $this->load->model('Kelas_model', 'm_kelas');
        $this->load->model('Dosen_model', 'm_dosen');
        $this->load->model('Matkul_model', 'm_matkul');
    }

    public function index() {
        $this->data['modul'] = 'dashboard';
        $this->data['breadcrumb'] = 'Dashboard';
        $this->data['main_view'] = 'dashboard'; 

        $role = $this->session->userdata('role');
        $id_penerima = $this->session->userdata('id_penerima'); 
    
        if ($role == 'admin') {
            $this->data['total_mhs'] = $this->m_mhs->hitung_semua();
            $this->data['total_kelas'] = $this->m_kelas->hitung_semua();
            $this->data['total_dosen'] = $this->m_dosen->hitung_semua();          
            $this->data['total_matkul'] = $this->m_matkul->hitung_semua();

            $this->data['semester_aktif'] = $this->db->where('status', 'Y')->get('semester')->row();

            $this->data['grafik'] = $this->db->select('absen, count(*) as total')
                                            ->group_by('absen')
                                            ->get('absen')->result();

            $this->db->select('a.tanggal, m.nama, mk.matkul, a.absen');
            $this->db->from('absen a');
            $this->db->join('mahasiswa m', 'm.nim = a.nim');
            $this->db->join('matkul mk', 'mk.kd_matkul = a.kd_matkul');
            $this->db->order_by('a.id_absen', 'DESC');
            $this->db->limit(5);
            $this->data['recent_absen'] = $this->db->get()->result();

        } 
        elseif ($role == 'mahasiswa') {
            $id_penerima = $this->session->userdata('id_penerima');
            $this->data['jadwal'] = $this->db->query("
                SELECT m.kd_matkul, m.matkul, m.ruangan, m.tanggal, m.jam, k.kelas
                FROM matkul m 
                JOIN kelas k ON k.id_kelas = m.id_kelas 
                JOIN mahasiswa mhs ON mhs.id_kelas = k.id_kelas
                WHERE mhs.nim = '$id_penerima'
            ")->result();
        } 
        elseif ($role == 'dosen') {
            $id_dosen = $this->session->userdata('id_penerima');
            $this->data['jadwal_kuliah'] = $this->db->query("
                SELECT m.*, k.kelas, d.nama_dosen 
                FROM matkul m 
                JOIN kelas k ON k.id_kelas = m.id_kelas 
                JOIN dosen d ON d.id_dosen = m.id_dosen
                WHERE m.id_dosen = '$id_dosen'
            ")->result();

            $this->data['list_matkul'] = $this->data['jadwal_kuliah'];
            $this->data['total_ajar'] = count($this->data['jadwal_kuliah']);
}
    $this->load->view('template', $this->data);
    }
      
    public function form_absen($kd_matkul) {
        
        $nim_login = $this->session->userdata('id_penerima');
        
        $this->data['mhs'] = $this->db->get_where('mahasiswa', ['nim' => $nim_login])->row();
        $matkul_row = $this->db->get_where('matkul', ['kd_matkul' => $kd_matkul])->row();
        $this->data['matkul'] = $matkul_row;
        
        $this->data['option_matkul'] = [$matkul_row->kd_matkul => $matkul_row->matkul];

        $this->data['form_action'] = site_url('dashboard/simpan_absen');
        $this->data['breadcrumb'] = 'Formulir Absensi'; 
        $this->data['modul'] = 'dashboard';
        $this->data['main_view'] = 'absen/absen_form'; 
        
        $this->load->view('template', $this->data);
    }
    public function simpan_absen() {
     
        $nim        = $this->input->post('nim');
        $kd_matkul  = $this->input->post('kd_matkul');
        $tanggal    = $this->input->post('tanggal'); // Menangkap input dari $attr_tanggal
        $status     = $this->input->post('absen');   // Menangkap nilai H, S, I, A, atau T
 
        $id_semester = '1'; 
    
        $data = [
            'nim'         => $nim,
            'kd_matkul'   => $kd_matkul,
            'id_semester' => $id_semester,
            'tanggal'     => $tanggal,
            'absen'       => $status 
        ];
    
        $simpan = $this->db->insert('absen', $data);
    
        if ($simpan) {
            $this->session->set_flashdata('success', 'Absensi berhasil disimpan!');
        } else {
            $this->session->set_flashdata('error', 'Terjadi kesalahan saat menyimpan.');
        }
    
        redirect('dashboard');
    }

    
    public function riwayat_saya() {
        $nim = $this->session->userdata('id_penerima');
        
        $this->data['riwayat'] = $this->db->query("
            SELECT a.*, m.matkul 
            FROM absen a 
            JOIN matkul m ON a.kd_matkul = m.kd_matkul 
            WHERE a.nim = '$nim' 
            ORDER BY a.tanggal DESC
        ")->result();

        $this->data['breadcrumb'] = 'Riwayat Kehadiran';
        $this->data['modul'] = 'dashboard';
        $this->data['main_view'] = 'absen/riwayat_absen'; // Nama file view yang akan kita buat
        
        $this->load->view('template', $this->data);
    }
}