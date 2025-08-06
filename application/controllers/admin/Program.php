<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Program extends CI_Controller {
	// Fungsi database
	public function __construct() {
		parent::__construct();
		$this->load->model('program_model');
		
	}

	// Pengguna
	public function index() 
	{
		
		$program=$this->program_model->listing();

		// Validasi
		$valid = $this->form_validation;
		
		$valid->set_rules('nama','Nama Program','required',
			array(	'required'		=> 'Nama Program harus diisi'));
		
		if($valid->run() === FALSE) 
		{
			$data = array(	
				'title'			=> 'Data Master Program',
				'program'		=>	$program,
				'isi'			=> 'admin/program/list');
			$this->load->view('admin/layout/wrapper',$data);
		}else{
			$i 	= $this->input;
			$data = array(	
				'nama'			=> $i->post('nama')
			);
			$this->program_model->tambah($data);
			$this->session->set_flashdata('sukses','Data master program telah ditambah');
			redirect(base_url('admin/program'));
		}
	}


	public function edit($id_program)
	{
		$program = $this->program_model->detail($id_program);

		$valid = $this->form_validation;

		$valid->set_rules('nama','Nama Program','required',
			array('required' => 'Nama Program Tidak Boleh Kosong'));
		if ($valid->run()===FALSE) 
		{
			$data = array(
				'title'		=> 'Ubah Master Program',
				'program'	=> $program,
				'isi'		=> 'admin/program/edit');
			$this->load->view('admin/layout/wrapper',$data);

		}else{
			$i 	= $this->input;
			$data = array(	'id_program'		=> $id_program,
							'nama'	=> $i->post('nama')
							);
			
			$this->program_model->edit($data);
			$this->session->set_flashdata('sukses','Nama telah diedit');
			redirect(base_url('admin/program'));
		}
	}

	public function delete($id_program) {
		$data = array('id_program'	=> $id_program);
		$this->program_model->delete($data);
		$this->session->set_flashdata('sukses','Data telah dihapus');
		redirect(base_url('admin/program'));
	}


}

