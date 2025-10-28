<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Panel extends CI_Controller {
        
        public function __construct() {
            parent::__construct();
        }

        public function index() {
            $this->load->view('headers_view');
            $this->load->view('panel/menu_view');
            $this->load->view('panel/panel_view');
            $this->load->view('footer_view');
        }

    }
    
?>