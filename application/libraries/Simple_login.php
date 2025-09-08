<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simple_login {
	
	// SET SUPER GLOBAL
	var $CI = NULL;
	public function __construct() {
		$this->CI =& get_instance();
	}
	
	// Login
	public function login($username, $password) {
		// Query untuk pencocokan data
		$query = $this->CI->db->get_where('user', array(
			'username' => $username, 
			'password' => sha1($password)
		));

		// Jika ada hasilnya
		if($query->num_rows() == 1) {
			$row 	= $this->CI->db->query('SELECT * FROM user WHERE username = "'.$username.'"');
			$admin 		= $row->row();
			$id 		= $admin->id_user;
			$nama		= $admin->nama_user;
			$level		= $admin->akses_level;
			$id_satker	= $admin->id_satker;
			$id_unit	= $admin->id_unit;
			$id_klaster	= $admin->id_klaster;
			$id_pegawai	= $admin->id_pegawai;
			$this->CI->session->set_userdata('username', $username); 
			$this->CI->session->set_userdata('nama_user', $nama_user);
			$this->CI->session->set_userdata('level', $level);  
			$this->CI->session->set_userdata('id_satker', $id_satker);  
			$this->CI->session->set_userdata('id_unit', $id_unit);  
			$this->CI->session->set_userdata('id_klaster', $id_klaster);  
			$this->CI->session->set_userdata('id_pegawai', $id_pegawai);  
			$this->CI->session->set_userdata('id_login', uniqid(rand()));
			$this->CI->session->set_userdata('id', $id);
			// Kalau benar di redirect

			
			redirect(base_url('admin/dasbor/'));
		}else{
			$this->CI->session->set_flashdata('sukses','Oopss.. Username/password salah');
			redirect(base_url().'login');
		}
		return false;
	}
	
	// Cek login
	public function cek_login() {
		if($this->CI->session->userdata('username') == '') {
			$this->CI->session->set_flashdata('sukses','Oops...silakan login dulu');
			redirect(base_url('login'));
		}	
	}
	
	// Logout
	public function logout() {
		$this->CI->session->unset_userdata('username');
		$this->CI->session->unset_userdata('nama_user');
		$this->CI->session->unset_userdata('level');
		$this->CI->session->unset_userdata('id_login');
		$this->CI->session->unset_userdata('id');
		$this->CI->session->set_flashdata('sukses','Terimakasih, Anda berhasil logout');
		redirect(base_url().'front');
	}
	
}