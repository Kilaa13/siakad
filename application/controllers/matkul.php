<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Matkul extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->cek_akses('admin');      
        $this->load->model('Matkul_model', 'm_matkul');
        $this->load->model('Dosen_model', 'm_dosen');
        
        // Data default untuk view agar DRY
        $this->data = [
            'modul'        => 'matkul',
            'option_dosen' => $this->_get_options_dosen()
        ];
    }

    private function _get_options_dosen() {
        // Sekarang ini tidak akan error lagi
        $dosen = $this->m_dosen->cari_semua(); 
        
        $opt[''] = '-- Pilih Dosen Pengampu --';
        if ($dosen) {
            foreach ($dosen as $row) {
                $opt[$row->id_dosen] = $row->nama_dosen;
            }
        }
        return $opt;
    }

    public function index($offset = 0) {
        
        $this->session->unset_userdata('kd_matkul_sekarang');
        
        $matkul = $this->m_matkul->cari_semua($offset);

        $this->data['breadcrumb'] = 'Matkul';
        $this->data['main_view']  = 'matkul/matkul';

        if ($matkul) {
            $this->data['tabel_data'] = $this->m_matkul->buat_tabel($matkul);
            $this->data['pagination'] = $this->m_matkul->paging(site_url('matkul/index'));
        } else {
            $this->data['pesan'] = 'Tidak ada data Mata Kuliah.';
        }

        $this->load->view('template', $this->data);
    }

    public function tambah() {
        if ($this->input->post('submit')) {
            if ($this->m_matkul->validasi('tambah')) {
                $this->m_matkul->simpan('tambah');
                $this->session->set_flashdata('pesan', 'Tambah data mata kuliah berhasil.');
                redirect('matkul');
            }
        }

        $this->data['breadcrumb']  = 'Matkul > Tambah';
        $this->data['main_view']   = 'matkul/matkul_form';
        $this->data['form_action'] = 'matkul/tambah';
        $this->load->view('template', $this->data);
    }

    public function edit($kd_matkul = NULL) {
        if (!$kd_matkul) redirect('matkul');

        if ($this->input->post('submit')) {
            if ($this->m_matkul->validasi('edit')) {
                $id_lama = $this->session->userdata('kd_matkul_sekarang');
                $this->m_matkul->simpan('edit', $id_lama);
                
                $this->session->set_flashdata('pesan', 'Update data mata kuliah berhasil.');
                redirect('matkul');
            }
        } else {
            $row = $this->db->get_where('matkul', ['kd_matkul' => $kd_matkul])->row_array();
            if (!$row) redirect('matkul');
            
            $this->data['form_value'] = $row;
            $this->session->set_userdata('kd_matkul_sekarang', $kd_matkul);
        }

        $this->data['breadcrumb']  = 'Matkul > Edit';
        $this->data['main_view']   = 'matkul/matkul_form';
        $this->data['form_action'] = 'matkul/edit/' . $kd_matkul;
        $this->load->view('template', $this->data);
    }

    public function hapus($kd_matkul = NULL) {
        if ($kd_matkul) {
            $this->db->where('kd_matkul', $kd_matkul)->delete('matkul');
            $this->session->set_flashdata('pesan', 'Data mata kuliah berhasil dihapus.');
        }
        redirect('matkul');
    }

    public function is_kd_matkul_exist($kd_baru) {
        $kd_sekarang = $this->session->userdata('kd_matkul_sekarang');
        if ($kd_baru === $kd_sekarang) return TRUE;

        $query = $this->db->get_where('matkul', ['kd_matkul' => $kd_baru]);
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('is_kd_matkul_exist', "Kode Mata Kuliah $kd_baru sudah terdaftar.");
            return FALSE;
        }
        return TRUE;
    }
}