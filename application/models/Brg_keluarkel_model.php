<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brg_keluarkel_model extends CI_Model {

	public function __construct() {
		$this->load->database();

	}	

	// Listing
	public function listing() {
		$this->db->select('brg_keluar_kel.*,ms_barang.nama_barang,ms_satuan.satuan,pegawai.nama_lengkap,satker.nama_satker,unit.unit_bagian,brg_keluar_kel.id_luar_kel');
		$this->db->from('brg_keluar_kel');
		$this->db->join('ms_barang', 'ms_barang.id_barang = brg_keluar_kel.id_barang', 'left');
		$this->db->join('pegawai', 'pegawai.id_pegawai = brg_keluar_kel.id_pegawai', 'left');
		$this->db->join('satker', 'satker.id_satker = brg_keluar_kel.id_satker', 'left');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = brg_keluar_kel.id_unit', 'left');
		$this->db->order_by('id_luar_kel','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function list_brg($id_barang,$id_satker)
	{
		$this->db->select('brg_keluar_kel.*,ms_barang.nama_barang,pegawai.nama_lengkap,satker.nama_satker,unit_bagian.unit');
		$this->db->from('brg_keluar_kel');
		$this->db->join('ms_barang', 'ms_barang.id_barang = brg_keluar_kel.id_barang', 'left');
		$this->db->join('pegawai', 'pegawai.id_pegawai = brg_keluar_kel.id_pegawai', 'left');
		$this->db->join('satker', 'satker.id_satker = brg_keluar_kel.id_satker', 'left');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = brg_keluar_kel.id_unit', 'left');
		$this->db->where('brg_keluar_kel.id_barang', $id_barang);
		$this->db->where('brg_keluar_kel.id_satker', $id_satker);
		$this->db->order_by('id_luar_kel', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}


	public function list_skrg($id_satker,$skrg)
	{
		$this->db->select('brg_keluar_kel.*,ms_barang.nama_barang,pegawai.nama_lengkap,satker.nama_satker,unit_bagian.unit');
		$this->db->from('brg_keluar_kel');
		$this->db->join('ms_barang', 'ms_barang.id_barang = brg_keluar_kel.id_barang', 'left');
		$this->db->join('pegawai', 'pegawai.id_pegawai = brg_keluar_kel.id_pegawai', 'left');
		$this->db->join('satker', 'satker.id_satker = brg_keluar_kel.id_satker', 'left');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = brg_keluar_kel.id_unit', 'left');
		$this->db->where('brg_keluar_kel.id_satker', $id_satker);
		$this->db->where('tanggal_minta', $skrg);
		$this->db->order_by('id_msk_kel', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}


	function get_sparepart_by($term, $column='*') {
		$this->db->select($column);
		$this->db->like('nama_barang',$term);
		$this->db->or_like('kode_barang',$term);
		$data = $this->db->from('barang')->get();
		return $data->result_array();
	}

	public function brg_keluar_kel($id_rekanan)
	{
		$this->db->select('brg_keluar_kel.*,ms_barang.nama_barang,ms_rekanan.nama_rekanan,ms_rekanan.alamat');
		$this->db->from('brg_keluar_kel');
		$this->db->join('ms_barang', 'ms_barang.id_barang = brg_keluar_kel.id_barang', 'left');
		$this->db->join('ms_rekanan', 'ms_rekanan.id_rekanan = brg_keluar_kel.id_rekanan', 'left');
		$this->db->where('ms_rekanan.id_rekanan', $id_rekanan);
		$this->db->order_by('id_luar_kel', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function tambah($data)
	{
		$this->db->insert('brg_keluar_kel',$data);
	}

	public function detail($id_luar_kel)
	{
		$this->db->select('brg_keluar_kel.*,ms_barang.nama_barang,ms_barang.id_barang,ms_satuan.satuan,pegawai.nama_lengkap,satker.nama_satker,unit_bagian.unit,brg_keluar_kel.id_luar_kel');
		$this->db->from('brg_keluar_kel');
		$this->db->join('brg_masuk_kel', 'brg_masuk_kel.id_msk_kel = barang_keluar.id_msk_kel', 'left');
		$this->db->join('ms_barang', 'ms_barang.id_barang = brg_keluar_kel.id_barang', 'left');
		$this->db->join('ms_satuan', 'ms_satuan.id_satuan = ms_barang.id_satuan', 'left');
		$this->db->join('pegawai', 'pegawai.id_pegawai = brg_keluar_kel.id_pegawai', 'left');
		$this->db->join('satker', 'satker.id_satker = brg_keluar_kel.id_satker', 'left');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = brg_keluar_kel.id_unit', 'left');
		$this->db->where('id_luar_kel',$id_luar_kel);
		$this->db->order_by('id_luar_kel', 'desc');
		$query = $this->db->get();
		return $query ->row_array();
	}



	public function update($data)
	{
		$this->db->where('id_luar_kel',$data['id_luar_kel']);
		$this->db->update('brg_keluar_kel',$data);
	}

	public function update_kel($data)
	{
		$this->db->where('id_luar_kel',$data['id_luar_kel']);
		$this->db->update('brg_keluar_kel',$data);
	}

	public function get_jumlah_keluar($id_barang,$id_satker)
	{
		$this->db->select('SUM(jumlah_keluar) as total');
		$this->db->from('brg_keluar_kel');
		$this->db->where('id_barang',$id_barang);
		$this->db->where('id_satker',$id_satker);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_jumlah_stok($id_satker,$id_barangku,$tmt,$tmtdua)
	{
		$this->db->select('SUM(jumlah_keluar) as total');
		$this->db->from('brg_keluar_kel');
		$this->db->where('id_luar_kel',$id_barangku);
		$this->db->where('id_satker',$id_satker);
		$this->db->where('tanggal_minta >=',$tmt);
		$this->db->where('tanggal_minta <=',$tmtdua);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_total_id($id_barang,$id_msk_kel)
	{
		$this->db->select('SUM(jumlah_keluar) as total');
		$this->db->from('brg_keluar_kel');
		$this->db->where('id_barang',$id_barang);
		$this->db->where('id_msk_kel',$id_msk_kel);
		$this->db->order_by('id_luar_kel','DESC');
		$query = $this->db->get();
		return $query->row_array();
	}


	public function delete($data)
	{
		$this->db->where('id_luar_kel', $data['id_luar_kel']);
		$this->db->delete('brg_keluar_kel',$data);
	}

}


