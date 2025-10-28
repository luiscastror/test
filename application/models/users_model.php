<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function create($data) {

        $user = $this->get_by_email($data['email']);

        if ($user) {
            return false;
        }

        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        return $this->db->insert('users', $data);
    }

    public function get_all() {
        return $this->db->get('users')->result_array();
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }

    public function get_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get('users')->row_array();
    }

    public function get_by_email($email) {
        $this->db->where('email', $email);
        return $this->db->get('users')->row_array();
    }
    

}
