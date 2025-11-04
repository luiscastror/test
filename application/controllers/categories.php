<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Categories extends CI_Controller {
        
        public function __construct() {
            parent::__construct();
            $this->load->model('categories_model');
        }

        public function index($offset = 0) {
            $search = $this->input->get('search');
            $per_page = $this->input->get('per_page') ? (int)$this->input->get('per_page') : 5;
            $offset = (int)$offset;
            
            if ($search) {
                $search = $this->security->xss_clean($search);
            }

            $config = array();
            $config['base_url'] = base_url('categories/index');
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
                $config['total_rows'] = $this->categories_model->count_search_results($search);
                $categories = $this->categories_model->search_categories($search, $per_page, $offset);
                
                $config['suffix'] = '?search=' . urlencode($search) . '&per_page=' . $per_page;
                $config['first_url'] = $config['base_url'] . '/0?search=' . urlencode($search) . '&per_page=' . $per_page;
            } else {
                $config['total_rows'] = $this->categories_model->count_all_categories();
                $categories = $this->categories_model->get_categories_paginated($per_page, $offset);
                
                if ($per_page != 5) {
                    $config['suffix'] = '?per_page=' . $per_page;
                    $config['first_url'] = $config['base_url'] . '/0?per_page=' . $per_page;
                }
            }

            $this->pagination->initialize($config);

            foreach ($categories as &$category) {
                $category['products_count'] = $this->categories_model->get_products_count($category['id']);
                $category['has_products'] = $category['products_count'] > 0;
            }

            $data = array(
                'categories' => $categories,
                'pagination' => $this->pagination->create_links(),
                'search_term' => $search,
                'per_page' => $per_page,
                'total_categories' => $config['total_rows'],
                'current_page' => $offset,
                'total_pages' => ceil($config['total_rows'] / $per_page)
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
            // Verificar si la categoría existe
            $category = $this->categories_model->get_by_id($id);
            if (!$category) {
                $this->session->set_flashdata('error', 'La categoría no existe');
                redirect('categories');
                return;
            }

            // Verificar si la categoría tiene productos asociados
            if ($this->categories_model->has_products($id)) {
                $products_count = $this->categories_model->get_products_count($id);
                $this->session->set_flashdata('error', 
                    'No se puede eliminar la categoría "' . $category['name'] . '" porque tiene ' . 
                    $products_count . ' producto(s) asociado(s). Elimine primero los productos o cambie su categoría.'
                );
                redirect('categories');
                return;
            }

            // Si no tiene productos asociados, proceder con la eliminación
            $deleted = $this->categories_model->delete($id);
            if ($deleted) {
                $this->session->set_flashdata('success', 'Categoría "' . $category['name'] . '" eliminada correctamente');
            } else {
                $this->session->set_flashdata('error', 'Error al eliminar la categoría');
            }
            redirect('categories');
        }   

    }   
?>
