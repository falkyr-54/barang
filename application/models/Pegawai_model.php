<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_model extends CI_Model {

  public function __construct() {
    $this->load->database();
  } 
  
  // Listing
  public function listing() {
    $this->db->select('*');
    $this->db->from('pegawai');
    $this->db->where('pegawai_status', 'Aktif');
    $this->db->order_by('id_pegawai','ASC');
    $query = $this->db->get();
    return $query->result_array();
  }


  //detail
  public function detail($id_pegawai) {
   $query=$this->db->get_where('pegawai',array('id_pegawai'=>$id_pegawai));
   return $query->row_array();
 }


   //tambah
 public function tambah($data)
 {
  $this->db->insert('pegawai',$data);
}

   //edit
public function edit($data)
{
  $this->db->where('id_pegawai',$data['id_pegawai']);
  $this->db->update('pegawai',$data);
}

  //hapus
public function delete($data)
{
  $this->db->where('id_pegawai',$data['id_pegawai']);
  $this->db->delete('pegawai',$data);
}
}