<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('auth_model');
    }

	public function index() {
		$this->login();
	}

	public function login() {
		$this->load->view('headers_view');
		$this->load->view('auth/login_view');
		$this->load->view('footer_view');
	}

    public function authenticate() {
        $data = array(
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        );

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        $data = $this->security->xss_clean($data);

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Credenciales incorrectas');
            redirect('auth/login');
        }

        $user = $this->auth_model->getOne($data['email']);
        
        if (!empty($user) && password_verify($data['password'], $user->password)) {
            $this->session->set_userdata('user_id', $user->id);
            $this->session->set_userdata('user_email', $user->email);
            $this->session->set_userdata('user_name', $user->name);
            $this->session->set_userdata('user_role', $user->role);
            $this->session->set_flashdata('success', 'Bienvenido al sistema');
            redirect('panel');
        } else {
            $this->session->set_flashdata('error', 'Credenciales incorrectas');
            redirect('auth/login');
        }
    }

    public function logout() {
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_email');
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('user_role');
        $this->session->set_flashdata('success', 'Hasta luego');
        redirect('auth/login');
    }   

}
