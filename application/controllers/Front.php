<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends CI_Controller {
	
	// Halaman login
	public function index() {
		
		$data = array(	'title'		=> 'Abang');
		$this->load->view('front',$data);
	}
	
}