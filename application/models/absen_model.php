<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Absen_model extends CI_Model {

    public $db_tabel = 'absen';
    public $per_halaman = 10;

    public function cari_semua($offset, $id_semester) {
        $off = (empty($offset)) ? 0 : ($offset * $this->per_halaman) - $this->per_halaman;
        return $this->db->select('a.id_absen, a.tanggal, a.absen, m.nim, m.nama, k.kelas, mk.matkul as nama_matkul')
                        ->from('absen a')
                        ->join('mahasiswa m', 'm.nim = a.nim')
                        ->join('kelas k', 'k.id_kelas = m.id_kelas')
                        ->join('matkul mk', 'mk.kd_matkul = a.kd_matkul')
                        ->where('a.id_semester', $id_semester)
                        ->order_by('a.id_absen', 'DESC')
                        ->limit($this->per_halaman, $off)
                        ->get()->result();
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
    
        $this->table->set_heading('No', 'Hari, Tanggal', 'NIM', 'Nama', 'Kelas', 'Status', 'Matkul', 'Aksi');
    
        $no = 0;
        foreach ($data as $row) {
            $hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'][date('w', strtotime($row->tanggal))];
            $tgl  = date('d-m-Y', strtotime($row->tanggal));
            
            // 3. Tombol dengan Bootstrap Icons (bi) dan class BS5 (btn-sm)
            $btn_edit  = anchor("absen/edit/{$row->id_absen}", '<i class="bi bi-pencil-square"></i>', ['class' => 'btn btn-sm btn-outline-primary', 'title' => 'Edit']);
            $btn_hapus = anchor("absen/hapus/{$row->id_absen}", '<i class="bi bi-trash"></i>', [
                'class' => 'btn btn-sm btn-outline-danger', 
                'onclick' => "return confirm('Apakah Anda yakin ingin menghapus data absen ini?')",
                'title' => 'Hapus'
            ]);
    
            $this->table->add_row(
                ++$no, 
                "<strong>$hari</strong>, $tgl", 
                $row->nim, 
                $row->nama, 
                '<span class="badge bg-secondary">'.$row->kelas.'</span>', 
                $this->_status($row->absen), 
                $row->nama_matkul,
                $btn_edit . ' ' . $btn_hapus // Spasi antar tombol menggunakan spasi biasa atau margin BS5
            );
        }
    
        return $this->table->generate();
    }
    
    // Tambahkan helper status jika belum ada untuk mempercantik teks status
    private function _status($s) {
        $class = [
            'H' => 'bg-success',
            'S' => 'bg-info',
            'I' => 'bg-warning text-dark',
            'A' => 'bg-danger',
            'T' => 'bg-dark'
        ];
        $label = ['H'=>'Hadir','S'=>'Sakit','I'=>'Ijin','A'=>'Alpha','T'=>'Terlambat'];
        $c = isset($class[$s]) ? $class[$s] : 'bg-secondary';
        $l = isset($label[$s]) ? $label[$s] : $s;
        return '<span class="badge '.$c.'">'.$l.'</span>';
    }public function simpan($mode = 'tambah', $id = NULL) {
    $data = [
        'nim'       => $this->input->post('nim'),
        'tanggal'   => date('Y-m-d', strtotime($this->input->post('tanggal'))),
        'absen'     => $this->input->post('absen'),
        'kd_matkul' => $this->input->post('kd_matkul')
    ];
    if ($mode == 'tambah') {
        $smt = $this->m_semester->cari_semester_aktif();
        $data['id_semester'] = $smt->id_semester;
        return $this->db->insert($this->db_tabel, $data);
    } else {
        return $this->db->where('id_absen', $id)->update($this->db_tabel, $data);
    }
}

    public function validasi_tambah() {
        $this->form_validation->set_rules('nim', 'NIM', 'required|callback_is_mahasiswa_exist');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|callback_is_format_tanggal|callback_is_double_entry_tambah');
        $this->form_validation->set_rules('absen', 'Status', 'required');
        $this->form_validation->set_rules('kd_matkul', 'Matkul', 'required');
        return $this->form_validation->run();
    }

    public function validasi_edit() {
        $this->form_validation->set_rules('nim', 'NIM', 'required|callback_is_mahasiswa_exist');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|callback_is_format_tanggal');
        $this->form_validation->set_rules('absen', 'Status', 'required');
        $this->form_validation->set_rules('kd_matkul', 'Matkul', 'required');
        return $this->form_validation->run();
    }

    public function cari($id) { return $this->db->get_where($this->db_tabel, ['id_absen'=>$id])->row(); }
   
    public function hitung_semua($id_semester = NULL) {
        if ($id_semester !== NULL) {
            $this->db->like('id_semester', $id_semester);
        }
        return $this->db->count_all_results($this->db_tabel);
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
}