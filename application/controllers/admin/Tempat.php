<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Tempat extends CI_Controller {
	// Fungsi database
	public function __construct() {
		parent::__construct();
		$this->load->model('tempat_model');
		
	}

	// Pengguna
	public function index() 
	{
		
		$tempat=$this->tempat_model->listing();

		// Validasi
		$valid = $this->form_validation;
		
		$valid->set_rules('jenis_tempat','Nama Jenis Tempat','required',
			array(	'required'		=> 'Nama Jenis Tempat harus dipilih'));

		$valid->set_rules('tempat','Nama Tempat','required',
			array(	'required'		=> 'Nama Tempat harus diisi'));

		$valid->set_rules('wilayah','Nama Wilayah','required',
			array(	'required'		=> 'Nama Wilayah harus dipilih'));
		
		if($valid->run() === FALSE) 
		{
			$data = array(	
				'title'			=> 'Data Master Tempat',
				'tempat'		=>	$tempat,
				'isi'			=> 'admin/tempat/list');
			$this->load->view('admin/layout/wrapper',$data);
		}else{
			$i 	= $this->input;
			$data = array(	
				'jenis_tempat'		=> $i->post('jenis_tempat'),
				'tempat'			=> $i->post('tempat'),
				'wilayah'			=> $i->post('wilayah')
			);
			$this->tempat_model->tambah($data);
			$this->session->set_flashdata('sukses','Data master tempat telah ditambah');
			redirect(base_url('admin/tempat'));
		}
	}


	public function edit($id_tempat)
	{
		$tempat = $this->tempat_model->detail($id_tempat);

		$valid = $this->form_validation;

		$valid->set_rules('jenis_tempat','Nama Jenis Tempat','required',
			array(	'required'		=> 'Nama Jenis Tempat harus dipilih'));

		$valid->set_rules('tempat','Nama Tempat','required',
			array(	'required'		=> 'Nama Tempat harus diisi'));

		$valid->set_rules('wilayah','Nama Wilayah','required',
			array(	'required'		=> 'Nama Wilayah harus dipilih'));
		if ($valid->run()===FALSE) 
		{
			$data = array(
				'title'		=> 'Ubah Master tempat',
				'tempat'	=> $tempat,
				'isi'		=> 'admin/tempat/edit');
			$this->load->view('admin/layout/wrapper',$data);

		}else{
			$i 	= $this->input;
			$data = array(	'id_tempat'		=> $id_tempat,
							'jenis_tempat'	=> $i->post('jenis_tempat'),
							'tempat'		=> $i->post('tempat'),
							'wilayah'		=> $i->post('wilayah')
							);
			
			$this->tempat_model->edit($data);
			$this->session->set_flashdata('sukses','Nama tempat telah diedit');
			redirect(base_url('admin/tempat'));
		}
	}

	public function delete($id_tempat) {
		$data = array('id_tempat'	=> $id_tempat);
		$this->tempat_model->delete($data);
		$this->session->set_flashdata('sukses','Data telah dihapus');
		redirect(base_url('admin/tempat'));
	}


}

