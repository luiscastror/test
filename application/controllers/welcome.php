<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()	{
		$this->load->view('headers_view');
		$this->load->view('public/public_view');
		$this->load->view('footer_view');
	}
}

