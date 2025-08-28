<?php
defined('BASEPATH') or exit('No direct script access allowed');


class User extends CI_Controller
{
	// Fungsi database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('satker_model');
		$this->load->model('Brg_keluar_model');
		$this->load->model('klaster_model');
	}

	// Pengguna
	public function index()
	{

		$user = $this->user_model->listing();

		$data = array(
			'title'			=> 'Data User',
			'user'			=>	$user,
			'isi'			=> 'admin/user/list'
		);
		$this->load->view('admin/layout/wrapper', $data);
	}

	public function tambah()
	{
		$satker	 = $this->satker_model->listing();
		$klaster = $this->klaster_model->listing();
		$klaster = $this->klaster_model->listing();

		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules('username', 'Username', 'required', array('required' => 'Username Harus diisi'));

		$valid->set_rules('akses_level', 'Akses Level', 'required', array('required' => 'Akses Level Harus diisi'));

		if ($valid->run() === FALSE) {

			$data = array(
				'title'		=> 'Tambahkan Data User',
				'satker'	=> $satker,
				'klaster'	=> $klaster,
				'isi'		=> 'admin/user/tambah'
			);
			$this->load->view('admin/layout/wrapper', $data);
		} else {

			// Masuk ke database
			$i 	= $this->input;
			$data = array(
				'id_satker'			=> $i->post('id_satker'),
				'id_unit'		   	=> $i->post('id_unit'),
				'id_klaster'		=> $i->post('id_klaster'),
				'username'			=> $i->post('username'),
				'nama_user'			=> $i->post('nama_user'),
				'akses_level'		=> $i->post('akses_level'),
				'id_pegawai'		=> $i->post('id_pegawai'),
				'password'			=> sha1($i->post('password')),
				'password_hint'		=> $i->post('password')
			);
			$this->user_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data telah ditambah');
			redirect(base_url('admin/user'));
		}
	}


	//FUNGSI EDIT
	public function edit($id_user)
	{

		$user          = $this->user_model->detail($id_user);
		$satker        = $this->satker_model->listing();
		$klaster        = $this->klaster_model->listing();

		$data = array(
			'title'		=> 'Edit User',
			'user'	      => $user,
			'satker'      => $satker,
			'klaster'      => $klaster,
			'isi'		  => 'admin/user/edit'
		);
		$this->load->view('admin/layout/wrapper', $data);

		$valid = $this->form_validation;

		$valid->set_rules(
			'nama_user',
			'Nama User',
			'required',
			array('required'		=> 'Nama User harus diisi')
		);

		$valid->set_rules(
			'password',
			'Password',
			'required',
			array('required'		=> 'Password harus diisi')
		);

		if ($valid->run()) {

			$i 	= $this->input;
			$data = array(
				'id_user'	      		 => $id_user,
				'id_satker'		   		 => $i->post('id_satker'),
				'id_unit'		   		 => $i->post('id_unit'),
				'id_klaster'		   	 => $i->post('id_klaster'),
				'id_pegawai'		   	 => $i->post('id_pegawai'),
				'nama_user'			 	 => $i->post('nama_user'),
				'akses_level'			 => $i->post('akses_level'),
				'username'				 => $i->post('username'),
				'password'				 => sha1($i->post('password')),
				'password_hint'			 => $i->post('password'),
				'edit_by'         		 => $this->session->userdata('username')
			);

			$this->user_model->update($data);
			$this->session->set_flashdata('sukses', 'Data berhasil diubah');
			redirect(base_url('admin/user'));
		}
	}

	


	public function get_unit_by_klaster()
	{
		$id_klaster = $this->input->post('id_klaster');
		
    // sesuaikan dengan nama kolom di unit_bagian
		$units = $this->db->get_where('unit_bagian', ['id_klaster' => $id_klaster])->result();

		$output = '<option value="">-- Pilih Unit --</option>';
		foreach ($units as $u) {
			$output .= '<option value="'.$u->id_unit.'">'.$u->unit.'</option>';
		}
		echo $output;
	}
	public function delete($id_user)
	{

		$data = array('id_user'	=> $id_user);
		$this->user_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data berhasil dihapus');
		redirect(base_url('admin/user/'));
	}

}
