<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Items_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function create($data) {
        return $this->db->insert('items', $data);
    }

    public function get_all() {
        $this->db->select('items.*, categories.name as category_name');
        $this->db->from('items');
        $this->db->join('categories', 'categories.id = items.category_id', 'left');
        return $this->db->get()->result_array();
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('items', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('items');
    }

    public function get_by_id($id) {
        $this->db->select('items.*, categories.name as category_name');
        $this->db->from('items');
        $this->db->join('categories', 'categories.id = items.category_id', 'left');
        $this->db->where('items.id', $id);
        return $this->db->get()->row_array();
    }

    public function get_by_name($name) {
        $this->db->where('name', $name);
        return $this->db->get('items')->row_array();
    }

    public function get_by_category($category_id) {
        $this->db->select('items.*, categories.name as category_name');
        $this->db->from('items');
        $this->db->join('categories', 'categories.id = items.category_id', 'left');
        $this->db->where('items.category_id', $category_id);
        return $this->db->get()->result_array();
    }
    
}