<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diskusi_model extends CI_Model {

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


 public function detail_diskusi($id_notulen)
 {
  $this->db->select('*');
  $this->db->from('diskusi');
  $this->db->where('diskusi.id_notulen',$id_notulen);
  $this->db->order_by('id_notulen','ASC');
  $query = $this->db->get();
  return $query->result_array();
}


   //tambah
public function tambah($data)
{
  $this->db->insert('diskusi',$data);
}

   //edit
public function edit($data)
{
 $this->db->where('id_diskusi',$data['id_diskusi']);
 $this->db->update('diskusi',$data);
}

  //hapus
public function delete($data)
{
 $this->db->where('id_diskusi',$data['id_diskusi']);
 $this->db->delete('diskusi',$data);
}
}