<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Users extends CI_Controller {
        
        public function __construct() {
            parent::__construct();
            $this->load->model('users_model');
        }

        public function index($offset = 0) {
            $search = $this->input->get('search');
            $per_page = $this->input->get('per_page') ? (int)$this->input->get('per_page') : 5;
            $offset = (int)$offset;
            
            if ($search) {
                $search = $this->security->xss_clean($search);
                $search = trim($search);
            }

            $config = array();
            $config['base_url'] = base_url('users/index');
            $config['total_rows'] = 0;
            $config['per_page'] = $per_page;
            $config['uri_segment'] = 3;
            $config['use_page_numbers'] = FALSE;
            
            $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
            $config['full_tag_close'] = '</ul></nav>';

            $config['first_link'] = 'Primera';
            $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['first_tag_close'] = '</span></li>';

            $config['last_link'] = 'Última';
            $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['last_tag_close'] = '</span></li>';

            $config['next_link'] = 'Siguiente';
            $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['next_tag_close'] = '</span></li>';

            $config['prev_link'] = 'Anterior';
            $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['prev_tag_close'] = '</span></li>';

            $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
            $config['cur_tag_close'] = '</span></li>';

            $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['num_tag_close'] = '</span></li>';

            $config['attributes'] = array('class' => 'page-link');

            if (!empty($search)) {
                $config['total_rows'] = $this->users_model->count_search_results($search);
                $users = $this->users_model->search_users($search, $per_page, $offset);
                
                $search_param = urlencode($search);
                $config['suffix'] = "?search={$search_param}&per_page={$per_page}";
                $config['first_url'] = $config['base_url'] . "/0?search={$search_param}&per_page={$per_page}";
            } else {
                $config['total_rows'] = $this->users_model->count_all_users();
                $users = $this->users_model->get_users_paginated($per_page, $offset);
                
                if ($per_page != 5) {
                    $config['suffix'] = "?per_page={$per_page}";
                    $config['first_url'] = $config['base_url'] . "/0?per_page={$per_page}";
                }
            }

            $this->pagination->initialize($config);

            $data = array(
                'users' => $users,
                'pagination' => $this->pagination->create_links(),
                'search_term' => $search,
                'per_page' => $per_page,
                'total_users' => $config['total_rows'],
                'current_page' => $offset,
                'total_pages' => ceil($config['total_rows'] / $per_page)
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
