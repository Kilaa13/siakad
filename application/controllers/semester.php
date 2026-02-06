<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Semester extends MY_Controller
{
    public $data = array(
        'modul'         => 'semester',
        'breadcrumb'    => 'Sistem Kontrol Semester',
        'pesan'         => '',
        'tabel_data'    => '',
        'main_view'     => 'semester/semester',
        'form_action'   => 'semester',
        'form_value'    => '',
        'semester_aktif' => '', // Tambahkan variabel ini
    );

    public function __construct()
    {
        parent::__construct();
        $this->cek_akses('admin');
        $this->load->model('Semester_model', 'semester', TRUE);
    }
    public function index()
    {
        
        $semester = $this->semester->cari_semua();
        if ($semester) {
            $this->data['tabel_data'] = $this->semester->buat_tabel($semester);
        }
    
        
        $aktif = $this->semester->cari_aktif(); 
        
        
        if ($aktif) {
            $this->data['semester_aktif'] = ($aktif->id_semester == 1) ? "Semester 1 (Ganjil)" : "Semester 2 (Genap)";
        } else {
            $this->data['semester_aktif'] = "Belum Ada Semester Aktif";
        }
    
        
        if($this->input->post('submit')) {
            $this->semester->set();
            $this->session->set_flashdata('pesan', 'Konfigurasi Sistem Berhasil Diperbarui!');
            redirect('semester');
        } else {
            
            $this->load->view('template', $this->data);
        }
    }
}