<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Klaster_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}	
	
	
	// Listing
	public function listing() {
		$this->db->select('*');
		$this->db->from('klaster');
		$this->db->order_by('id_klaster','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}



	public function tambah($data)
	{
		$this->db->insert('user',$data);
	}

	public function update($data)
	{
		$this->db->where('id_user',$data['id_user']);
		$this->db->update('user',$data);
	}


	//detail
	public function detail($id_user) {
		$this->db->select('user.*, pegawai.nama_lengkap');
		$this->db->from('user');
		$this->db->join('pegawai', 'pegawai.id_pegawai = user.id_pegawai', 'left');
		$this->db->where('user.id_user', $id_user);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function delete($data)
	{
		$this->db->where('id_user', $data['id_user']);
		$this->db->delete('user',$data);
	}
}