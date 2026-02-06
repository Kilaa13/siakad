<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Matkul_model extends CI_Model {

    public $db_tabel    = 'matkul';
    public $per_halaman = 10;
    public $offset      = 0;

    private function _get_form_rules($mode = 'tambah') {
        $rules = [
            ['field' => 'matkul', 'label' => 'Nama Matkul', 'rules' => 'required|max_length[100]'],
            ['field' => 'jm_sks', 'label' => 'SKS', 'rules' => 'required|numeric'],
            ['field' => 'jam', 'label' => 'Waktu', 'rules' => 'required'],
            ['field' => 'ruangan', 'label' => 'Ruangan', 'rules' => 'required'],
            ['field' => 'id_dosen', 'label' => 'Dosen Pengampu', 'rules' => 'required']
        ];

        if ($mode == 'tambah') {
            $rules[] = ['field' => 'kd_matkul', 'label' => 'Kode Matkul', 'rules' => "required|is_unique[$this->db_tabel.kd_matkul]"];
        } else {
            $rules[] = ['field' => 'kd_matkul', 'label' => 'Kode Matkul', 'rules' => "required|callback_is_kd_matkul_exist"];
        }
        return $rules;
    }

    public function validasi($mode = 'tambah') {
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->_get_form_rules($mode));
        return $this->form_validation->run();
    }

    // Tambahkan = NULL agar parameter offset tidak wajib diisi
public function cari_semua($offset = NULL) 
{
    // Jika offset NULL, ambil semua data tanpa limit (untuk dropdown di modul Absen)
    if ($offset === NULL) {
        return $this->db->select('m.*, d.nama_dosen')
                        ->from($this->db_tabel . ' m')
                        ->join('dosen d', 'd.id_dosen = m.id_dosen', 'left')
                        ->get()
                        ->result();
    }

    // Jika ada offset, jalankan logika pagination (untuk halaman Daftar Matkul)
    $this->offset = (empty($offset)) ? 0 : ($offset - 1) * $this->per_halaman;
    
    return $this->db->select('m.*, d.nama_dosen')
                    ->from($this->db_tabel . ' m')
                    ->join('dosen d', 'd.id_dosen = m.id_dosen', 'left')
                    ->limit($this->per_halaman, $this->offset)
                    ->order_by('m.kd_matkul', 'DESC')
                    ->get()
                    ->result();
}
    public function buat_tabel($data) {
        $this->load->library('table'); 
        $tmpl = array (
            'table_open'          => '<div class="table-responsive"><table class="table table-hover align-middle shadow-sm">',
            'heading_cell_start'  => '<th class="bg-primary text-white p-3">',
            'row_start'           => '<tr>',
            'row_alt_start'       => '<tr class="table-light">', 
        );
        $this->table->set_template($tmpl);
    
        $this->table->set_heading('No', 'Kode', 'Mata Kuliah', 'SKS', 'Waktu', 'Lokasi', 'Dosen Pengampu', 'Aksi');

        $no = $this->offset;
        foreach ($data as $row) {
            $dosen = $row->nama_dosen ? $row->nama_dosen : '-';
            
            $aksi = anchor('matkul/edit/'.$row->kd_matkul, '<i class="bi bi-pencil-square"></i>', ['class' => 'btn btn-sm btn-outline-primary', 'title' => 'Edit']) . ' ' .
                    anchor('matkul/hapus/'.$row->kd_matkul, '<i class="bi bi-trash"></i>', [
                        'class' => 'btn btn-sm btn-outline-danger',
                        'onclick' => "return confirm('Yakin ingin menghapus mata kuliah ini?')",
                        'title' => 'Hapus'
                    ]);

            $this->table->add_row(++$no, $row->kd_matkul, $row->matkul, $row->jm_sks, $row->jam, $row->ruangan, $dosen, $aksi);
        }
        return $this->table->generate();
    }

    public function hitung_semua() {
        return $this->db->count_all('matkul'); // Pastikan 'matkul' adalah nama tabelmu
    }

    public function paging($base_url) {
        $this->load->library('pagination');
        $config = [
            'base_url'         => $base_url,
            'total_rows'       => $this->db->count_all($this->db_tabel),
            'per_page'         => $this->per_halaman,
            'use_page_numbers' => TRUE,
            'full_tag_open'    => '<div class="pagging text-center"><nav><ul class="pagination pagination-sm justify-content-center">',
            'full_tag_close'   => '</ul></nav></div>',
            'num_tag_open'     => '<li class="page-item"><span class="page-link">',
            'num_tag_close'    => '</span></li>',
            'cur_tag_open'     => '<li class="page-item active"><span class="page-link">',
            'cur_tag_close'    => '</span></li>',
            'next_link'        => '&raquo;',
            'prev_link'        => '&laquo;',
            'next_tag_open'    => '<li class="page-item"><span class="page-link">',
            'next_tagl_close'  => '</span></li>',
            'prev_tag_open'    => '<li class="page-item"><span class="page-link">',
            'prev_tagl_close'  => '</span></li>'
        ];
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    public function simpan($mode = 'tambah', $kd_lama = NULL) {
        $data = [
            'kd_matkul' => $this->input->post('kd_matkul'),
            'matkul'    => $this->input->post('matkul'),
            'jm_sks'    => $this->input->post('jm_sks'),
            'jam'       => $this->input->post('jam'),     
            'ruangan'   => $this->input->post('ruangan'), 
            'id_dosen'  => $this->input->post('id_dosen') 
        ];

        if ($mode == 'tambah') {
            return $this->db->insert($this->db_tabel, $data);
        } else {
            return $this->db->where('kd_matkul', $kd_lama)->update($this->db_tabel, $data);
        }
    }
}