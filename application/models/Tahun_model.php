<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tahun_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}	
	
	
	// Listing
	public function listing() {
		$this->db->select('*');
		$this->db->from('ms_tahun');
		$this->db->order_by('tahun','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	// Listing
	public function list_thn() {
		$this->db->select('*');
		$this->db->from('tahun_tb');
		$this->db->where('id_thn', 1);
		$this->db->order_by('id_thn','ASC');
		$query = $this->db->get();
		return $query->row_array();
	}
}