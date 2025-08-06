<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Satker extends CI_Controller
{
	// Fungsi database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('satker_model');
		$this->load->model('Brg_keluar_model');
	}

	// Pengguna
	public function index()
	{

		$satker = $this->satker_model->listing();
		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();
		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules(
			'nama_satker',
			'satker',
			'required',
			array('required'		=> 'satker harus diisi')
		);

		$valid->set_rules(
			'alamat',
			'Alamatnya',
			'required',
			array('required'		=> 'Alamatnya harus diisi')
		);

		if ($valid->run() === FALSE) {
			$data = array(
				'title'			=> 'Data Master satker',
				'satker'	    =>	$satker,
				'expired6bulan'	=> $expired6bln,
				'expired3bulan'	=> $expired3bln,
				'expired1bulan'	=> $expired1bln,
				'isi'			=> 'admin/satker/list'
			);
			$this->load->view('admin/layout/wrapper', $data);
		}
	}


	public function tambah()
	{
		$satker = $this->satker_model->listing();
		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();
		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules(
			'nama_satker',
			'satker',
			'required',
			array('required'		=> 'satker harus diisi')
		);

		$valid->set_rules(
			'alamat',
			'Alamatnya',
			'required',
			array('required'		=> 'Alamatnya harus diisi')
		);

		if ($valid->run() === FALSE) {
			$data = array(
				'title'			=> 'Tambah data',
				'satker'	    =>	$satker,
				'expired6bulan'	=> $expired6bln,
				'expired3bulan'	=> $expired3bln,
				'expired1bulan'	=> $expired1bln,
				'isi'			=> 'admin/satker/tambah'
			);
			$this->load->view('admin/layout/wrapper', $data);
		} else {
			$i = $this->input;
			$data = array(
				'nama_satker' => $i->post('nama_satker'),
				'alamat'	  => $i->post('alamat'),
				'telepon'	  => $i->post('telepon'),
				'email'	  	  => $i->post('email')
			);
			$this->satker_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data disimpan');
			redirect(base_url('admin/satker/'));
		}
	}


	public function edit($id_satker)
	{
		$satker = $this->satker_model->detail($id_satker);

		$valid = $this->form_validation;

		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();


		$valid->set_rules(
			'nama_satker',
			'satker',
			'required',
			array('required'		=> 'satker harus diisi')
		);

		$valid->set_rules(
			'alamat',
			'Alamatnya',
			'required',
			array('required'		=> 'Alamatnya harus diisi')
		);


		if ($valid->run() === FALSE) {
			$data = array(
				'title'		=> 'Ubah Data',
				'satker'	=> $satker,
				'expired6bulan'	=> $expired6bln,
				'expired3bulan'	=> $expired3bln,
				'expired1bulan'	=> $expired1bln,
				'isi'		=> 'admin/satker/edit'
			);
			$this->load->view('admin/layout/wrapper', $data);
		} else {
			$i 	= $this->input;
			$data = array(
				'id_satker'		=> $id_satker,
				'nama_satker'	=> $i->post('nama_satker'),
				'alamat'		=> $i->post('alamat'),
				'telepon'		=> $i->post('telepon')
			);

			$this->satker_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data berhasil diubah');
			redirect(base_url('admin/satker'));
		}
	}

	public function delete($id_satker)
	{
		$data = array('id_satker'	=> $id_satker);
		$this->satker_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/satker'));
	}
}
