<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getOne($email) {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        return $query->row();
    }

    public function authenticate($data) {

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        $this->db->where('email', $data['email'])
            ->where('password', $data['password']);

        $query = $this->db->get('users');
        return $query->row();
    }

}
