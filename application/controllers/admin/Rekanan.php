<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Rekanan extends CI_Controller {
	// Fungsi database
	public function __construct() {
		parent::__construct();
		$this->load->model('Rekanan_model');
		$this->load->model('Brg_keluar_model');
		
	}

	// Pengguna
	public function index() 
	{
		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();

		$rekanan=$this->Rekanan_model->listing();

		// Validasi
		$valid = $this->form_validation;
		
		$valid->set_rules('nama_rekanan','Rekanan','required',
			array(	'required'		=> 'Rekanan harus diisi'));

		$valid->set_rules('alamat','Alamatnya','required',
			array(	'required'		=> 'Alamatnya harus diisi'));

		
		
		if($valid->run() === FALSE) 
		{
			$data = array(	
				'title'			=> 'Data Master Rekanan',
				'rekanan'			=>	$rekanan,
				'expired6bulan'		=> $expired6bln,
				'expired3bulan'		=> $expired3bln,
				'expired1bulan'		=> $expired1bln,
				'isi'			=> 'admin/rekanan/list');
			$this->load->view('admin/layout/wrapper',$data);
		}else{
			$i 	= $this->input;
			$data = array(	
				'nama_rekanan'	=> $i->post('nama_rekanan'),
				'alamat'		=> $i->post('alamat'),
				'telepon'		=> $i->post('telepon')
			);
			$this->Rekanan_model->tambah($data);
			$this->session->set_flashdata('sukses','Data master jenis barang telah ditambah');
			redirect(base_url('admin/rekanan'));
		}
	}


	public function edit($id_rekanan)
	{
		$rekanan = $this->Rekanan_model->detail($id_rekanan);

		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();
		

		$valid = $this->form_validation;

		$valid->set_rules('nama_rekanan','Rekanan','required',
			array(	'required'		=> 'Rekanan harus diisi'));

		$valid->set_rules('alamat','Alamatnya','required',
			array(	'required'		=> 'Alamatnya harus diisi'));

		
		if ($valid->run()===FALSE) 
		{
			$data = array(
				'title'		=> 'Ubah Master Jenis Barang',
				'rekanan'	=> $rekanan,
				'expired6bulan'	=> $expired6bln,
				'expired3bulan'	=> $expired3bln,
				'expired1bulan'	=> $expired1bln,
				'isi'		=> 'admin/rekanan/edit');
			$this->load->view('admin/layout/wrapper',$data);

		}else{
			$i 	= $this->input;
			$data = array(	'id_rekanan'		=> $id_rekanan,
							'nama_rekanan'	=> $i->post('nama_rekanan'),
							'alamat'	=> $i->post('alamat'),
							'telepon'	=> $i->post('telepon')
							);
			
			$this->Rekanan_model->edit($data);
			$this->session->set_flashdata('sukses','Nama rekanan berhasil diubah');
			redirect(base_url('admin/rekanan'));
		}
	}

	public function delete($id_rekanan) {
		$data = array('id_rekanan'	=> $id_rekanan);
		$this->Rekanan_model->delete($data);
		$this->session->set_flashdata('sukses','Data telah dihapus');
		redirect(base_url('admin/rekanan'));
	}


}

