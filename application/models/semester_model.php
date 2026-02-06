<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Semester_model extends CI_Model {

    public $db_tabel = 'semester';

    public function cari_aktif()
{
    // Pastikan nama tabel benar, yaitu 'semester'
    return $this->db->where('status', 'Y')
                    ->limit(1)
                    ->get($this->db_tabel)
                    ->row(); 
}
    public function cari_semua()
    {
        return $this->db->order_by('id_semester', 'ASC')
                        ->get($this->db_tabel)
                        ->result();
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

        $this->table->set_heading('Periode Semester', 'Status Aktif', 'Pilih');

        foreach ($data as $row)
        {
            $nama_semester = ($row->id_semester == 1) ? 'Semester 1 (Ganjil)' : 'Semester 2 (Genap)';
            
            // Badge Status untuk mempercantik tabel
            $status_badge = ($row->status == 'Y') 
                ? '<span class="badge bg-success shadow-sm px-3 rounded-pill">Aktif Sekarang</span>' 
                : '<span class="badge bg-light text-muted border px-3 rounded-pill">Non-Aktif</span>';

            $this->table->add_row(
                '<strong>' . $nama_semester . '</strong>',
                $status_badge,
                form_radio('id_semester', $row->id_semester, ($row->status == 'Y' ? TRUE : FALSE), 'class="form-check-input"')
            );
        }
        return $this->table->generate();
    }

    public function set()
    {
        $id_semester = $this->input->post('id_semester');

        // Menggunakan Query Builder agar lebih aman dari SQL Injection
        $this->db->trans_start();
        
        // 1. Set yang dipilih jadi Aktif
        $this->db->where('id_semester', $id_semester)->update($this->db_tabel, array('status' => 'Y'));
        
        // 2. Set sisanya jadi Non-Aktif
        $this->db->where('id_semester !=', $id_semester)->update($this->db_tabel, array('status' => 'N'));
        
        $this->db->trans_complete();

        return $this->db->trans_status();
    }
}