<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Unit extends CI_Controller
{
	// Fungsi database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('unit_model');
		$this->load->model('Brg_keluar_model');
	}

	// Pengguna
	public function index()
	{

		$unit = $this->unit_model->listing();
		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();

		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules(
			'unit',
			'unit',
			'required',
			array('required'		=> 'unit harus diisi')
		);

		if ($valid->run() === FALSE) {
			$data = array(
				'title'			=> 'Data Master unit',
				'unit'			=>	$unit,
				'expired6bulan'	=> $expired6bln,
				'expired3bulan'	=> $expired3bln,
				'expired1bulan'	=> $expired1bln,
				'isi'			=> 'admin/unit/list'
			);
			$this->load->view('admin/layout/wrapper', $data);
		} else {
			$i 	= $this->input;
			$data = array(
				'unit'				=> $i->post('unit')
			);
			$this->unit_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data unit telah ditambah');
			redirect(base_url('admin/unit'));
		}
	}


	public function edit($id_unit)
	{
		$unit = $this->unit_model->detail($id_unit);

		$valid = $this->form_validation;
		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();

		$valid->set_rules(
			'unit',
			'unit Barang',
			'required',
			array('required'		=> 'unit Barang harus diisi')
		);


		if ($valid->run() === FALSE) {
			$data = array(
				'title'		=> 'Ubah Master Unit',
				'unit'		=> $unit,
				'expired6bulan'	=> $expired6bln,
				'expired3bulan'	=> $expired3bln,
				'expired1bulan'	=> $expired1bln,
				'isi'		=> 'admin/unit/edit'
			);
			$this->load->view('admin/layout/wrapper', $data);
		} else {
			$i 	= $this->input;
			$data = array(
				'id_unit'		=> $id_unit,
				'unit'			=> $i->post('unit')
			);

			$this->unit_model->edit($data);
			$this->session->set_flashdata('sukses', 'Nama unit berhasil diubah');
			redirect(base_url('admin/unit'));
		}
	}

	public function delete($id_unit)
	{
		$data = array('id_unit'	=> $id_unit);
		$this->unit_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/unit'));
	}
}
