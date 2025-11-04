<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function create($data) {
        return $this->db->insert('categories', $data);
    }

    public function get_all() {
        return $this->db->get('categories')->result_array();
    }

    // Obtener categorías con paginación
    public function get_categories_paginated($limit, $offset) {
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get('categories')->result_array();
    }

    // Buscar categorías con paginación
    public function search_categories($search, $limit, $offset) {
        $this->db->like('name', $search);
        $this->db->or_like('description', $search);
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get('categories')->result_array();
    }

    // Contar total de categorías
    public function count_all_categories() {
        return $this->db->count_all('categories');
    }

    // Contar resultados de búsqueda
    public function count_search_results($search) {
        $this->db->like('name', $search);
        $this->db->or_like('description', $search);
        return $this->db->count_all_results('categories');
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('categories', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('categories');
    }

    public function get_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get('categories')->row_array();
    }

    public function get_by_name($name) {
        $this->db->where('name', $name);
        return $this->db->get('categories')->row_array();
    }

    public function has_products($category_id) {
        $this->db->where('category_id', $category_id);
        $count = $this->db->count_all_results('items');
        return $count > 0;
    }

    public function get_products_count($category_id) {
        $this->db->where('category_id', $category_id);
        return $this->db->count_all_results('items');
    }
    
}
