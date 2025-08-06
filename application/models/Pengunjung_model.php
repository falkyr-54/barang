<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengunjung_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}	
	
	
	// Listing
	public function listing() {
		$this->db->select('*');
		$this->db->from('master_pengunjung');
		$this->db->order_by('id_pengunjung','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}


	//detail
	 public function detail($id_pengunjung) {
     $query=$this->db->get_where('master_pengunjung',array('id_pengunjung'=>$id_pengunjung));
     return $query->row_array();
   }

   //tambah
   public function tambah($data)
   {
   	$this->db->insert('master_pengunjung',$data);
   }

   //edit
  public function edit($data)
  {
  	$this->db->where('id_pengunjung',$data['id_pengunjung']);
  	$this->db->update('master_pengunjung',$data);
  }

  //hapus
  public function delete($data)
  {
  	$this->db->where('id_pengunjung',$data['id_pengunjung']);
  	$this->db->delete('master_pengunjung',$data);
  }
}