<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}	
	
	// Listing
	public function listing() {
		$this->db->select('*');
		$this->db->from('ms_jenis_barang');
		$this->db->order_by('id_jenis','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}


	//detail
	 public function detail($id_jenis) {
     $query=$this->db->get_where('ms_jenis_barang',array('id_jenis'=>$id_jenis));
     return $query->row_array();
   }

   //tambah
   public function tambah($data)
   {
   	$this->db->insert('ms_jenis_barang',$data);
   }

   //edit
  public function edit($data)
  {
  	$this->db->where('id_jenis',$data['id_jenis']);
  	$this->db->update('ms_jenis_barang',$data);
  }

  //hapus
  public function delete($data)
  {
  	$this->db->where('id_jenis',$data['id_jenis']);
  	$this->db->delete('ms_jenis_barang',$data);
  }
}