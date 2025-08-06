

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Satker_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}
	
	// Listing 
	public function listing() {
		$this->db->select('*');
		$this->db->from('satker');
		$this->db->order_by('id_satker','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function list_pustu() {
		$this->db->select('*');
		$this->db->from('satker');
		$this->db->where('id_jenis', 3);
		$this->db->order_by('id_satker','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	// Listing nama
	public function listing_nama() {
		$this->db->select('*');
		$this->db->from('satker');
		$this->db->order_by('nama_satker','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	// Listing satker
	public function listing_satker($id_satker) {
		$this->db->select('*');
		$this->db->from('satker');
		$this->db->where('id_satker',$id_satker);
		$this->db->order_by('nama_satker','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	// Detail
	public function detail($id_satker) {
		$query = $this->db->get_where('satker',array('id_satker' => $id_satker));
		return $query->row_array();
	}
	
	// Tambah
	public function tambah($data) {
		$this->db->insert('satker',$data);
	}
	
	// Edit
	public function edit($data) {
		$this->db->where('id_satker',$data['id_satker']);
		$this->db->update('satker',$data);
	}
	
	// Delete
	public function delete($data) {
		$this->db->where('id_satker',$data['id_satker']);
		$this->db->delete('satker',$data);
	}
}