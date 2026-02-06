<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mahasiswa extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->cek_akses('admin');
        $this->load->model('Mahasiswa_model', 'm_mhs');
        $this->load->model('Kelas_model', 'm_kelas');
        
        $this->data = [
            'modul'        => 'mahasiswa',
            'option_kelas' => $this->_get_options_kelas()
        ];
    }

    private function _get_options_kelas() {
        $kelas = $this->m_kelas->cari_semua();
        $opt[''] = '-- Pilih Kelas --';
        if ($kelas) {
            foreach ($kelas as $row) {
                $opt[$row->id_kelas] = $row->kelas;
            }
        }
        return $opt;
    }

    public function index($offset = 0) {
        // Reset session ID untuk keamanan proses edit
        $this->session->unset_userdata('nim_sekarang');
        
        $mahasiswa = $this->m_mhs->cari_semua($offset);

        $this->data['breadcrumb'] = 'Mahasiswa';
        $this->data['main_view']  = 'mahasiswa/mahasiswa';

        if ($mahasiswa) {
            $this->data['tabel_data'] = $this->m_mhs->buat_tabel($mahasiswa);
            $this->data['pagination'] = $this->m_mhs->paging(site_url('mahasiswa/index'));
        } else {
            $this->data['pesan'] = 'Tidak ada data mahasiswa.';
        }
        
        $this->load->view('template', $this->data);
    }

    public function tambah() {
        if ($this->input->post('submit')) {
            if ($this->m_mhs->validasi('tambah')) {
                $this->m_mhs->simpan('tambah');
                $this->session->set_flashdata('pesan', 'Tambah data berhasil.');
                redirect('mahasiswa');
            }
        }

        $this->data['breadcrumb']  = 'Mahasiswa > Tambah';
        $this->data['main_view']   = 'mahasiswa/mahasiswa_form';
        $this->data['form_action'] = 'mahasiswa/tambah';
        $this->load->view('template', $this->data);
    }

    public function edit($id = NULL) {
        if (!$id) redirect('mahasiswa');

        if ($this->input->post('submit')) {
            if ($this->m_mhs->validasi('edit')) {
                $nim_sekarang = $this->session->userdata('nim_sekarang');
                $this->m_mhs->simpan('edit', $nim_sekarang);
                
                $this->session->set_flashdata('pesan', 'Update data mahasiswa berhasil.');
                redirect('mahasiswa');
            }
        } else {
            $mhs = $this->db->get_where('mahasiswa', ['nim' => $id])->row_array();
            if (!$mhs) redirect('mahasiswa');
            
            $this->data['form_value'] = $mhs;
            // Simpan ID di session untuk mencegah ID spoofing saat submit
            $this->session->set_userdata('nim_sekarang', $id);
        }

        $this->data['breadcrumb']  = 'Mahasiswa > Edit';
        $this->data['main_view']   = 'mahasiswa/mahasiswa_form';
        $this->data['form_action'] = 'mahasiswa/edit/' . $id;
        $this->load->view('template', $this->data);
    }

    public function hapus($id = NULL) {
        if ($id) {
            $this->db->where('nim', $id)->delete('mahasiswa');
            $this->session->set_flashdata('pesan', 'Data mahasiswa berhasil dihapus.');
        }
        redirect('mahasiswa');
    }
}