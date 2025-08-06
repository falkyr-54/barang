<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_model extends CI_Model {
	
	public function __construct() {
		$this->load->database();
	}
	
	// Listing profil
	public function nav_profil() {
		$this->db->select('*');
		$this->db->from('berita');
		$this->db->where(array(	'jenis'			=> 'Profil',
								'status_berita'	=> 'Publish'));
		$this->db->order_by('urutan','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	// Navigasi fraksi
	public function nav_fraksi() {
		$this->db->select('fraksi.*, staff.nama');
		$this->db->from('fraksi');
		$this->db->join('staff','staff.id_fraksi=fraksi.id_fraksi','INNER');
		$this->db->group_by('fraksi.id_fraksi');
		$this->db->order_by('urutan','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	// Navigasi komisi
	public function nav_komisi() {
		$this->db->select('*');
		$this->db->from('staff');
		$this->group_by('pendidikan');
		$this->db->where('status_staff','Ya');
		$this->db->order_by('urutan','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	// Navigasi berita
	public function nav_berita() {
		$this->db->select('kategori_berita.*, berita.id_kategori_berita');
		$this->db->from('kategori_berita');
		$this->db->join('berita','berita.id_kategori_berita = 
		kategori_berita.id_kategori_berita','INNER');
		$this->db->where(array(	'berita.jenis'			=> 'Berita',
								'berita.status_berita'	=> 'Publish'));
		$this->db->group_by('kategori_berita.id_kategori_berita');	
		$this->db->order_by('kategori_berita.urutan','ASC');			
		$query = $this->db->get();
		return $query->result_array();
	}
	
	// Menjelang pensiun
	public function akan_pensiun() {
		date_default_timezone_set('Asia/Jakarta');
		$dahulu	= date('Y-m-d');
		$this->db->select('*');
		$this->db->from('pegawai');	
		$this->db->where("DATEDIFF('$dahulu', tanggal_lahir) > 57"); 
		$query = $this->db->get();
		return $query->result_array();
	}
}