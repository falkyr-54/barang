<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notulen_model extends CI_Model {

	public function __construct() {
		$this->load->database();
    $this->load->model('program_model');
    $this->load->model('tempat_model');
  }	

	// Listing
  public function listing() {
    $this->db->select('notulen.*,master_tempat.jenis_tempat,master_tempat.tempat,master_tempat.wilayah,master_program.nama');
    $this->db->from('notulen');
    $this->db->join('master_tempat', 'master_tempat.id_tempat = notulen.id_tempat', 'left');
    $this->db->join('master_program', 'master_program.id_program = notulen.id_program', 'left');
    $this->db->order_by('id_notulen','ASC');
    $query = $this->db->get();
    return $query->result_array();
  }


	//detail
  public function detail($id_notulen) {
   $query=$this->db->get_where('notulen',array('id_notulen'=>$id_notulen));
   return $query->row_array();
 }


 public function notulen_detail($id_notulen)
 {
  $this->db->select('notulen.*,master_tempat.jenis_tempat,master_tempat.tempat,master_tempat.wilayah,master_program.nama');
  $this->db->from('notulen');
  $this->db->join('master_tempat', 'master_tempat.id_tempat = notulen.id_tempat', 'left');
  $this->db->join('master_program', 'master_program.id_program = notulen.id_program', 'left');
  $this->db->where('notulen.id_notulen',$id_notulen);
  $this->db->group_by('notulen.id_notulen');
  $this->db->order_by('id_notulen','ASC');
  $query = $this->db->get();
  return $query->row_array();
}


   //tambah
public function tambah($data)
{
  $this->db->insert('notulen',$data);
}

   //edit
public function edit($data)
{
 $this->db->where('id_notulen',$data['id_notulen']);
 $this->db->update('notulen',$data);
}

  //hapus
public function delete($data)
{
 $this->db->where('id_notulen',$data['id_notulen']);
 $this->db->delete('notulen',$data);
}
}