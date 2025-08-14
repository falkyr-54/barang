<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pjklaster_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}	

	public function list_barang($id_klaster)
	{
		$this->db->select('barang_keluar.*, ms_barang.nama_barang, pegawai.nama_lengkap, unit_bagian.unit, satker.nama_satker');
		$this->db->from('barang_keluar');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->join('pegawai', 'pegawai.id_pegawai = barang_keluar.id_pegawai', 'left');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = barang_keluar.id_unit', 'left');
		$this->db->join('satker', 'satker.id_satker = barang_keluar.id_satker', 'left');
		$this->db->join('klaster', 'klaster.id_klaster = unit_bagian.id_klaster', 'left');
		$this->db->where('unit_bagian.id_klaster', $id_klaster);
		$this->db->where('barang_keluar.status_validasi', 'belum');
		$this->db->order_by('id_barang_keluar', 'desc');
		$this->db->limit(10); // <--- Batasi 10 data
		$query = $this->db->get();

		return $query->result_array();
	}

	public function terbaru($bulan,$tahun,$id_klaster) {


		$this->db->select('barang_keluar.*, ms_barang.nama_barang, pegawai.nama_lengkap, unit_bagian.unit, satker.nama_satker,ms_satuan.satuan');
		$this->db->from('barang_keluar');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->join('ms_satuan', 'ms_satuan.id_satuan = ms_barang.id_satuan', 'left');
		$this->db->join('pegawai', 'pegawai.id_pegawai = barang_keluar.id_pegawai', 'left');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = barang_keluar.id_unit', 'left');
		$this->db->join('satker', 'satker.id_satker = barang_keluar.id_satker', 'left');
		$this->db->join('klaster', 'klaster.id_klaster = unit_bagian.id_klaster', 'left');
		$this->db->where(array('month(tanggal_minta)' => $bulan,
			'year(tanggal_minta)' => $tahun,
			'unit_bagian.id_klaster' => $id_klaster
		));
		$this->db->order_by('tanggal_minta', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function now($id_klaster) {

		$list = ['acc_pj','belum','tolak_pj'];

		$this->db->select('barang_keluar.*, ms_barang.nama_barang, pegawai.nama_lengkap, unit_bagian.unit, satker.nama_satker,ms_satuan.satuan');
		$this->db->from('barang_keluar');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->join('ms_satuan', 'ms_satuan.id_satuan = ms_barang.id_satuan', 'left');
		$this->db->join('pegawai', 'pegawai.id_pegawai = barang_keluar.id_pegawai', 'left');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = barang_keluar.id_unit', 'left');
		$this->db->join('satker', 'satker.id_satker = barang_keluar.id_satker', 'left');
		$this->db->join('klaster', 'klaster.id_klaster = unit_bagian.id_klaster', 'left');
		$this->db->where('unit_bagian.id_klaster',$id_klaster);
		$this->db->where_in('status_validasi',$list);
		$this->db->order_by('tanggal_minta', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function detail($id_klaster,$id_barang_keluar)
	{
		$this->db->select('barang_keluar.*, ms_barang.nama_barang, pegawai.nama_lengkap, unit_bagian.unit, satker.nama_satker,ms_satuan.satuan');
		$this->db->from('barang_keluar');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->join('ms_satuan', 'ms_satuan.id_satuan = ms_barang.id_satuan', 'left');
		$this->db->join('pegawai', 'pegawai.id_pegawai = barang_keluar.id_pegawai', 'left');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = barang_keluar.id_unit', 'left');
		$this->db->join('satker', 'satker.id_satker = barang_keluar.id_satker', 'left');
		$this->db->join('klaster', 'klaster.id_klaster = unit_bagian.id_klaster', 'left');
		$this->db->where('id_barang_keluar', $id_barang_keluar);
		$this->db->where('unit_bagian.id_klaster', $id_klaster);
		$this->db->order_by('id_barang_keluar', 'desc');
		$query = $this->db->get();
		return $query->row_array();
	}

}