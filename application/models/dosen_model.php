<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dosen_model extends CI_Model {

    public $db_tabel    = 'dosen';
    public $per_halaman = 10;
    public $offset      = 0;

    // Menangani validasi dengan satu pintu
    private function _get_form_rules($mode = 'tambah') {
        $rules = [
            ['field' => 'nama_dosen', 'label' => 'Nama Dosen', 'rules' => 'required|max_length[100]'],
            ['field' => 'email', 'label' => 'Email', 'rules' => 'required|valid_email']
        ];

        // Validasi NIDN: Harus unik saat tambah baru
        if ($mode == 'tambah') {
            $rules[] = ['field' => 'nidn', 'label' => 'NIDN', 'rules' => "required|numeric|is_unique[dosen.nidn]"];
        } else {
            $rules[] = ['field' => 'nidn', 'label' => 'NIDN', 'rules' => "required|numeric"];
        }
        return $rules;
    }

    public function validasi($mode = 'tambah') {
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->_get_form_rules($mode));
        return $this->form_validation->run();
    }


    // Tambahkan = NULL pada parameter agar tidak error saat dipanggil kosong
    public function cari_semua($offset = NULL) 
    {
        if ($offset === NULL) {
            return $this->db->get($this->db_tabel)->result();
        }

        $this->offset = (empty($offset)) ? 0 : ($offset - 1) * $this->per_halaman;
        return $this->db->limit($this->per_halaman, $this->offset)
                        ->get($this->db_tabel)
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
        
        $this->table->set_heading('No', 'NIDN', 'Nama Dosen', 'Email', 'Aksi');

        $no = 0 + $this->offset;
        foreach ($data as $row) {
            $aksi = anchor('dosen/edit/'.$row->id_dosen, '<i class="bi bi-pencil-square"></i>', ['class' => 'btn btn-sm btn-outline-primary', 'title' => 'Edit']) . ' ' .
                    anchor('dosen/hapus/'.$row->id_dosen, '<i class="bi bi-trash"></i>', [
                        'class' => 'btn btn-sm btn-outline-danger',
                        'onclick' => "return confirm('Yakin hapus data dosen ini?')",
                        'title' => 'Hapus'
                    ]);

            $this->table->add_row(++$no, $row->nidn, $row->nama_dosen, $row->email, $aksi);
        }
        return $this->table->generate();
    }

    public function hitung_semua() {
        return $this->db->count_all($this->db_tabel);
    }

    public function paging($base_url, $total_rows) {
        $this->load->library('pagination');
        $config = array(
            'base_url'         => $base_url,
            'total_rows'       => $total_rows,
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

    public function simpan($mode = 'tambah', $id_lama = NULL) {
        $data = [
            'nidn'       => $this->input->post('nidn'),
            'nama_dosen' => $this->input->post('nama_dosen'),
            'email'      => $this->input->post('email')
        ];

        if ($mode == 'tambah') {
            return $this->db->insert($this->db_tabel, $data);
        } else {
            // Update menggunakan id_dosen (Primary Key) agar lebih aman
            return $this->db->where('id_dosen', $id_lama)->update($this->db_tabel, $data);
        }
    }

    public function hapus($id) {
        return $this->db->where('id_dosen', $id)->delete($this->db_tabel);
    }
}