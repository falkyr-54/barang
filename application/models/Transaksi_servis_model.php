<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_servis_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->database();
	}


	public function listing()
	{
		$this->db->select('transaksi_servis.*,barang_keluar.seri,ms_rekanan.nama_rekanan,unit_bagian.unit, ms_barang.id_barang, satker.id_satker, satker.nama_satker');
		$this->db->from('transaksi_servis');
		$this->db->join('barang_keluar', 'barang_keluar.id_barang_keluar = transaksi_servis.id_barang_keluar', 'left');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->join('ms_rekanan', 'ms_rekanan.id_rekanan = transaksi_servis.id_rekanan', 'left');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = transaksi_servis.id_unit', 'left');
		$this->db->join('satker', 'satker.id_satker = transaksi_servis.id_satker', 'left');
		// $this->db->join('penempatan', 'penempatan.id_tempat = transaksi_servis.id_tempat', 'left');
		// $this->db->where('penempatan.status <>', 'Tidak Aktif');
		$this->db->order_by('id_servis', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function tambah($data)
	{
		$this->db->insert('transaksi_servis',$data);
	}
	public function ubah($data)
	{
		$this->db->where('id_servis', $data['id_servis']);
		$this->db->update('transaksi_servis', $data);
	}

	public function detail($id_servis) {
		$this->db->select('transaksi_servis.*,satker.nama_satker,unit_bagian.unit,ms_barang.id_barang');
		$this->db->from('transaksi_servis');
		$this->db->join('barang_keluar', 'barang_keluar.id_barang_keluar = transaksi_servis.id_barang_keluar', 'left');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = transaksi_servis.id_unit', 'left');
		$this->db->join('satker', 'satker.id_satker = transaksi_servis.id_satker', 'left');
		$this->db->where('transaksi_servis.id_servis', $id_servis);
		$this->db->order_by('id_servis', 'asc');
		$query = $this->db->get();
		return $query->row_array();
	}


	public function detail_barang($id_barang_keluar) {
		$this->db->select('transaksi_servis.*,ms_barang.id_barang');
		$this->db->from('transaksi_servis');
		$this->db->join('barang_keluar', 'barang_keluar.id_barang_keluar = transaksi_servis.id_barang_keluar', 'left');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->where('barang_keluar.id_barang_keluar', $id_barang_keluar);
		$this->db->order_by('id_barang_keluar', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function hapus($data)
	{
		$this->db->where('id_servis', $data['id_servis']);
		$this->db->delete('transaksi_servis',$data);
	}

	// Login
	public function login($username,$password)
	{
		$this->db->select('*');
		$this->db->from('transaksi_servis');
		// where
		$this->db->where(array(	'username'	=> $username,
			'password'	=> sha1($password)
		));
		$this->db->order_by('transaksi_servis.id_servis', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */