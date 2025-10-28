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
    
}
