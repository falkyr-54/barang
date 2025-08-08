<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_brg_model extends CI_Model {

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

	public function terbaru($bulan,$tahun) {

		$bagian = array('acc_pj','acc_p','tolak_p');

		$this->db->select('barang_keluar.*, ms_barang.nama_barang, pegawai.nama_lengkap, unit_bagian.unit, satker.nama_satker,ms_satuan.satuan');
		$this->db->from('barang_keluar');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->join('ms_satuan', 'ms_satuan.id_satuan = ms_barang.id_satuan', 'left');
		$this->db->join('pegawai', 'pegawai.id_pegawai = barang_keluar.id_pegawai', 'left');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = barang_keluar.id_unit', 'left');
		$this->db->join('satker', 'satker.id_satker = barang_keluar.id_satker', 'left');
		$this->db->join('klaster', 'klaster.id_klaster = unit_bagian.id_klaster', 'left');
		$this->db->where('month(tanggal_minta)', $bulan);
		$this->db->where('year(tanggal_minta)' , $tahun);
		$this->db->where_in('status_validasi',$bagian);
		$this->db->order_by('tanggal_minta', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}


	public function now() {

		// $bagian = array('acc_pj','acc_p','tolak_p');

		$this->db->select('barang_keluar.*, ms_barang.nama_barang, pegawai.nama_lengkap, unit_bagian.unit, satker.nama_satker,ms_satuan.satuan');
		$this->db->from('barang_keluar');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->join('ms_satuan', 'ms_satuan.id_satuan = ms_barang.id_satuan', 'left');
		$this->db->join('pegawai', 'pegawai.id_pegawai = barang_keluar.id_pegawai', 'left');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = barang_keluar.id_unit', 'left');
		$this->db->join('satker', 'satker.id_satker = barang_keluar.id_satker', 'left');
		$this->db->join('klaster', 'klaster.id_klaster = unit_bagian.id_klaster', 'left');
		$this->db->where_in('status_validasi','acc_pj');
		$this->db->order_by('tanggal_minta', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}




	public function detail($id_barang_keluar)
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
		$this->db->order_by('id_barang_keluar', 'desc');
		$query = $this->db->get();
		return $query->row_array();
	}


	public function pencarian($tmt, $sampai, $status)
	{	

		$id_klaster = $this->session->userdata('id_klaster');

		$this->db->select('barang_keluar.*, ms_barang.nama_barang, pegawai.nama_lengkap, unit_bagian.unit, satker.nama_satker,ms_satuan.satuan');
		$this->db->from('barang_keluar');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->join('ms_satuan', 'ms_satuan.id_satuan = ms_barang.id_satuan', 'left');
		$this->db->join('pegawai', 'pegawai.id_pegawai = barang_keluar.id_pegawai', 'left');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = barang_keluar.id_unit', 'left');
		$this->db->join('satker', 'satker.id_satker = barang_keluar.id_satker', 'left');
		$this->db->join('klaster', 'klaster.id_klaster = unit_bagian.id_klaster', 'left');
		$this->db->where(array(
			'barang_keluar.tanggal_minta >=' => $tmt,
			'barang_keluar.tanggal_minta <=' => $sampai,
			'barang_keluar.status_validasi'  => $status
		));
		$this->db->order_by('tanggal_minta', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function cari_klast($tmt, $sampai)
	{	

		$bagian = array('acc_pj','acc_p','tolak_p','acc_pj');

		$this->db->select('barang_keluar.*, ms_barang.nama_barang, pegawai.nama_lengkap, unit_bagian.unit, satker.nama_satker,ms_satuan.satuan');
		$this->db->from('barang_keluar');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->join('ms_satuan', 'ms_satuan.id_satuan = ms_barang.id_satuan', 'left');
		$this->db->join('pegawai', 'pegawai.id_pegawai = barang_keluar.id_pegawai', 'left');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = barang_keluar.id_unit', 'left');
		$this->db->join('satker', 'satker.id_satker = barang_keluar.id_satker', 'left');
		$this->db->join('klaster', 'klaster.id_klaster = unit_bagian.id_klaster', 'left');
		$this->db->where('barang_keluar.tanggal_minta >=',$tmt);
		$this->db->where('barang_keluar.tanggal_minta <=',$sampai);
		$this->db->where_in('barang_keluar.status_validasi',$bagian);

		$this->db->order_by('tanggal_minta', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}

}