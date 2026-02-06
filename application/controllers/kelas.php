<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kelas extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->cek_akses('admin');
        $this->load->model('Kelas_model', 'm_kelas');
        
        $this->data = [
            'modul'      => 'kelas',
            'breadcrumb' => 'Kelas',
            'main_view'  => 'kelas/kelas'
        ];
    }

    public function index($offset = 0) {
        $this->session->unset_userdata('id_kelas_sekarang');
        $this->session->unset_userdata('kelas_sekarang');
        
        $kelas = $this->m_kelas->cari_semua($offset);

        if ($kelas) {
            $this->data['tabel_data'] = $this->m_kelas->buat_tabel($kelas);
            $this->data['pagination'] = $this->m_kelas->paging(site_url('kelas/index'), $this->m_kelas->hitung_semua());
        } else {
            $this->data['pesan'] = 'Tidak ada data kelas.';
        }
        
        $this->load->view('template', $this->data);
    }

    public function tambah() {
        if ($this->input->post('submit')) {
            if ($this->m_kelas->validasi_tambah()) {
                if ($this->m_kelas->tambah()) {
                    $this->session->set_flashdata('pesan', 'Tambah data kelas berhasil.');
                    redirect('kelas');
                }
            }
        }

        $this->data['breadcrumb']  = 'Kelas > Tambah';
        $this->data['main_view']   = 'kelas/kelas_form';
        $this->data['form_action'] = 'kelas/tambah';
        $this->load->view('template', $this->data);
    }

    public function edit($id = NULL) {
        if (!$id) redirect('kelas');

        if ($this->input->post('submit')) {
            if ($this->m_kelas->validasi_edit()) {
                $id_sekarang = $this->session->userdata('id_kelas_sekarang');
                $this->m_kelas->edit($id_sekarang);
                
                $this->session->set_flashdata('pesan', 'Update data kelas berhasil.');
                redirect('kelas');
            }
        } else {
            $kelas = $this->m_kelas->cari($id);
            if (!$kelas) redirect('kelas');
            
            foreach($kelas as $key => $value) {
                $this->data['form_value'][$key] = $value;
            }

            $this->session->set_userdata('id_kelas_sekarang', $id);
            $this->session->set_userdata('kelas_sekarang', $kelas->kelas);
        }

        $this->data['breadcrumb']  = 'Kelas > Edit';
        $this->data['main_view']   = 'kelas/kelas_form';
        $this->data['form_action'] = 'kelas/edit/' . $id;
        $this->load->view('template', $this->data);
    }

    public function hapus($id = NULL) {
        if ($id) {
            if ($this->m_kelas->hapus($id)) {
                $this->session->set_flashdata('pesan', 'Data kelas berhasil dihapus.');
            } else {
                $this->session->set_flashdata('pesan', 'Gagal menghapus data kelas.');
            }
        }
        redirect('kelas');
    }
}