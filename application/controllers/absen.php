<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Absen extends MY_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->model('Absen_model', 'm_absen');
        $this->load->model('Semester_model', 'm_semester');
        $this->load->model('Matkul_model', 'm_matkul');

        $this->data = [
            'modul'         => 'absen',
            'breadcrumb'    => 'Absen',
            'main_view'     => 'absen/absen',
            'option_matkul' => $this->_get_opt_matkul()
        ];
    }

    private function _get_opt_matkul() {
        $res = $this->m_matkul->cari_semua();
        $opt[''] = '-- Pilih Mata Kuliah --';
        if ($res) {
            foreach ($res as $row) {
                $opt[$row->kd_matkul] = $row->matkul;
            }
        }
        return $opt;
    }

    public function index($offset = 0) {
        $this->session->unset_userdata('tanggal_sekarang');
        $smt = $this->m_semester->cari_aktif();
        $id_semester = $smt ? $smt->id_semester : 0;

        $absen = $this->m_absen->cari_semua($offset, $id_semester);

        if ($absen) {
            $this->data['tabel_data'] = $this->m_absen->buat_tabel($absen);
            $this->data['pagination'] = $this->m_absen->paging(site_url('absen/halaman'), $this->m_absen->hitung_semua($id_semester));
        } else {
            $this->data['pesan'] = '<div class="alert alert-warning">Belum ada data absen hari ini.</div>';
        }
        $this->load->view('template', $this->data);
    }

    public function tambah() {
        if ($this->input->post('submit')) {
            if ($this->m_absen->validasi_tambah()) {
                $this->m_absen->simpan('tambah');
                $this->session->set_flashdata('pesan', 'Tambah data berhasil.');
                redirect('absen');
            }
        }
        $this->data['breadcrumb']  = 'Absen > Tambah';
        $this->data['main_view']   = 'absen/absen_form';
        $this->data['form_action'] = 'absen/tambah';
        $this->load->view('template', $this->data);
    }

    public function edit($id = NULL) {
        if (!$id) redirect('absen');

        $this->db->select('absen.*, mahasiswa.nama');
        $this->db->from('absen');
        $this->db->join('mahasiswa', 'mahasiswa.nim = absen.nim');
        $this->db->where('absen.id_absen', $id);
        $res = $this->db->get()->row();

        if (!$res) redirect('absen');

        $this->data['mhs'] = $res;

        if ($this->input->post('submit')) {
            if ($this->m_absen->validasi_edit()) {
                $this->m_absen->simpan('edit', $id);
                $this->session->set_flashdata('pesan', 'Update data berhasil.');
                redirect('absen');
            }
            $this->data['form_value'] = $this->input->post();
        } else {            
            $this->data['form_value'] = (array) $res;
            $this->data['form_value']['tanggal'] = date('d-m-Y', strtotime($res->tanggal));
            $this->session->set_userdata('tanggal_sekarang', $res->tanggal);
        }

        $this->data['breadcrumb']  = 'Absen > Edit';
        $this->data['main_view']   = 'absen/absen_form';
        $this->data['form_action'] = "absen/edit/$id";
        $this->load->view('template', $this->data);
    }

    public function hapus($id) {
        $this->db->delete('absen', ['id_absen' => $id]);
        $this->session->set_flashdata('pesan', 'Data berhasil dihapus.');
        redirect('absen');
    }

    public function is_mahasiswa_exist($nim) {
        if ($this->db->where('nim', $nim)->get('mahasiswa')->num_rows() > 0) return TRUE;
        $this->form_validation->set_message('is_mahasiswa_exist', "NIM $nim tidak terdaftar.");
        return FALSE;
    }

   public function is_format_tanggal($str) {
    // Sesuaikan Regex untuk format YYYY-MM-DD
    if (preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[01])$/', $str)) return TRUE;
    $this->form_validation->set_message('is_format_tanggal', 'Format tanggal harus YYYY-MM-DD');
    return FALSE;
}

    public function is_double_entry_tambah() {
        $nim = $this->input->post('nim');
        $tgl = date('Y-m-d', strtotime($this->input->post('tanggal')));
        $matkul = $this->input->post('kd_matkul');
        $exists = $this->db->where(['nim'=>$nim, 'tanggal'=>$tgl, 'kd_matkul'=>$matkul])->get('absen')->num_rows();
        if ($exists > 0) {
            $this->form_validation->set_message('is_double_entry_tambah', 'Mahasiswa sudah diabsen di matkul ini pada tanggal tersebut.');
            return FALSE;
        }
        return TRUE;
    }
}