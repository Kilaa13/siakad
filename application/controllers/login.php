<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Login_model', 'm_login');
    }

    public function index() {
        if ($this->session->userdata('logged_in')) redirect('dashboard');

        if ($this->m_login->validasi()) {
            $users = $this->m_login->cek_login();
            if ($users) {
                $session_data = [
                    'id_user'     => $users->id_user,
                    'username'    => $users->username,
                    'nama_lengkap'=> $users->nama_lengkap,
                    'role'        => $users->role, // admin/dosen/mahasiswa
                    'id_penerima' => $users->id_penerima,
                    'logged_in'   => TRUE
                ];
                $this->session->set_userdata($session_data);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('pesan', 'Username atau Password salah.');
            }
        }
        $this->load->view('login/login_form');
    }

    public function proses_lupa_password() {
    $email = $this->input->post('email');
    $user = $this->db->get_where('users', ['email' => $email])->row();

    if ($user) {
        $token = bin2hex(random_bytes(32)); // Buat token unik
        
        $this->db->insert('user_token', [
            'email' => $email,
            'token' => $token,
            'date_created' => time()
        ]);

        $this->_sendEmail($token, $email); 
        $this->session->set_flashdata('info', 'Silakan cek email Anda untuk reset password.');
    } else {
        $this->session->set_flashdata('error', 'Email tidak terdaftar!');
    }
    redirect('login/lupa_password');
}

    private function _sendEmail($token, $email) {
    $this->load->library('email'); // Load library CI3
    
    $this->email->from('noreply@absensi.com', 'Sistem Absensi');
    $this->email->to($email);
    $this->email->subject('Reset Password Link');
    $this->email->message('Klik link ini untuk reset password Anda: <a href="'.site_url('login/resetpassword?email='.$email.'&token='.$token).'">Reset Password</a>');

    return $this->email->send();
}

    public function lupa_password() {
    $this->load->view('login/lupa_password');
}

    public function resetpassword() {
    $email = $this->input->get('email');
    $token = $this->input->get('token');

    $user = $this->db->get_where('user', ['email' => $email])->row();

    if ($user) {
        
        $user_token = $this->db->get_where('user_token', ['token' => $token])->row();

        if ($user_token) {
            
            if (time() - $user_token->date_created < (60 * 60 * 24)) {
                $data['email'] = $email;
                $this->load->view('login/reset_password', $data);
            } else {
                $this->db->delete('user_token', ['email' => $email]);
                $this->session->set_flashdata('error', 'Token sudah kedaluwarsa!');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('error', 'Token tidak valid!');
            redirect('login');
        }
    } else {
        $this->session->set_flashdata('error', 'Email salah atau tidak ditemukan!');
        redirect('login');
    }
}

    public function ganti_password_fix() {
    $email = $this->input->post('email');
    $pass1 = $this->input->post('pass1');
    $pass2 = $this->input->post('pass2');

    if ($pass1 != $pass2) {
        $this->session->set_flashdata('error', 'Password tidak cocok!');
        redirect('login/resetpassword?email='.$email.'&token=...'); 
    } else {
        $password_hash = password_hash($pass1, PASSWORD_DEFAULT);
        
        $this->db->set('password', $password_hash);
        $this->db->where('email', $email);
        $this->db->update('user');

        
        $this->db->delete('user_token', ['email' => $email]);

        $this->session->set_flashdata('success', 'Password berhasil diubah. Silakan login!');
        redirect('login');
    }
}
    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }

}