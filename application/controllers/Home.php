<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	// Load database
	public function __construct(){
		parent::__construct();
		$this->load->model('konfigurasi_model');
		$this->load->model('pegawai_model');
	}
	
	// Index
	public function index() {
		$site = $this->konfigurasi_model->listing();
		$data = array(	'title'		=> $site['namaweb'].' - '.$site['tagline'],
						'isi'		=> 'admin/dasbor/list');
		$this->load->view('admin/layout/wrapper',$data);
	}
	
	// Upgrade password agar terenkripsi
	public function enkripsi() {
		$pegawai = $this->pegawai_model->listing();
		foreach($pegawai as $pegawai) {
			$data = array(	'id_pegawai'	=> $pegawai['id_pegawai'],
							'password'		=> sha1($pegawai['nip']),
							'password_hint'	=> $pegawai['nip']
							);
			$this->pegawai_model->edit($data);
		}
		echo "Semua Password telah dienkripsi";
	}
}