<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekanan_model extends CI_Model {

  public function __construct() {
    $this->load->database();
  } 
  
  // Listing
  public function listing() {
    $this->db->select('*');
    $this->db->from('ms_rekanan');
    $this->db->order_by('id_rekanan','ASC');
    $query = $this->db->get();
    return $query->result_array();
  }


  //detail
   public function detail($id_rekanan) {
     $query=$this->db->get_where('ms_rekanan',array('id_rekanan'=>$id_rekanan));
     return $query->row_array();
   }


   //tambah
   public function tambah($data)
   {
    $this->db->insert('ms_rekanan',$data);
   }

   //edit
  public function edit($data)
  {
    $this->db->where('id_rekanan',$data['id_rekanan']);
    $this->db->update('ms_rekanan',$data);
  }

  //hapus
  public function delete($data)
  {
    $this->db->where('id_rekanan',$data['id_rekanan']);
    $this->db->delete('ms_rekanan',$data);
  }
}