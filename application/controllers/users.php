<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Users extends CI_Controller {
        
        public function __construct() {
            parent::__construct();
            $this->load->model('users_model');
        }

        public function index() {
            $users = $this->users_model->get_all();
            $data = array(
                'users' => $users
            );
            $this->load->view('headers_view');
            $this->load->view('panel/menu_view');
            $this->load->view('users/users_view', $data);
            $this->load->view('footer_view');
        }

        public function edit($id) {
            $user = $this->users_model->get_by_id($id);
            $data = array(
                'user' => $user
            );
            $this->load->view('headers_view');
            $this->load->view('panel/menu_view');
            $this->load->view('users/users_edit_view', $data);
            $this->load->view('footer_view');
        }

        public function create() {

            $this->form_validation->set_rules('name', 'Nombre', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('role', 'Role', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Error al crear el usuario');
                redirect('users');
            }

            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'role' => $this->input->post('role')
            );
            $user = $this->users_model->create($data);
            if($user){
                $this->session->set_flashdata('success', 'Usuario creado correctamente');
            }else{
                $this->session->set_flashdata('error', 'Error al crear el usuario');
            }
            redirect('users');
        }

        public function update($id) {

            $this->form_validation->set_rules('name', 'Nombre', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('role', 'Role', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Error al actualizar el usuario');
                redirect('users');
            }

            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'role' => $this->input->post('role')
            );
            

            $password = $this->input->post('password');
            if (!empty($password)) {
                $data['password'] = $password;
            }
            
            $data = $this->security->xss_clean($data);
            $user = $this->users_model->update($id, $data);

            if($user){
                $this->session->set_flashdata('success', 'Usuario actualizado correctamente');
            }else{
                $this->session->set_flashdata('error', 'Error al actualizar el usuario');
            }
            redirect('users');
        }

        public function delete($id) {
            $user = $this->users_model->delete($id);
            if($user){
                $this->session->set_flashdata('success', 'Usuario eliminado correctamente');
            }else{
                $this->session->set_flashdata('error', 'Error al eliminar el usuario');
            }
            redirect('users');
        }   

    }   
?>
