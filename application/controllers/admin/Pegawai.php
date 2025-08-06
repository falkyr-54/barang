<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pegawai extends CI_Controller
{
	// Fungsi database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pegawai_model');
		$this->load->model('Brg_keluar_model');
	}

	// Pengguna
	public function index()
	{

		$pegawai = $this->Pegawai_model->listing();
		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();
		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules(
			'nama_lengkap',
			'Pegawai',
			'required',
			array('required'		=> 'Pegawai harus diisi')
		);

		if ($valid->run() === FALSE) {
			$data = array(
				'title'			=> 'Data Master Pegawai',
				'expired6bulan'	=> $expired6bln,
				'expired3bulan'	=> $expired3bln,
				'expired1bulan'	=> $expired1bln,
				'pegawai'		=>	$pegawai,
				'isi'			=> 'admin/pegawai/list'
			);
			$this->load->view('admin/layout/wrapper', $data);
		} else {
			$i 	= $this->input;
			$data = array(
				'nama_lengkap'	 => $i->post('nama_lengkap'),
				'nip'			 => $i->post('nip'),
				'pegawai_status' => $i->post('status')
			);
			$this->Pegawai_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data telah ditambah');
			redirect(base_url('admin/pegawai'));
		}
	}


	public function edit($id_pegawai)
	{
		$pegawai = $this->Pegawai_model->detail($id_pegawai);

		$valid = $this->form_validation;

		$valid->set_rules(
			'nama_lengkap',
			'Pegawai',
			'required',
			array('required'		=> 'Pegawai harus diisi')
		);

		$valid->set_rules(
			'alamat',
			'Alamatnya',
			'required',
			array('required'		=> 'Alamatnya harus diisi')
		);


		if ($valid->run() === FALSE) {
			$data = array(
				'title'		=> 'Ubah Master Jenis Barang',
				'Pegawai'	=> $pegawai,
				'isi'		=> 'admin/pegawai/edit'
			);
			$this->load->view('admin/layout/wrapper', $data);
		} else {
			$i 	= $this->input;
			$data = array(
				'id_pegawai'		=> $id_pegawai,
				'nama_lengkap'	=> $i->post('nama_lengkap'),
				'alamat'	=> $i->post('alamat'),
				'telepon'	=> $i->post('telepon')
			);

			$this->Pegawai_model->edit($data);
			$this->session->set_flashdata('sukses', 'Nama Pegawai berhasil diubah');
			redirect(base_url('admin/Pegawai'));
		}
	}

	public function delete($id_pegawai)
	{
		$data = array('id_pegawai'	=> $id_pegawai);
		$this->Pegawai_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/Pegawai'));
	}
}
