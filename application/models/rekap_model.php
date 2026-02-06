<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Rekap_model extends CI_Model {

    public $db_tabel = 'absen';
	public function rekap($id_kelas, $id_semester, $kd_matkul)
	{
		$this->db->select('m.nim, m.nama, 
        SUM(IF(a.absen = "H" AND a.kd_matkul = ' . $this->db->escape($kd_matkul) . ', 1, 0)) AS hadir,
        SUM(IF(a.absen = "S" AND a.kd_matkul = ' . $this->db->escape($kd_matkul) . ', 1, 0)) AS sakit,
        SUM(IF(a.absen = "I" AND a.kd_matkul = ' . $this->db->escape($kd_matkul) . ', 1, 0)) AS ijin,
        SUM(IF(a.absen = "A" AND a.kd_matkul = ' . $this->db->escape($kd_matkul) . ', 1, 0)) AS alpha,
        SUM(IF(a.absen = "T" AND a.kd_matkul = ' . $this->db->escape($kd_matkul) . ', 1, 0)) AS terlambat', FALSE);
			
		$this->db->from('mahasiswa m');
		$this->db->join('absen a', "a.nim = m.nim AND a.id_semester = '$id_semester' AND a.kd_matkul = '$kd_matkul'", 'left');
		$this->db->where('m.id_kelas', $id_kelas);
		$this->db->group_by('m.nim');
		$this->db->order_by('m.nim', 'ASC');
		
		return $this->db->get()->result();
	}
	
	public function buat_tabel($rekap)
	{
		$this->load->library('table');
		$tmpl = array (
            'table_open'          => '<div class="table-responsive"><table class="table table-hover align-middle shadow-sm">',
            'heading_cell_start'  => '<th class="bg-primary text-white p-3">',
            'row_start'           => '<tr>',
            'row_alt_start'       => '<tr class="table-light">', 
        );
        $this->table->set_template($tmpl);

		$this->table->set_heading('No', 'NIM', 'Nama', 'Hadir', 'Sakit', 'Ijin', 'Alpha', 'Terlambat');
	
		$no = 0;
		
		foreach ($rekap as $row) {
			$this->table->add_row(
				++$no,
				$row->nim,
				$row->nama,
				$this->_format_angka($row->hadir), // Menggunakan helper format
				$this->_format_angka($row->sakit),
				$this->_format_angka($row->ijin),
				$this->_format_angka($row->alpha),
				$this->_format_angka($row->terlambat)
			);
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

    private function _format_angka($angka)
    {
        return ($angka > 0) ? "<b>$angka</b>" : '<span class="text-muted">0</span>';
    }

    public function get_detail_absen($id_kelas, $id_semester, $kd_matkul)
{
    $this->db->select('m.nim, m.nama, a.absen, a.tanggal');
    $this->db->from('mahasiswa m');
    // Join untuk mengambil status absen dari tabel absen
    $this->db->join('absen a', "a.nim = m.nim AND a.id_semester = '$id_semester' AND a.kd_matkul = '$kd_matkul'", 'left');
    $this->db->where('m.id_kelas', $id_kelas);
    $this->db->order_by('a.tanggal', 'DESC'); // Urutkan berdasarkan tanggal terbaru
    
    return $this->db->get()->result();
}
}