<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Categories extends CI_Controller {
        
        public function __construct() {
            parent::__construct();
            $this->load->model('categories_model');
        }

        public function index() {
            $categories = $this->categories_model->get_all();
            $data = array(
                'categories' => $categories
            );
            $this->load->view('headers_view');
            $this->load->view('panel/menu_view');
            $this->load->view('categories/categories_view', $data);
            $this->load->view('footer_view');
        }

        public function edit($id) {

            $category = $this->categories_model->get_by_id($id);
            $data = array(
                'category' => $category
            );
            $this->load->view('headers_view');
            $this->load->view('panel/menu_view');
            $this->load->view('categories/categories_edit_view', $data);
            $this->load->view('footer_view');
        }

        public function create() {

            $this->form_validation->set_rules('name', 'Nombre', 'required');
            $this->form_validation->set_rules('description', 'Descripción', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Error al crear la categoría');
                redirect('categories');
            }

            $data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description')
            );
            
            $data = $this->security->xss_clean($data);
            $category = $this->categories_model->create($data);
            if($category){
                $this->session->set_flashdata('success', 'Categoría creada correctamente');
            }else{
                $this->session->set_flashdata('error', 'Error al crear la categoría');
            }
            redirect('categories');
        }

        public function update($id) {

            $this->form_validation->set_rules('name', 'Nombre', 'required');
            $this->form_validation->set_rules('description', 'Descripción', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Error al actualizar la categoría');
                redirect('categories');
            }

            $data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description')
            );
            
            $data = $this->security->xss_clean($data);
            $category = $this->categories_model->update($id, $data);
            if($category){
                $this->session->set_flashdata('success', 'Categoría actualizada correctamente');
            }else{
                $this->session->set_flashdata('error', 'Error al actualizar la categoría');
            }
            redirect('categories');
        }

        public function delete($id) {
            $category = $this->categories_model->delete($id);
            if($category){
                $this->session->set_flashdata('success', 'Categoría eliminada correctamente');
            }else{
                $this->session->set_flashdata('error', 'Error al eliminar la categoría');
            }
            redirect('categories');
        }   

    }   
?>
