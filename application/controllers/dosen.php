<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dosen extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->cek_akses('admin');
        $this->load->model('Dosen_model', 'm_dosen');
        $this->data = [
            'modul'      => 'dosen',
            'breadcrumb' => 'Dosen',
            'main_view'  => 'dosen/dosen', // Pastikan file views/dosen/dosen.php ada
        ];
    }

    public function index($offset = 0) {
        $this->session->unset_userdata('id_dosen_sekarang');
        
        $total_rows = $this->m_dosen->hitung_semua();
        $pagination = $this->m_dosen->paging(site_url('dosen/index'), $total_rows);
    
        // Ambil data berdasarkan offset
        $dosen = $this->m_dosen->cari_semua($offset);
    
        if ($dosen) {
            $this->data['tabel_data'] = $this->m_dosen->buat_tabel($dosen);
            $this->data['pagination'] = $pagination;
        } else {
            $this->data['pesan'] = 'Tidak ada data dosen.';
        }
        $this->load->view('template', $this->data);
    }


    public function tambah() {
        if ($this->input->post('submit')) {
            if ($this->m_dosen->validasi('tambah')) {
                $this->m_dosen->simpan('tambah');
                $this->session->set_flashdata('pesan', 'Tambah data dosen berhasil.');
                redirect('dosen');
            }
        }
        $this->data['breadcrumb']  = 'Dosen > Tambah';
        $this->data['main_view']   = 'dosen/dosen_form';
        $this->data['form_action'] = 'dosen/tambah';
        $this->load->view('template', $this->data);
    }

    public function edit($id = NULL) {
        // Gunakan id_dosen sebagai parameter utama
        if (!$id) redirect('dosen');

        if ($this->input->post('submit')) {
            if ($this->m_dosen->validasi('edit')) {
                // Update berdasarkan id_dosen yang disimpan di session
                $this->m_dosen->simpan('edit', $this->session->userdata('id_dosen_sekarang'));
                $this->session->set_flashdata('pesan', 'Update data dosen berhasil.');
                redirect('dosen');
            }
        } else {
            $dosen = $this->db->get_where('dosen', ['id_dosen' => $id])->row_array();
            if (!$dosen) redirect('dosen');
            
            $this->data['form_value'] = $dosen;
            // Simpan id_dosen ke session untuk keamanan saat update
            $this->session->set_userdata('id_dosen_sekarang', $id);
        }

        $this->data['breadcrumb']  = 'Dosen > Edit';
        $this->data['main_view']   = 'dosen/dosen_form';
        $this->data['form_action'] = 'dosen/edit/'.$id;
        $this->load->view('template', $this->data);
    }

    public function hapus($id) {
        if ($id) {
            $this->m_dosen->hapus($id);
            $this->session->set_flashdata('pesan', 'Data dosen berhasil dihapus.');
        }
        redirect('dosen');
    }
}