<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}	
	
	
	// Listing
	public function listing() {
		$this->db->select('*');
		$this->db->from('user');
		$this->db->order_by('id_user','ASC');
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
     $this->db->select('user.*, pegawai_barang.nama_lengkap,unit_bagian.unit,pegawai_barang.id_unit');
     $this->db->from('user');
     $this->db->join('pegawai_barang', 'pegawai_barang.id_pegawai = user.id_pegawai', 'left');
     $this->db->join('unit_bagian', 'unit_bagian.id_unit = pegawai_barang.id_unit', 'left');
     $this->db->join('klaster', 'klaster.id_klaster = user.id_klaster', 'left');
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