<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}
	
	// Listing satker
	public function listing() {
		$this->db->select('*');
		$this->db->from('unit_bagian');
		$this->db->order_by('unit_bagian.unit','asc');
		$query = $this->db->get();
		return $query->result_array();
	}
	

	// Listing nama
	public function listing_nama() {
		$this->db->select('*');
		$this->db->from('unit_bagian');
		$this->db->order_by('unit','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	// Detail
	public function detail($id_unit) {
		$query = $this->db->get_where('unit_bagian',array('id_unit' => $id_unit));
		return $query->row_array();
	}
	
	// Tambah
	public function tambah($data) {
		$this->db->insert('unit_bagian',$data);
	}
	
	// Edit
	public function edit($data) {
		$this->db->where('id_unit',$data['id_unit']);
		$this->db->update('unit_bagian',$data);
	}
	
	// Delete
	public function delete($data) {
		$this->db->where('id_unit',$data['id_unit']);
		$this->db->delete('unit_bagian',$data);
	}
}