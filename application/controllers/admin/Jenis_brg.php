<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Jenis_brg extends CI_Controller
{
	// Fungsi database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Jenis_model');
		$this->load->model('Brg_keluar_model');
	}

	// Pengguna
	public function index()
	{
		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();
		$jenis = $this->Jenis_model->listing();

		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules(
			'kode_jns_brg',
			'Kode Jenis Barang',
			'required',
			array('required'		=> 'Kode Jenis Barang harus diisi')
		);

		$valid->set_rules(
			'nama_jenis',
			'Nama Jenis Barang',
			'required',
			array('required'		=> 'Nama Jenis Barang harus diisi')
		);



		if ($valid->run() === FALSE) {
			$data = array(
				'title'			=> 'Data Master Jenis Barang',
				'jenis'			=>	$jenis,
				'expired6bulan'	=> $expired6bln,
				'expired3bulan'	=> $expired3bln,
				'expired1bulan'	=> $expired1bln,
				'isi'			=> 'admin/jenis_brg/list'
			);
			$this->load->view('admin/layout/wrapper', $data);
		} else {
			$i 	= $this->input;
			$data = array(
				'nama_jenis'		=> $i->post('nama_jenis'),
				'kode_jns_brg'	=> $i->post('kode_jns_brg')
			);
			$this->Jenis_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data master jenis barang telah ditambah');
			redirect(base_url('admin/jenis_brg'));
		}
	}


	public function edit($id_jenis)
	{

		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();

		$jenis = $this->Jenis_model->detail($id_jenis);

		$valid = $this->form_validation;

		$valid->set_rules(
			'kode_jns_brg',
			'Kode Jenis Barang',
			'required',
			array('required'		=> 'Kode Jenis Barang harus diisi')
		);

		$valid->set_rules(
			'nama_jenis',
			'Nama Jenis',
			'required',
			array('required'		=> 'Nama Jenis Barang harus diisi')
		);


		if ($valid->run() === FALSE) {
			$data = array(
				'title'		=> 'Ubah Master Jenis Barang',
				'expired6bulan'	=> $expired6bln,
				'expired3bulan'	=> $expired3bln,
				'expired1bulan'	=> $expired1bln,
				'jenis'	=> $jenis,
				'isi'		=> 'admin/jenis_brg/edit'
			);
			$this->load->view('admin/layout/wrapper', $data);
		} else {
			$i 	= $this->input;
			$data = array(
				'id_jenis'		=> $id_jenis,
				'kode_jns_brg'	=> $i->post('kode_jns_brg'),
				'nama_jenis'	=> $i->post('nama_jenis')
			);

			$this->Jenis_model->edit($data);
			$this->session->set_flashdata('sukses', 'Nama jenis barang berhasil diubah');
			redirect(base_url('admin/jenis_brg'));
		}
	}

	public function delete($id_jenis)
	{
		$data = array('id_jenis'	=> $id_jenis);
		$this->Jenis_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/jenis_brg'));
	}
}
