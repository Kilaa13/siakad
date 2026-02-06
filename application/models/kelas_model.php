<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kelas_model extends CI_Model {

    public $db_tabel = 'kelas';
    public $per_halaman = 10; 

    public function __construct()
    {
        parent::__construct();
    }
    public function buat_tabel($data)
    {
        $this->load->library('table');
        $tmpl = array (
            'table_open'          => '<div class="table-responsive"><table class="table table-hover align-middle shadow-sm">',
            'heading_cell_start'  => '<th class="bg-primary text-white p-3">',
            'row_start'           => '<tr>',
            'row_alt_start'       => '<tr class="table-light">', 
        );
        $this->table->set_template($tmpl);

        $this->table->set_heading('No', 'Kode Kelas', 'Nama Kelas', 'Jumlah Mahasiswa', 'Aksi');

        $no = 0;
        foreach ($data as $row)
        {
            $this->table->add_row(
                ++$no,
                $row->id_kelas,
                $row->kelas,
                $row->jm_mhs,
                
                anchor('kelas/edit/'.$row->id_kelas, '<i class="bi bi-pencil-square"></i>', ['class' => 'btn btn-sm btn-outline-primary', 'title' => 'Edit']) . ' ' .
                
                anchor('kelas/hapus/'.$row->id_kelas, '<i class="bi bi-trash"></i>', [
                    'class'   => 'btn btn-sm btn-outline-danger',
                    'onclick' => "return confirm('Apakah Anda yakin ingin menghapus kelas ",
                    'title' => 'Hapus'
                ])
            );
        }
        
        return $this->table->generate();
    }
    public function hitung_semua() 
    {
        // Menghitung total baris untuk keperluan pagination
        return $this->db->count_all($this->db_tabel);
    }

    public function paging($base_url, $total_rows) 
    {
        $this->load->library('pagination');
        $config = array(
            'base_url'         => $base_url,
            'total_rows'       => $total_rows,
            'per_page'         => $this->per_halaman, // Mengacu pada variabel class
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

    public function cari_semua($offset = NULL)
    {
        $this->db->order_by('id_kelas', 'DESC');
        
        // Jika ada offset, aktifkan fitur limit
        if ($offset !== NULL) {
            // Konversi nomor halaman menjadi baris awal data (start row)
            $halaman_awal = (empty($offset) || $offset == 1) ? 0 : ($offset - 1) * $this->per_halaman;
            $this->db->limit($this->per_halaman, $halaman_awal);
        }
        
        return $this->db->get($this->db_tabel)->result();
    }

    public function cari($id_kelas)
    {
        return $this->db->where('id_kelas', $id_kelas)
                        ->limit(1)
                        ->get($this->db_tabel)
                        ->row();
    }

    // --- VALIDASI & CRUD (TETAP) ---

    public function load_form_rules_tambah()
    {
        return array(
            array(
                'field' => 'id_kelas',
                'label' => 'Kode Kelas',
                'rules' => "required|exact_length[2]|is_unique[$this->db_tabel.id_kelas]"
            ),
            array(
                'field' => 'kelas',
                'label' => 'Nama Kelas',
                'rules' => "required|max_length[32]|is_unique[$this->db_tabel.kelas]"
            ),
        );
    }

    public function validasi_tambah()
    {
        $this->form_validation->set_rules($this->load_form_rules_tambah());
        return $this->form_validation->run();
    }

    public function tambah()
    {
        $data = array(
            'id_kelas' => $this->input->post('id_kelas'),
            'kelas'    => $this->input->post('kelas'),
            'jm_mhs'   => $this->input->post('jm_mhs')
        );
        return $this->db->insert($this->db_tabel, $data);
    }

    public function edit($id_kelas)
    {
        $kelas = array(
            'id_kelas'=>$this->input->post('id_kelas'),
            'kelas'=>$this->input->post('kelas'),
            'jm_mhs' => $this->input->post('jm_mhs')
        );

        // update db
        $this->db->where('id_kelas', $id_kelas);
		$this->db->update($this->db_tabel, $kelas);

        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function hapus($id_kelas)
    {
        $this->db->where('id_kelas', $id_kelas)->delete($this->db_tabel);

        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }
}
/* End of file kelas_model.php */
/* Location: ./application/models/kelas_model.php */