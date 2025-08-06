<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Pengunjung extends CI_Controller {
	// Fungsi database
	public function __construct() {
		parent::__construct();
		$this->load->model('pengunjung_model');
		
	}

	// Pengguna
	public function index() 
	{
		
		$pengunjung=$this->pengunjung_model->listing();

		// Validasi
		$valid = $this->form_validation;
		
		$valid->set_rules('jenis','Jenis pengunjung','required',
			array(	'required'		=> 'Nama pengunjung harus diisi'));
		
		if($valid->run() === FALSE) 
		{
			$data = array(	
				'title'			=> 'Data Master pengunjung',
				'pengunjung'	=>	$pengunjung,
				'isi'			=> 'admin/pengunjung/list');
			$this->load->view('admin/layout/wrapper',$data);
		}else{
			$i 	= $this->input;
			$data = array(	
				'jenis'			=> $i->post('jenis'),
				'singkatan'		=> $i->post('singkatan')
			);
			$this->pengunjung_model->tambah($data);
			$this->session->set_flashdata('sukses','Data master pengunjung telah ditambah');
			redirect(base_url('admin/pengunjung'));
		}
	}


	public function edit($id_pengunjung)
	{
		$pengunjung = $this->pengunjung_model->detail($id_pengunjung);

		$valid = $this->form_validation;

		$valid->set_rules('jenis','Jenis pengunjung','required',
			array('required' => 'Jenis pengunjung Tidak Boleh Kosong'));
		if ($valid->run()===FALSE) 
		{
			$data = array(
				'title'		=> 'Ubah Master pengunjung',
				'pengunjung'	=> $pengunjung,
				'isi'		=> 'admin/pengunjung/edit');
			$this->load->view('admin/layout/wrapper',$data);

		}else{
			$i 	= $this->input;
			$data = array(	'id_pengunjung'		=> $id_pengunjung,
							'jenis'	=> $i->post('jenis')
							);
			
			$this->pengunjung_model->edit($data);
			$this->session->set_flashdata('sukses','Jenis pengunjung telah diedit');
			redirect(base_url('admin/pengunjung'));
		}
	}

	public function delete($id_pengunjung) {
		$data = array('id_pengunjung'	=> $id_pengunjung);
		$this->pengunjung_model->delete($data);
		$this->session->set_flashdata('sukses','Data telah dihapus');
		redirect(base_url('admin/pengunjung'));
	}


}

