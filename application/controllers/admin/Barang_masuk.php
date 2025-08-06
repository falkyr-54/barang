<?php
class Barang_masuk extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('Barang_msk_model');
	}


	function index(){
		$data = array(	
			'title'			=> 'Data Master Jenis Barang',
			'isi'			=> 'admin/barang_masuk/barang_ajax');
		$this->load->view('admin/layout/wrapper',$data);
	}

	function data_barang(){
		$data=$this->Barang_msk_model->barang_list();
		echo json_encode($data);
	}

	function get_barang(){
		$kobar=$this->input->get('id');
		$data=$this->Barang_msk_model->get_barang_by_kode($kobar);
		echo json_encode($data);
	}

	function simpan_barang(){
		$kobar=$this->input->post('kobar');
		$nabar=$this->input->post('nabar');
		$harga=$this->input->post('harga');
		$data=$this->Barang_msk_model->simpan_barang($kobar,$nabar,$harga);
		echo json_encode($data);
	}

	function update_barang(){
		$kobar=$this->input->post('kobar');
		$nabar=$this->input->post('nabar');
		$harga=$this->input->post('harga');
		$data=$this->Barang_msk_model->update_barang($kobar,$nabar,$harga);
		echo json_encode($data);
	}

	function hapus_barang(){
		$kobar=$this->input->post('kode');
		$data=$this->Barang_msk_model->hapus_barang($kobar);
		echo json_encode($data);
	}

}