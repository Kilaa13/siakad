<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

    public $db_tabel = 'users';

    public function load_form_rules()
    {
        $form_rules = array(
                            array(
                                'field' => 'username',
                                'label' => 'Username',
                                'rules' => 'required'
                            ),
                            array(
                                'field' => 'password',
                                'label' => 'Password',
                                'rules' => 'required'
                            ),
        );
        return $form_rules;
    }

    public function validasi()
    {
        $form = $this->load_form_rules();
        $this->form_validation->set_rules($form);

        if ($this->form_validation->run())
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function cek_login() {
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    
    $user = $this->db->get_where($this->db_tabel, ['username' => $username])->row();

    if ($user) {
        
        if ($user->password == md5($password)) {
            return $user;
        } 
        
        if (password_verify($password, $user->password)) {
            return $user;
        }
    }

    return FALSE;
}

    public function logout()
    {
        $this->session->unset_userdata(array('username' => '', 'login' => FALSE));
        $this->session->sess_destroy();
    }
}