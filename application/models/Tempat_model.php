<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tempat_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}	
	
	// Listing
	public function listing() {
		$this->db->select('*');
		$this->db->from('master_tempat');
		$this->db->order_by('id_tempat','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}


	//detail
	 public function detail($id_tempat) {
     $query=$this->db->get_where('master_tempat',array('id_tempat'=>$id_tempat));
     return $query->row_array();
   }

   //tambah
   public function tambah($data)
   {
   	$this->db->insert('master_tempat',$data);
   }

   //edit
  public function edit($data)
  {
  	$this->db->where('id_tempat',$data['id_tempat']);
  	$this->db->update('master_tempat',$data);
  }

  //hapus
  public function delete($data)
  {
  	$this->db->where('id_tempat',$data['id_tempat']);
  	$this->db->delete('master_tempat',$data);
  }
}