<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pers_cuti_hist_model extends CI_model {
	
	// Load database
	public function _construct() {
		$this->load->database();
	}
	
	// Listing
	public function listing() {
		$this->db->select('pers_cuti_hist.*,pegawai.nama AS nama_pegawai, jencuti.keterangan');
		$this->db->from('pers_cuti_hist');
		$this->db->join('pegawai','pegawai.nrk = pers_cuti_hist.nrk','LEFT');
		$this->db->join('jencuti','jencuti.jencuti = pers_cuti_hist.jencuti','LEFT');
		$this->db->order_by('id_pers_cuti_hist','DESC');
		$query = $this->db->get();
		return $query->result();
	}
	
	// Pegawai
	public function pegawai($nrk) {
		$this->db->select('pers_cuti_hist.*,pegawai.nama AS nama_pegawai, jencuti.keterangan');
		$this->db->from('pers_cuti_hist');
		$this->db->join('pegawai','pegawai.nrk = pers_cuti_hist.nrk','LEFT');
		$this->db->join('jencuti','jencuti.jencuti = pers_cuti_hist.jencuti','LEFT');
		$this->db->where('pers_cuti_hist.nrk',$nrk);
		$this->db->order_by('id_pers_cuti_hist','DESC');
		$query = $this->db->get();
		return $query->result();
	}
	
	// Detail
	public function detail($id_pers_cuti_hist) {
		$query = $this->db->get_where('pers_cuti_hist',array('id_pers_cuti_hist' => $id_pers_cuti_hist));
		return $query->row();
  	}
	
	// Detail pegawai
	public function detail_pegawai($nrk,$id_pers_cuti_hist) {
		$query = $this->db->get_where('pers_cuti_hist',
				array(	'id_pers_cuti_hist'	=> $id_pers_cuti_hist,
						'nrk'				=> $nrk));
		return $query->row();
  	}
	
	// NRK
	public function nrk($nrk) {
		$query = $this->db->get_where('pers_cuti_hist',array('nrk' => $nrk));
		return $query->row();
  	}
	
	// Check delete: data pers_cuti_hist tidak dapat dihapus jika sudah dipakai di tabel lain
	public function check_disposisi($id_pers_cuti_hist) {
		$query = $this->db->get_where('disposisi',array('id_pers_cuti_hist' => $id_pers_cuti_hist));
		return $query->result_array(); 
	}
	
	public function check_surat($id_pers_cuti_hist) {
		$query = $this->db->get_where('surat',array('id_pers_cuti_hist' => $id_pers_cuti_hist));
		return $query->result_array(); 
	}
  
  	// Tambah insert
  	public function tambah($data) {
    	$this->db->insert('pers_cuti_hist', $data);
  	}
  
  	// Edit
  	public function edit($data) {
		$this->db->where('id_pers_cuti_hist', $data['id_pers_cuti_hist']);
		$this->db->update('pers_cuti_hist',$data);
  	}
  
  	// Delete
  	public function delete($data) {
		$this->db->where('id_pers_cuti_hist', $data['id_pers_cuti_hist']);
		$this->db->delete('pers_cuti_hist',$data);
  	}
}