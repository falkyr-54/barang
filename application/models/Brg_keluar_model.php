<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Brg_keluar_model extends CI_Model
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

	public function list_brg($id_barang, $id_satker)
	{
		$this->db->select('barang_keluar.*,ms_barang.nama_barang,pegawai.nama_lengkap,satker.nama_satker,unit_bagian.unit');
		$this->db->from('barang_keluar');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->join('pegawai', 'pegawai.id_pegawai = barang_keluar.id_pegawai', 'left');
		$this->db->join('satker', 'satker.id_satker = barang_keluar.id_satker', 'left');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = barang_keluar.id_unit', 'left');
		$this->db->where('ms_barang.id_barang', $id_barang);
		$this->db->where('barang_keluar.id_satker', $id_satker);
		$this->db->order_by('id_barang_keluar', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function list_skrg($id_satker, $skrg)
	{
		$this->db->select('barang_keluar.*,ms_barang.nama_barang,pegawai.nama_lengkap,satker.nama_satker,unit_bagian.unit');
		$this->db->from('barang_keluar');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->join('pegawai', 'pegawai.id_pegawai = barang_keluar.id_pegawai', 'left');
		$this->db->join('satker', 'satker.id_satker = barang_keluar.id_satker', 'left');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = barang_keluar.id_unit', 'left');
		$this->db->where('barang_keluar.id_satker', $id_satker);
		$this->db->where('tanggal_minta', $skrg);
		$this->db->order_by('id_barang_keluar', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}


	public function list_brgku($id_barang)
	{
		$this->db->select('barang_keluar.*,ms_barang.nama_barang,pegawai.nama_lengkap,satker.nama_satker,unit_bagian.unit');
		$this->db->from('barang_keluar');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->join('pegawai', 'pegawai.id_pegawai = barang_keluar.id_pegawai', 'left');
		$this->db->join('satker', 'satker.id_satker = barang_keluar.id_satker', 'left');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = barang_keluar.id_unit', 'left');
		$this->db->where('ms_barang.id_barang', $id_barang);
		// $this->db->where('barang_keluar.id_satker', $id_satker);
		$this->db->order_by('id_barang_keluar', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	//expired 6 bulan
	public function list_expired6bulan()
	{

		$today = date('Y-m-d');
		$tiga_bulan_ke_depan = date('Y-m-d', strtotime('+6 months'));
		$this->db->select('barang_keluar.*,ms_barang.nama_barang,pegawai.nama_lengkap,satker.nama_satker,unit_bagian.unit,ms_jenis_barang.nama_jenis');
		$this->db->from('barang_keluar');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->join('pegawai', 'pegawai.id_pegawai = barang_keluar.id_pegawai', 'left');
		$this->db->join('satker', 'satker.id_satker = barang_keluar.id_satker', 'left');
		$this->db->join('ms_jenis_barang', 'ms_jenis_barang.id_jenis = ms_barang.id_jenis', 'left');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = barang_keluar.id_unit', 'left');
		$this->db->where('barang_keluar.tanggal_expired >=', $today);
		$this->db->where('barang_keluar.tanggal_expired <=', $tiga_bulan_ke_depan);
		$this->db->where_in('ms_jenis_barang.id_jenis', [14, 15, 16]);
		$this->db->order_by('id_barang_keluar', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}
	//expired 3 bulan
	public function list_expired3bulan()
	{

		$today = date('Y-m-d');
		$tiga_bulan_ke_depan = date('Y-m-d', strtotime('+3 months'));

		$this->db->select('barang_keluar.*,ms_barang.nama_barang,pegawai.nama_lengkap,satker.nama_satker,unit_bagian.unit,ms_jenis_barang.nama_jenis');
		$this->db->from('barang_keluar');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->join('pegawai', 'pegawai.id_pegawai = barang_keluar.id_pegawai', 'left');
		$this->db->join('satker', 'satker.id_satker = barang_keluar.id_satker', 'left');
		$this->db->join('ms_jenis_barang', 'ms_jenis_barang.id_jenis = ms_barang.id_jenis', 'left');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = barang_keluar.id_unit', 'left');
		$this->db->where('barang_keluar.tanggal_expired >=', $today);
		$this->db->where('barang_keluar.tanggal_expired <=', $tiga_bulan_ke_depan);
		$this->db->where_in('ms_jenis_barang.id_jenis', [14, 15, 16]);
		$this->db->order_by('id_barang_keluar', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	//expired 1 bulan
	public function list_expired1bulan()
	{


		$today = date('Y-m-d');
		$tiga_bulan_ke_depan = date('Y-m-d', strtotime('+1 months'));
		$this->db->select('barang_keluar.*,ms_barang.nama_barang,pegawai.nama_lengkap,satker.nama_satker,unit_bagian.unit,ms_jenis_barang.nama_jenis');
		$this->db->from('barang_keluar');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->join('pegawai', 'pegawai.id_pegawai = barang_keluar.id_pegawai', 'left');
		$this->db->join('satker', 'satker.id_satker = barang_keluar.id_satker', 'left');
		$this->db->join('ms_jenis_barang', 'ms_jenis_barang.id_jenis = ms_barang.id_jenis', 'left');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = barang_keluar.id_unit', 'left');
		$this->db->where('barang_keluar.tanggal_expired >=', $today);
		$this->db->where('barang_keluar.tanggal_expired <=', $tiga_bulan_ke_depan);
		$this->db->where_in('ms_jenis_barang.id_jenis', [14, 15, 16]);
		$this->db->order_by('id_barang_keluar', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function tambah($data)
	{
		$this->db->insert('barang_keluar', $data);
	}

	public function detail($id_klaster,$id_barang_keluar)
	{
		$this->db->select('barang_keluar.*,ms_barang.nama_barang,ms_barang.kode_barang,ms_satuan.satuan,pegawai.nama_lengkap,barang_masuk.harga,barang_masuk.tahun_pengadaan,ms_rekanan.nama_rekanan,unit_bagian.unit,satker.nama_satker,barang_masuk.gambar');
		$this->db->from('barang_keluar');
		$this->db->join('barang_masuk', 'barang_masuk.id_barang_masuk = barang_keluar.id_barang_masuk', 'left');
		$this->db->join('ms_rekanan', 'ms_rekanan.id_rekanan = barang_masuk.id_rekanan', 'left');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->join('satker', 'satker.id_satker = barang_keluar.id_satker', 'left');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = barang_keluar.id_unit', 'left');
		$this->db->join('pegawai', 'pegawai.id_pegawai = barang_keluar.id_pegawai', 'left');
		$this->db->join('ms_satuan', 'ms_satuan.id_satuan = ms_barang.id_satuan', 'left');
		$this->db->where('id_barang_keluar', $id_barang_keluar);
		$this->db->order_by('id_barang_keluar', 'desc');
		$query = $this->db->get();
		return $query->row_array();
	}

	public function update($data)
	{
		$this->db->where('id_barang_keluar', $data['id_barang_keluar']);
		$this->db->update('barang_keluar', $data);
	}

	public function get_jumlah_keluar($id_barang)
	{
		$this->db->select('SUM(jumlah_keluar) as total');
		$this->db->from('barang_keluar');
		$this->db->where('id_barang', $id_barang);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_jumlah_klr($id_barang)
	{
		$this->db->select('SUM(jumlah_keluar) as total');
		$this->db->from('barang_keluar');
		$this->db->where('id_barang_masuk', $id_barang);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_jumlah_stok($id_barangku, $tmt, $tmtdua)
	{
		$this->db->select('SUM(jumlah_keluar) as total');
		$this->db->from('barang_keluar');
		$this->db->where('id_barang_masuk', $id_barangku);
		$this->db->where('tanggal_minta >=', $tmt);
		$this->db->where('tanggal_minta <=', $tmtdua);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_total_id($id_barang, $id_barang_masuk)
	{
		$this->db->select('SUM(jumlah_keluar) as total');
		$this->db->from('barang_keluar');
		$this->db->where('id_barang', $id_barang);
		$this->db->where('id_barang_masuk', $id_barang_masuk);
		$this->db->order_by('id_barang_keluar', 'DESC');
		$query = $this->db->get();
		return $query->row_array();
	}


	public function delete($data)
	{
		$this->db->where('id_barang_keluar', $data['id_barang_keluar']);
		$this->db->delete('barang_keluar', $data);
	}

	public function cari_brg_keluar($tmt, $tmtdua, $id_jenis)
	{
		$this->db->select('barang_keluar.*,ms_barang.nama_barang,ms_satuan.satuan,ms_jenis_barang.nama_jenis,barang_masuk.harga,satker.nama_satker,unit_bagian.unit,ms_barang.id_barang');
		$this->db->from('barang_keluar');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->join('barang_masuk', 'barang_masuk.id_barang_masuk = barang_keluar.id_barang_masuk', 'inner');
		$this->db->join('ms_satuan', 'ms_satuan.id_satuan = ms_barang.id_satuan', 'left');
		$this->db->join('ms_jenis_barang', 'ms_jenis_barang.id_jenis = ms_barang.id_jenis', 'left');
		$this->db->join('satker', 'satker.id_satker = barang_keluar.id_satker', 'left');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = barang_keluar.id_unit', 'left');
		$this->db->where('tanggal_minta >=', $tmt);
		$this->db->where('tanggal_minta <=', $tmtdua);
		$this->db->where('ms_jenis_barang.id_jenis', $id_jenis);
		$this->db->group_by('barang_keluar.id_barang_masuk');
		$this->db->order_by('tanggal_minta', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function pencarian_hasil($tmt, $tmtdua, $id_unit)
	{

		$this->db->select('barang_keluar.*,ms_barang.nama_barang,pegawai.nama_lengkap,satker.nama_satker,unit_bagian.unit');
		$this->db->from('barang_keluar');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->join('pegawai', 'pegawai.id_pegawai = barang_keluar.id_pegawai', 'left');
		$this->db->join('satker', 'satker.id_satker = barang_keluar.id_satker', 'left');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = barang_keluar.id_unit', 'left');
		$this->db->where(array(
			'barang_keluar.tanggal_minta >=' => $tmt,
			'barang_keluar.tanggal_minta <=' => $tmtdua,
			'unit_bagian.id_unit' => $id_unit
		));
		$this->db->order_by('tanggal_minta', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function pencarian_hasil_tgl($tmt, $tmtdua)
	{

		$this->db->select('barang_keluar.*,ms_barang.nama_barang,pegawai.nama_lengkap,satker.nama_satker,unit_bagian.unit');
		$this->db->from('barang_keluar');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->join('pegawai', 'pegawai.id_pegawai = barang_keluar.id_pegawai', 'left');
		$this->db->join('satker', 'satker.id_satker = barang_keluar.id_satker', 'left');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = barang_keluar.id_unit', 'left');
		$this->db->where(array(
			'barang_keluar.tanggal_minta >=' => $tmt,
			'barang_keluar.tanggal_minta <=' => $tmtdua
		));
		$this->db->order_by('tanggal_minta', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function pencarian($tmt, $sampai, $id_klaster, $status)
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
			'unit_bagian.id_klaster' 		 => $id_klaster,
			'barang_keluar.status_validasi'  => $status
		));
		$this->db->order_by('tanggal_minta', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function cari_klast($tmt, $sampai, $id_klaster)
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
			'unit_bagian.id_klaster' 		 => $id_klaster
		));
		$this->db->order_by('tanggal_minta', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}

	
}
