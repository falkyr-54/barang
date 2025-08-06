<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reff_model extends CI_Model {
	
	public function __construct() {
		$this->load->database();	
	}
	
	// Cuti
	public function jencuti() {
		$this->db->select('*');
		$this->db->from('jencuti');
		$this->db->order_by('jencuti','ASC');  
		$query	= $this->db->get();
		return $query->result();
	}
	
	// Cuti
	public function pejtt() {
		$this->db->select('*');
		$this->db->from('pejtt');
		$this->db->order_by('kdpejtt','ASC');  
		$query	= $this->db->get();
		return $query->result();
	}
}
	