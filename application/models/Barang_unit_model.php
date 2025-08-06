<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_unit_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	// Listing
	public function listing()
	{
		$this->db->select('barang_keluar.*,ms_barang.nama_barang,ms_satuan.satuan,ms_barang.id_satuan');
		$this->db->from('barang_keluar');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->join('ms_satuan', 'ms_satuan.id_satuan = ms_barang.id_satuan', 'left');
		$this->db->order_by('id_barang_keluar', 'ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function list_brgku($id_unit)
	{
		$this->db->select('barang_keluar.*,ms_barang.nama_barang,pegawai_barang.nama_lengkap,satker.nama_satker,unit_bagian.unit');
		$this->db->from('barang_keluar');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->join('pegawai_barang', 'pegawai_barang.id_pegawai = barang_keluar.id_pegawai', 'left');
		$this->db->join('satker', 'satker.id_satker = barang_keluar.id_satker', 'left');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = barang_keluar.id_unit', 'left');
		$this->db->where('barang_keluar.id_unit', $id_unit);
		// $this->db->where('barang_keluar.id_satker', $id_satker);
		$this->db->order_by('id_barang_keluar', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}


}
