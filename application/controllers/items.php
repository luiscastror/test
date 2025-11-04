<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Items extends CI_Controller {
        
        public function __construct() {
            parent::__construct();
            $this->load->model('items_model');
            $this->load->model('categories_model');
        }

        public function index() {
            $items = $this->items_model->get_all();
            $data = array(
                'items' => $items
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