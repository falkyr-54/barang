<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Program_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}	
	
	
	// Listing
	public function listing() {
		$this->db->select('*');
		$this->db->from('master_program');
		$this->db->order_by('id_program','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}


	//detail
	 public function detail($id_program) {
     $query=$this->db->get_where('master_program',array('id_program'=>$id_program));
     return $query->row_array();
   }

   //tambah
   public function tambah($data)
   {
   	$this->db->insert('master_program',$data);
   }

   //edit
  public function edit($data)
  {
  	$this->db->where('id_program',$data['id_program']);
  	$this->db->update('master_program',$data);
  }

  //hapus
  public function delete($data)
  {
  	$this->db->where('id_program',$data['id_program']);
  	$this->db->delete('master_program',$data);
  }
}