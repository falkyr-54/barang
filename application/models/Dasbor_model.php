<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dasbor_model extends CI_Model {
	
	public function __construct() {
		$this->load->database();
	}


	public function terbaru($tahun)
	{	
		
		$this->db->select('*');	
		$this->db->from('barang_keluar');	
		$this->db->where('year(tanggal_minta)', $tahun);
		$this->db->group_by('month(tanggal_minta)');
		$this->db->order_by('tanggal_minta','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}


	// ATK
	public function atk($bulan,$tahun) {
		$this->db->select('SUM(jumlah_keluar) AS jumlah, ms_jenis_barang.nama_jenis');
		$this->db->from('barang_keluar');
		$this->db->join('ms_jenis_barang', 'ms_jenis_barang.id_jenis = barang_keluar.id_jenis', 'left');
		$this->db->where('year(tanggal_minta)', $tahun);
		$this->db->where('month(tanggal_minta)', $bulan);
		$this->db->where('barang_keluar.id_jenis',1);
		$this->db->group_by('month(tanggal_minta)');
		$query = $this->db->get();
		return $query->result_array(); 	
	}

	

	// cetakan umum
	public function cu($bulan,$tahun) {
		$this->db->select('SUM(jumlah_keluar) AS jumlah, ms_jenis_barang.nama_jenis');
		$this->db->from('barang_keluar');
		$this->db->join('ms_jenis_barang', 'ms_jenis_barang.id_jenis = barang_keluar.id_jenis', 'left');
		$this->db->where('year(tanggal_minta)', $tahun);
		$this->db->where('month(tanggal_minta)', $bulan);
		$this->db->where('barang_keluar.id_jenis',6);
		$this->db->group_by('month(tanggal_minta)');
		$query = $this->db->get();
		return $query->result_array(); 	
	}
	
	// barang it
	public function it($bulan,$tahun) {
	$this->db->select('SUM(jumlah_keluar) AS jumlah, ms_jenis_barang.nama_jenis');
		$this->db->from('barang_keluar');
		$this->db->join('ms_jenis_barang', 'ms_jenis_barang.id_jenis = barang_keluar.id_jenis', 'left');
		$this->db->where('year(tanggal_minta)', $tahun);
		$this->db->where('month(tanggal_minta)', $bulan);
		$this->db->where('barang_keluar.id_jenis',5);
		$this->db->group_by('month(tanggal_minta)');
		$query = $this->db->get();
		return $query->result_array(); 	
	}

	// art
	public function art($bulan,$tahun) {
		$this->db->select('SUM(jumlah_keluar) AS jumlah, ms_jenis_barang.nama_jenis');
		$this->db->from('barang_keluar');
		$this->db->join('ms_jenis_barang', 'ms_jenis_barang.id_jenis = barang_keluar.id_jenis', 'left');
		$this->db->where('year(tanggal_minta)', $tahun);
		$this->db->where('month(tanggal_minta)', $bulan);
		$this->db->where('barang_keluar.id_jenis',7);
		$this->db->group_by('month(tanggal_minta)');
		$query = $this->db->get();
		return $query->result_array(); 	
	}

	// barang it
	public function ctk($bulan,$tahun) {
		$this->db->select('SUM(jumlah_keluar) AS jumlah, ms_jenis_barang.nama_jenis');
		$this->db->from('barang_keluar');
		$this->db->join('ms_jenis_barang', 'ms_jenis_barang.id_jenis = barang_keluar.id_jenis', 'left');
		$this->db->where('year(tanggal_minta)', $tahun);
		$this->db->where('month(tanggal_minta)', $bulan);
		$this->db->where('barang_keluar.id_jenis',9);
		$this->db->group_by('month(tanggal_minta)');
		$query = $this->db->get();
		return $query->result_array(); 	
	}

	// barang it
	public function alk($bulan,$tahun) {
		$this->db->select('SUM(jumlah_keluar) AS jumlah, ms_jenis_barang.nama_jenis');
		$this->db->from('barang_keluar');
		$this->db->join('ms_jenis_barang', 'ms_jenis_barang.id_jenis = barang_keluar.id_jenis', 'left');
		$this->db->where('year(tanggal_minta)', $tahun);
		$this->db->where('month(tanggal_minta)', $bulan);
		$this->db->where('barang_keluar.id_jenis',10);
		$this->db->group_by('month(tanggal_minta)');
		$query = $this->db->get();
		return $query->result_array(); 	
	}
	

	
	
}