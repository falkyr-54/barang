<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brg_masukkel_model extends CI_Model {

	public function __construct() {
		$this->load->database();

	}	

	// Listing
	public function listing() {
		$this->db->select('brg_masuk_kel.*,ms_barang.nama_barang,ms_satuan.satuan,ms_rekanan.nama_rekanan,ms_barang.id_satuan');
		$this->db->from('brg_masuk_kel');
		$this->db->join('ms_barang', 'ms_barang.id_barang = brg_masuk_kel.id_barang', 'left');
		$this->db->join('ms_rekanan', 'ms_rekanan.id_rekanan = brg_masuk_kel.id_rekanan', 'left');
		$this->db->join('ms_satuan', 'ms_satuan.id_satuan = ms_barang.id_satuan', 'left');
		$this->db->order_by('id_msk_kel','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function masuk_pustu($tmt,$tmtdua,$id_satker)
	{
		$this->db->select('brg_masuk_kel.*,ms_barang.nama_barang,ms_satuan.satuan,ms_jenis_barang.nama_jenis,satker.nama_satker, satker.id_satker');
		$this->db->from('brg_masuk_kel');
		$this->db->join('ms_barang', 'ms_barang.id_barang = brg_masuk_kel.id_barang', 'left');
		$this->db->join('ms_satuan', 'ms_satuan.id_satuan = ms_barang.id_satuan', 'left');
		$this->db->join('ms_jenis_barang', 'ms_jenis_barang.id_jenis = brg_masuk_kel.id_jenis', 'left');
		$this->db->join('satker', 'satker.id_satker = brg_masuk_kel.id_satker', 'left');
		$this->db->where('tgl_datang >=',$tmt);
		$this->db->where('tgl_datang <=',$tmtdua);
		$this->db->where('brg_masuk_kel.id_satker',$id_satker);
		// $this->db->where('ms_barang.id_jenis',$id_jenis);
		$this->db->order_by('tgl_datang', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function list_brg($id_barang,$id_satker)
	{
		$this->db->select('brg_masuk_kel.*,ms_barang.nama_barang,ms_rekanan.nama_rekanan');
		$this->db->from('brg_masuk_kel');
		$this->db->join('ms_barang', 'ms_barang.id_barang = brg_masuk_kel.id_barang', 'left');
		$this->db->join('ms_rekanan', 'ms_rekanan.id_rekanan = brg_masuk_kel.id_rekanan', 'left');
		$this->db->where('brg_masuk_kel.id_barang', $id_barang);
		$this->db->where('brg_masuk_kel.id_satker', $id_satker);
		$this->db->order_by('id_msk_kel', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function list_skrg($id_satker,$skrg)
	{
		$this->db->select('brg_masuk_kel.*,ms_barang.nama_barang,ms_rekanan.nama_rekanan');
		$this->db->from('brg_masuk_kel');
		$this->db->join('ms_barang', 'ms_barang.id_barang = brg_masuk_kel.id_barang', 'left');
		$this->db->join('ms_rekanan', 'ms_rekanan.id_rekanan = brg_masuk_kel.id_rekanan', 'left');
		$this->db->where('brg_masuk_kel.id_satker', $id_satker);
		$this->db->where('tgl_datang', $skrg);
		$this->db->order_by('id_msk_kel', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}



	public function brg_masuk_kel($id_rekanan)
	{
		$this->db->select('brg_masuk_kel.*,ms_barang.nama_barang,ms_rekanan.nama_rekanan,ms_rekanan.alamat');
		$this->db->from('brg_masuk_kel');
		$this->db->join('ms_barang', 'ms_barang.id_barang = brg_masuk_kel.id_barang', 'left');
		$this->db->join('ms_rekanan', 'ms_rekanan.id_rekanan = brg_masuk_kel.id_rekanan', 'left');
		$this->db->where('ms_rekanan.id_rekanan', $id_rekanan);
		$this->db->order_by('id_msk_kel', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function tambah($data)
	{
		$this->db->insert('brg_masuk_kel',$data);
	}

	public function detail($id_msk_kel)
	{
		$this->db->select('brg_masuk_kel.*,ms_barang.nama_barang,ms_satuan.satuan');
		$this->db->from('brg_masuk_kel');
		$this->db->join('ms_barang', 'ms_barang.id_barang = brg_masuk_kel.id_barang', 'left');
		$this->db->join('ms_satuan', 'ms_satuan.id_satuan = ms_barang.id_satuan', 'left');
		$this->db->where('id_msk_kel',$id_msk_kel);
		$this->db->order_by('id_msk_kel', 'desc');
		$query = $this->db->get();
		return $query ->row_array();
	}

		public function detail_brg($id_barang,$id_satker,$id_msk_kel)
	{
		$this->db->select('brg_masuk_kel.*,ms_jenis_barang.nama_jenis,ms_satuan.satuan, satker.nama_satker, satker.id_satker, ms_barang.id_barang, ms_barang.nama_barang');
		$this->db->from('brg_masuk_kel');
		$this->db->join('ms_barang', 'ms_barang.id_barang = brg_masuk_kel.id_barang', 'left');
		$this->db->join('satker', 'satker.id_satker = brg_masuk_kel.id_satker', 'left');
		$this->db->join('ms_jenis_barang', 'ms_jenis_barang.id_jenis = brg_masuk_kel.id_jenis', 'left');
		$this->db->join('ms_satuan', 'ms_satuan.id_satuan = ms_barang.id_satuan', 'left');
		$this->db->where('brg_masuk_kel.id_barang',$id_barang);
		$this->db->where('brg_masuk_kel.id_satker',$id_satker);
		$this->db->where('brg_masuk_kel.id_msk_kel',$id_msk_kel);
		$this->db->order_by('id_msk_kel', 'desc');
		$query = $this->db->get();
		return $query ->row_array();
	}

	public function update($data)
	{
		$this->db->where('id_msk_kel',$data['id_msk_kel']);
		$this->db->update('brg_masuk_kel',$data);
	}

	public function get_jumlah_masuk($id_barang,$id_satker)
	{
		$this->db->select('SUM(jumlah) as total');
		$this->db->from('brg_masuk_kel');
		$this->db->where('id_barang',$id_barang);
		$this->db->where('id_satker',$id_satker);
		$query = $this->db->get();
		return $query->row_array();
	}

	

	public function delete($data)
	{
		$this->db->where('id_msk_kel', $data['id_msk_kel']);
		$this->db->delete('brg_masuk_kel',$data);
	}

	public function pencarian_hasil($tmt,$id_unit) {

		$this->db->select('brg_masuk_kel.*,rotasi.status,satker.id_jenis,rotasi.id_satker,status.status_pegawai,satker.nama_satker,libur.nama_pengganti,libur.tmt,libur.id_libur,libur.tanggal_pengajuan,jencuti.keterangan,libur.id_jencuti');
		$this->db->from('pegawai');
		$this->db->join('rotasi','rotasi.nip = pegawai.nip','LEFT');
		$this->db->join('satker','satker.id_satker = rotasi.id_satker','LEFT');
		$this->db->join('jenis','jenis.id_jenis = satker.id_jenis','LEFT');
		$this->db->join('status','status.id_status = pegawai.id_status','LEFT');
		$this->db->join('libur','libur.nip = pegawai.nip','LEFT');
		$this->db->join('jencuti','jencuti.id_jencuti = libur.id_jencuti','LEFT');
		$this->db->where(array('pegawai.pegawai_status'=> 'Aktif',
			'rotasi.status'=>'Aktif',
			'libur.tmt >=' => $tmt,
			'libur.tmt <=' => $sampai));
   // $this->db->group_by('pegawai.nip');
		$this->db->order_by('libur.tmt','asc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function get_jumlah_stok($id_satker,$id_barang,$tmt,$tmtdua)
	{
		$this->db->select('SUM(jumlah) as total');
		$this->db->from('brg_masuk_kel');
		$this->db->where('id_satker',$id_satker);
		$this->db->where('id_msk_kel',$id_barang);
		$this->db->where('tgl_datang >=',$tmt);
		$this->db->where('tgl_datang <=',$tmtdua);
		$query = $this->db->get();
		return $query->row_array();
	}

}


