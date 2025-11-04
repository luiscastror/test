<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Items extends CI_Controller {
        
        public function __construct() {
            parent::__construct();
            $this->load->model('items_model');
            $this->load->model('categories_model');
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
            $config['base_url'] = base_url('items/index');
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
                $config['total_rows'] = $this->items_model->count_search_results($search);
                $items = $this->items_model->search_items($search, $per_page, $offset);
                
                $search_param = urlencode($search);
                $config['suffix'] = "?search={$search_param}&per_page={$per_page}";
                $config['first_url'] = $config['base_url'] . "/0?search={$search_param}&per_page={$per_page}";
            } else {
                $config['total_rows'] = $this->items_model->count_all_items();
                $items = $this->items_model->get_items_paginated($per_page, $offset);
                
                if ($per_page != 5) {
                    $config['suffix'] = "?per_page={$per_page}";
                    $config['first_url'] = $config['base_url'] . "/0?per_page={$per_page}";
                }
            }

            $this->pagination->initialize($config);

            $data = array(
                'items' => $items,
                'pagination' => $this->pagination->create_links(),
                'search_term' => $search,
                'per_page' => $per_page,
                'total_items' => $config['total_rows'],
                'current_page' => $offset,
                'total_pages' => ceil($config['total_rows'] / $per_page)
            );

            $this->load->view('headers_view');
            $this->load->view('panel/menu_view');
            $this->load->view('items/items_view', $data);
            $this->load->view('footer_view');
        }

        public function edit($id) {

            

            $item = $this->items_model->get_by_id($id);
            $categories = $this->categories_model->get_all();
            $data = array(
                'item' => $item,
                'categories' => $categories
            );
            $this->load->view('headers_view');
            $this->load->view('panel/menu_view');
            $this->load->view('items/items_edit_view', $data);
            $this->load->view('footer_view');
        }

        public function create() {

            $this->form_validation->set_rules('name', 'Nombre', 'required');
            $this->form_validation->set_rules('description', 'Descripción', 'required');
            $this->form_validation->set_rules('price', 'Precio', 'required');
            $this->form_validation->set_rules('category_id', 'Categoría', 'required');
            $this->form_validation->set_rules('stock', 'Stock', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Error al crear el producto');
                redirect('items');
            }
            
            $data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'price' => $this->input->post('price'),
                'category_id' => $this->input->post('category_id'),
                'stock' => $this->input->post('stock')
            );
            
            $data = $this->security->xss_clean($data);
            $item = $this->items_model->create($data);
            if($item){
                $this->session->set_flashdata('success', 'Producto creado correctamente');
            }else{
                $this->session->set_flashdata('error', 'Error al crear el producto');
            }
            redirect('items');
        }

        public function update($id) {

            $this->form_validation->set_rules('name', 'Nombre', 'required');
            $this->form_validation->set_rules('description', 'Descripción', 'required');
            $this->form_validation->set_rules('price', 'Precio', 'required');
            $this->form_validation->set_rules('category_id', 'Categoría', 'required');
            $this->form_validation->set_rules('stock', 'Stock', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Error al actualizar el producto');
                redirect('items');
            }
            
            $data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'price' => $this->input->post('price'),
                'category_id' => $this->input->post('category_id'),
                'stock' => $this->input->post('stock')
            );
            
            $data = $this->security->xss_clean($data);
            $item = $this->items_model->update($id, $data);
            if($item){
                $this->session->set_flashdata('success', 'Producto actualizado correctamente');
            }else{
                $this->session->set_flashdata('error', 'Error al actualizar el producto');
            }
            redirect('items');
        }

        public function delete($id) {
            $item = $this->items_model->delete($id);
            if($item){
                $this->session->set_flashdata('success', 'Producto eliminado correctamente');
            }else{
                $this->session->set_flashdata('error', 'Error al eliminar el producto');
            }
            redirect('items');
        }

        public function add() {
            $categories = $this->categories_model->get_all();
            $data = array(
                'categories' => $categories
            );
            $this->load->view('headers_view');
            $this->load->view('panel/menu_view');
            $this->load->view('items/items_add_view', $data);
            $this->load->view('footer_view');
        }   

    }   
?>