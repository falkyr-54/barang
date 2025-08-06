<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Satuan extends CI_Controller
{
	// Fungsi database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Satuan_model');
		$this->load->model('Brg_keluar_model');
	}

	// Pengguna
	public function index()
	{

		$satuan = $this->Satuan_model->listing();
		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();

		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules(
			'satuan',
			'Satuan Barang',
			'required',
			array('required'		=> 'Satuan Barang harus diisi')
		);

		$valid->set_rules(
			'keterangan',
			'Keterangan Satuan',
			'required',
			array('required'		=> 'Keterangan Satuan harus diisi')
		);



		if ($valid->run() === FALSE) {
			$data = array(
				'title'			=> 'Data Master Satuan Barang',
				'satuan'			=>	$satuan,
				'expired6bulan'		=> $expired6bln,
				'expired3bulan'		=> $expired3bln,
				'expired1bulan'		=> $expired1bln,
				'isi'			=> 'admin/satuan/list'
			);
			$this->load->view('admin/layout/wrapper', $data);
		} else {
			$i 	= $this->input;
			$data = array(
				'keterangan'		=> $i->post('keterangan'),
				'satuan'	=> $i->post('satuan')
			);
			$this->Satuan_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data satuan barang telah ditambah');
			redirect(base_url('admin/satuan'));
		}
	}


	public function edit($id_satuan)
	{
		$satuan = $this->Satuan_model->detail($id_satuan);

		$valid = $this->form_validation;

		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();

		$valid->set_rules(
			'satuan',
			'Satuan Barang',
			'required',
			array('required'		=> 'Satuan Barang harus diisi')
		);

		$valid->set_rules(
			'keterangan',
			'keterangan',
			'required',
			array('required'		=> 'keterangan harus diisi')
		);


		if ($valid->run() === FALSE) {
			$data = array(
				'title'		=> 'Ubah Master Jenis Barang',
				'satuan'	=> $satuan,
				'expired6bulan'	=> $expired6bln,
				'expired3bulan'	=> $expired3bln,
				'expired1bulan'	=> $expired1bln,
				'isi'		=> 'admin/satuan/edit'
			);
			$this->load->view('admin/layout/wrapper', $data);
		} else {
			$i 	= $this->input;
			$data = array(
				'id_satuan'		=> $id_satuan,
				'satuan'	=> $i->post('satuan'),
				'keterangan'	=> $i->post('keterangan')
			);

			$this->Satuan_model->edit($data);
			$this->session->set_flashdata('sukses', 'Nama satuan barang berhasil diubah');
			redirect(base_url('admin/satuan'));
		}
	}

	public function delete($id_satuan)
	{
		$data = array('id_satuan'	=> $id_satuan);
		$this->Satuan_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/satuan'));
	}
}
