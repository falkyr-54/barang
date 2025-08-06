<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Satuan_model extends CI_Model {

  public function __construct() {
    $this->load->database();
  } 
  
  // Listing
  public function listing() {
    $this->db->select('*');
    $this->db->from('ms_satuan');
    $this->db->order_by('id_satuan','ASC');
    $query = $this->db->get();
    return $query->result_array();
  }


  //detail
   public function detail($id_satuan) {
     $query=$this->db->get_where('ms_satuan',array('id_satuan'=>$id_satuan));
     return $query->row_array();
   }

   //tambah
   public function tambah($data)
   {
    $this->db->insert('ms_satuan',$data);
   }

   //edit
  public function edit($data)
  {
    $this->db->where('id_satuan',$data['id_satuan']);
    $this->db->update('ms_satuan',$data);
  }

  //hapus
  public function delete($data)
  {
    $this->db->where('id_satuan',$data['id_satuan']);
    $this->db->delete('ms_satuan',$data);
  }
}