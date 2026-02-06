<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model {

    public $db_tabel    = 'mahasiswa';
    public $per_halaman = 10;
    public $offset      = 0;

    private function _get_form_rules($mode = 'tambah') {
        $rules = [
            ['field' => 'nama', 'label' => 'Nama', 'rules' => 'required|max_length[50]'],
            ['field' => 'email', 'label' => 'Email', 'rules' => 'required|valid_email|max_length[100]'], // Tambahan email
            ['field' => 'id_kelas', 'label' => 'Kelas', 'rules' => 'required']
        ];

        // Validasi NIM fleksibel (max 15 digit) sesuai kolom varchar(15)
        if ($mode == 'tambah') {
            $rules[] = ['field' => 'nim', 'label' => 'NIM', 'rules' => "required|max_length[15]|numeric|is_unique[mahasiswa.nim]"];
        } else {
            $rules[] = ['field' => 'nim', 'label' => 'NIM', 'rules' => "required|max_length[15]|numeric|callback_is_nim_exist"];
        }
        return $rules;
    }

    public function validasi($mode = 'tambah') {
        $this->load->library('form_validation'); // Pastikan library dimuat
        $this->form_validation->set_rules($this->_get_form_rules($mode));
        return $this->form_validation->run();
    }

    public function cari_semua($offset) {
        // Logika offset yang lebih bersih untuk pagination
        $this->offset = (empty($offset)) ? 0 : ($offset - 1) * $this->per_halaman;

        return $this->db->select('m.nim, m.nama, m.email, k.kelas as nama_kelas')
                        ->from('mahasiswa m')
                        ->join('kelas k', 'k.id_kelas = m.id_kelas', 'left') // LEFT JOIN agar data tetap muncul meski kelas dihapus
                        ->limit($this->per_halaman, $this->offset)
                        ->order_by('m.nim', 'DESC')
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
        
        $this->table->set_heading('No', 'NIM', 'Nama', 'Email', 'Kelas', 'Aksi');

        $no = $this->offset;
        foreach ($data as $row) {
            
            $aksi = anchor('mahasiswa/edit/'.$row->nim, '<i class="bi bi-pencil-square"></i>', ['class' => 'btn btn-sm btn-outline-primary', 'title' => 'Edit']) . ' ' .
                    anchor('mahasiswa/hapus/'.$row->nim, '<i class="bi bi-trash"></i>', [
                        'class' => 'btn btn-sm btn-outline-danger',
                        'onclick' => "return confirm('Yakin ingin menghapus mahasiswa ini?')",
                        'title' => 'Hapus'
                    ]);

            $this->table->add_row(++$no, $row->nim, $row->nama, $row->email, $row->nama_kelas, $aksi);
        }
        return $this->table->generate();
    }

    public function hitung_semua() {
        return $this->db->count_all($this->db_tabel);
    }

    public function paging($base_url) {
        $this->load->library('pagination');
        $config = array(
            'base_url'         => $base_url,
            'total_rows'       => $this->hitung_semua(),
            'per_page'         => $this->per_halaman,
            'uri_segment'      => 3,
            'use_page_numbers' => TRUE,
            'next_link'        => '&raquo;', 
            'prev_link'        => '&laquo;',
            'full_tag_open'    => '<div class="pagging text-center"><nav><ul class="pagination pagination-sm justify-content-center">',
            'full_tag_close'   => '</ul></nav></div>',
            'num_tag_open'     => '<li class="page-item"><span class="page-link">',
            'num_tag_close'    => '</span></li>',
            'cur_tag_open'     => '<li class="page-item active"><span class="page-link">',
            'cur_tag_close'    => '</span></li>', 
            'next_tag_open'    => '<li class="page-item"><span class="page-link">',
            'next_tagl_close'  => '</span></li>',
            'prev_tag_open'    => '<li class="page-item"><span class="page-link">',
            'prev_tagl_close'  => '</span></li>'
        );
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    public function simpan($mode = 'tambah', $nim_sekarang = NULL) {
        $data = [
            'nim'      => $this->input->post('nim'),
            'nama'     => $this->input->post('nama'),
            'email'    => $this->input->post('email'), 
            'id_kelas' => $this->input->post('id_kelas')
        ];

        if ($mode == 'tambah') {
            return $this->db->insert($this->db_tabel, $data);
        } else {
            // Update berdasarkan id_mahasiswa
            return $this->db->where('nim', $nim_sekarang)->update($this->db_tabel, $data);
        }
    }
}