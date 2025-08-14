<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Persediaan_model extends CI_Model {

	public function __construct() {
		$this->load->database();

	}	

	// Listing
	public function listing() {
		$this->db->select('*');
		$this->db->from('persediaan');
		$this->db->order_by('id_sedia','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function list_jenis() {
		$this->db->select('*');
		$this->db->from('ms_barang');
		$this->db->order_by('id_barang','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function list_msk() {
		$this->db->select('barang_masuk.*,ms_barang.nama_barang,ms_satuan.satuan,ms_rekanan.nama_rekanan,ms_barang.id_satuan');
		$this->db->from('barang_masuk');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_masuk.id_barang', 'left');
		$this->db->join('ms_rekanan', 'ms_rekanan.id_rekanan = barang_masuk.id_rekanan', 'left');
		$this->db->join('ms_satuan', 'ms_satuan.id_satuan = ms_barang.id_satuan', 'left');
		$this->db->order_by('id_barang_masuk','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function list_brg($id_barang)
	{
		$this->db->select('barang_masuk.*,ms_barang.nama_barang,ms_rekanan.nama_rekanan');
		$this->db->from('barang_masuk');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_masuk.id_barang', 'left');
		$this->db->join('ms_rekanan', 'ms_rekanan.id_rekanan = barang_masuk.id_rekanan', 'left');
		$this->db->where('ms_barang.id_barang', $id_barang);
		$this->db->order_by('id_barang_masuk', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function list_skrg($id_satker,$skrg)
	{
		$this->db->select('barang_masuk.*,ms_barang.nama_barang,ms_rekanan.nama_rekanan');
		$this->db->from('barang_masuk');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_masuk.id_barang', 'left');
		$this->db->join('ms_rekanan', 'ms_rekanan.id_rekanan = barang_masuk.id_rekanan', 'left');
		$this->db->where('barang_masuk.id_satker', $id_satker);
		$this->db->where('tgl_datang', $skrg);
		$this->db->order_by('id_barang_masuk', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}


	public function barang_masuk($id_rekanan)
	{
		$this->db->select('barang_masuk.*,ms_barang.nama_barang,ms_rekanan.nama_rekanan,ms_rekanan.alamat');
		$this->db->from('barang_masuk');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_masuk.id_barang', 'left');
		$this->db->join('ms_rekanan', 'ms_rekanan.id_rekanan = barang_masuk.id_rekanan', 'left');
		$this->db->where('ms_rekanan.id_rekanan', $id_rekanan);
		$this->db->order_by('id_barang_masuk', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function tambah($data)
	{
		$this->db->insert('barang_masuk',$data);
	}

	public function detail($id_barang_masuk)
	{
		$this->db->select('barang_masuk.*,ms_barang.nama_barang,ms_satuan.satuan');
		$this->db->from('barang_masuk');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_masuk.id_barang', 'left');
		$this->db->join('ms_satuan', 'ms_satuan.id_satuan = ms_barang.id_satuan', 'left');
		$this->db->where('id_barang_masuk',$id_barang_masuk);
		$this->db->order_by('id_barang_masuk', 'asc');
		$query = $this->db->get();
		return $query ->row_array();
	}
	
	public function detail_brg($id_barang,$id_barang_masuk)
	{
		$this->db->select('barang_masuk.*,ms_jenis_barang.nama_jenis,ms_satuan.satuan, satker.nama_satker, satker.id_satker, ms_barang.id_barang, ms_barang.nama_barang');
		$this->db->from('barang_masuk');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_masuk.id_barang', 'left');
		$this->db->join('satker', 'satker.id_satker = barang_masuk.id_satker', 'left');
		$this->db->join('ms_jenis_barang', 'ms_jenis_barang.id_jenis = barang_masuk.id_jenis', 'left');
		$this->db->join('ms_satuan', 'ms_satuan.id_satuan = ms_barang.id_satuan', 'left');
		$this->db->where('barang_masuk.id_barang',$id_barang);
		// $this->db->where('barang_masuk.id_satker',$id_satker);
		$this->db->where('barang_masuk.id_barang_masuk',$id_barang_masuk);
		$this->db->order_by('id_barang_masuk', 'desc');
		$query = $this->db->get();
		return $query ->row_array();
	}

	public function masuk_ini($satker)
	{	
		$tgl_masuk = date('Y-m-d');

		$this->db->select('*');
		$this->db->from('barang_masuk');
		$this->db->where('id_satker',$satker);
		$this->db->where('tgl_datang',$tgl_masuk);
		$query = $this->db->get();
		return $query->result_array();
	}


	public function keluar_ini($satker)
	{	
		$tgl_minta = date('Y-m-d');

		$this->db->select('*');
		$this->db->from('barang_keluar');
		$this->db->where('id_satker',$satker);
		$this->db->where('tanggal_minta',$tgl_minta);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function update($data)
	{
		$this->db->where('id_barang_masuk',$data['id_barang_masuk']);
		$this->db->update('barang_masuk',$data);
	}



	public function cari_brg_masuk($tmt,$tmtdua,$id_jenis)
	{
		$this->db->select('barang_masuk.*,ms_barang.nama_barang,ms_satuan.satuan,ms_jenis_barang.nama_jenis,ms_barang.id_barang');
		$this->db->from('barang_masuk');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_masuk.id_barang', 'left');
		$this->db->join('ms_satuan', 'ms_satuan.id_satuan = ms_barang.id_satuan', 'left');
		$this->db->join('ms_jenis_barang', 'ms_jenis_barang.id_jenis = ms_barang.id_jenis', 'left');
		$this->db->where('tgl_datang >=',$tmt);
		$this->db->where('tgl_datang <=',$tmtdua);
		$this->db->where('ms_barang.id_jenis',$id_jenis);
		$this->db->order_by('nama_barang', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function pencarian_hasil($tmt,$tmtdua) {

		$this->db->select('barang_masuk.*,ms_barang.nama_barang,ms_rekanan.nama_rekanan,ms_satuan.satuan,ms_jenis_barang.nama_jenis,ms_barang.id_barang');
		$this->db->from('barang_masuk');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_masuk.id_barang', 'left');
		$this->db->join('ms_satuan', 'ms_satuan.id_satuan = ms_barang.id_satuan', 'left');
		$this->db->join('ms_rekanan', 'ms_rekanan.id_rekanan = barang_masuk.id_rekanan', 'left');
		$this->db->join('ms_jenis_barang', 'ms_jenis_barang.id_jenis = ms_barang.id_jenis', 'left');
		$this->db->where(array(
			'barang_masuk.tgl_datang >=' => $tmt,
			'barang_masuk.tgl_datang <=' => $tmtdua));
		$this->db->order_by('tgl_datang','asc');
		$query = $this->db->get();
		return $query->result_array();
	}




	public function get_jumlah_masuk($id_barang)
	{
		$this->db->select('SUM(jumlah) as total');
		$this->db->from('barang_masuk');
		$this->db->where('id_barang',$id_barang);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_jumlah_msk($id_barang)
	{
		$this->db->select('SUM(jumlah) as total');
		$this->db->from('barang_masuk');
		$this->db->where('id_barang_masuk',$id_barang);
		$query = $this->db->get();
		return $query->row_array();
	}


	

	public function get_harga_sedia($tmt,$tmtdua,$id_sedia)
	{
		$this->db->select('barang_masuk.*,SUM(harga) as total,ms_jenis_barang.id_sedia,ms_barang.id_jenis');
		$this->db->from('barang_masuk');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_masuk.id_barang', 'left');
		$this->db->join('ms_jenis_barang', 'ms_jenis_barang.id_jenis = ms_barang.id_jenis', 'left');
		$this->db->join('persediaan', 'persediaan.id_sedia = ms_jenis_barang.id_sedia', 'left');
		$this->db->where('ms_jenis_barang.id_sedia',$id_sedia);
		$this->db->where('tgl_datang >=',$tmt);
		$this->db->where('tgl_datang <=',$tmtdua);
		$query = $this->db->get();
		return $query->row_array();
	}


	public function get_jumlah_sedia($tmtdua,$id_barang_masuk,$id_sedia)
	{
		$this->db->select('barang_masuk.*,SUM(jumlah) as total,ms_jenis_barang.id_sedia,ms_barang.id_jenis');
		$this->db->from('barang_masuk');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_masuk.id_barang', 'left');
		$this->db->join('ms_jenis_barang', 'ms_jenis_barang.id_jenis = ms_barang.id_jenis', 'left');
		$this->db->join('persediaan', 'persediaan.id_sedia = ms_jenis_barang.id_sedia', 'left');
		$this->db->where('ms_jenis_barang.id_sedia',$id_sedia);
		$this->db->where('barang_masuk.id_barang_masuk',$id_barang_masuk);
		// $this->db->where('tgl_datang >=',$tmt);
		$this->db->where('tgl_datang <=',$tmtdua);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_jml_keluar($tmtdua,$id_barang_masuk,$id_sedia)
	{
		$this->db->select('barang_keluar.*,SUM(jumlah_keluar) as total,ms_jenis_barang.id_sedia,ms_barang.id_jenis');
		$this->db->from('barang_keluar');
		$this->db->join('barang_masuk', 'barang_masuk.id_barang_masuk = barang_keluar.id_barang_masuk', 'left');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->join('ms_jenis_barang', 'ms_jenis_barang.id_jenis = ms_barang.id_jenis', 'left');
		$this->db->join('persediaan', 'persediaan.id_sedia = ms_jenis_barang.id_sedia', 'left');
		$this->db->where('ms_jenis_barang.id_sedia',$id_sedia);
		$this->db->where('barang_keluar.id_barang_masuk',$id_barang_masuk);
		// $this->db->where('tanggal_minta >=',$tmt);
		$this->db->where('tanggal_minta <=',$tmtdua);
		$query = $this->db->get();
		return $query->row_array();
	}



	public function get_sedia($tmt,$tmtdua,$id_barang_masuk,$id_sedia)
	{
		$this->db->select('barang_masuk.*,SUM(jumlah) as total,ms_jenis_barang.id_sedia,ms_barang.id_jenis');
		$this->db->from('barang_masuk');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_masuk.id_barang', 'left');
		$this->db->join('ms_jenis_barang', 'ms_jenis_barang.id_jenis = ms_barang.id_jenis', 'left');
		$this->db->join('persediaan', 'persediaan.id_sedia = ms_jenis_barang.id_sedia', 'left');
		$this->db->where('ms_jenis_barang.id_sedia',$id_sedia);
		$this->db->where('barang_masuk.id_barang_masuk',$id_barang_masuk);
		// $this->db->where('tgl_datang >=',$tmt);
		$this->db->where('tgl_datang <=',$tmtdua);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_keluar($tmt,$tmtdua,$id_barang_masuk,$id_sedia)
	{
		$this->db->select('barang_keluar.*,SUM(jumlah_keluar) as total,ms_jenis_barang.id_sedia,ms_barang.id_jenis');
		$this->db->from('barang_keluar');
		$this->db->join('barang_masuk', 'barang_masuk.id_barang_masuk = barang_keluar.id_barang_masuk', 'left');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->join('ms_jenis_barang', 'ms_jenis_barang.id_jenis = ms_barang.id_jenis', 'left');
		$this->db->join('persediaan', 'persediaan.id_sedia = ms_jenis_barang.id_sedia', 'left');
		$this->db->where('ms_jenis_barang.id_sedia',$id_sedia);
		$this->db->where('barang_keluar.id_barang_masuk',$id_barang_masuk);
		// $this->db->where('tanggal_minta >=',$tmt);
		$this->db->where('tanggal_minta <=',$tmtdua);
		$query = $this->db->get();
		return $query->row_array();
	}


	public function get_hrg_sedia($tmtdua,$id_barang,$id_sedia)
	{
		$this->db->select('barang_masuk.*,SUM(harga) as total,ms_jenis_barang.id_sedia,ms_barang.id_jenis');
		$this->db->from('barang_masuk');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_masuk.id_barang', 'left');
		$this->db->join('ms_jenis_barang', 'ms_jenis_barang.id_jenis = ms_barang.id_jenis', 'left');
		$this->db->join('persediaan', 'persediaan.id_sedia = ms_jenis_barang.id_sedia', 'left');
		$this->db->where('ms_jenis_barang.id_sedia',$id_sedia);
		$this->db->where('ms_barang.id_barang',$id_barang);
		// $this->db->where('tgl_datang >=',$tmt);
		$this->db->where('tgl_datang <=',$tmtdua);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function get_hrg_keluar($tmtdua,$id_barang,$id_sedia)
	{
		$this->db->select('barang_keluar.*,SUM(jumlah_keluar) as total,ms_jenis_barang.id_sedia,ms_barang.id_jenis');
		$this->db->from('barang_keluar');
		$this->db->join('barang_masuk', 'barang_masuk.id_barang_masuk = barang_keluar.id_barang_masuk', 'left');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->join('ms_jenis_barang', 'ms_jenis_barang.id_jenis = ms_barang.id_jenis', 'left');
		$this->db->join('persediaan', 'persediaan.id_sedia = ms_jenis_barang.id_sedia', 'left');
		$this->db->where('ms_jenis_barang.id_sedia',$id_sedia);
		$this->db->where('ms_barang.id_barang',$id_barang);
		// $this->db->where('tanggal_minta >=',$tmt);
		$this->db->where('tanggal_minta <=',$tmtdua);
		$query = $this->db->get();
		return $query->row_array();
	}


	public function get_harga_keluar($tmt,$tmtdua,$id_sedia)
	{
		$this->db->select('barang_keluar.*,SUM(harga) as total,ms_jenis_barang.id_sedia,ms_barang.id_jenis');
		$this->db->from('barang_keluar');
		$this->db->join('barang_masuk', 'barang_masuk.id_barang_masuk = barang_keluar.id_barang_masuk', 'left');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->join('ms_jenis_barang', 'ms_jenis_barang.id_jenis = ms_barang.id_jenis', 'left');
		$this->db->join('persediaan', 'persediaan.id_sedia = ms_jenis_barang.id_sedia', 'left');
		$this->db->where('ms_jenis_barang.id_sedia',$id_sedia);
		$this->db->where('tanggal_minta >=',$tmt);
		$this->db->where('tanggal_minta <=',$tmtdua);
		$query = $this->db->get();
		return $query->row_array();
	}


	public function list_sedia($tmt,$tmtdua,$id_sedia)
	{
		$this->db->select('barang_masuk.*,ms_jenis_barang.id_sedia,ms_barang.id_jenis,ms_barang.nama_barang');
		$this->db->from('barang_masuk');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_masuk.id_barang', 'left');
		$this->db->join('ms_jenis_barang', 'ms_jenis_barang.id_jenis = ms_barang.id_jenis', 'left');
		$this->db->join('persediaan', 'persediaan.id_sedia = ms_jenis_barang.id_sedia', 'left');
		$this->db->where('ms_jenis_barang.id_sedia',$id_sedia);
		$this->db->where('tgl_datang >=',$tmt);
		$this->db->where('tgl_datang <=',$tmtdua);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function list_luar($tmt,$tmtdua,$id_sedia)
	{
		$this->db->select('barang_keluar.*,ms_jenis_barang.id_sedia,ms_barang.id_jenis,ms_barang.nama_barang,barang_masuk.harga,barang_masuk.jumlah');
		$this->db->from('barang_keluar');
		$this->db->join('barang_masuk', 'barang_masuk.id_barang_masuk = barang_keluar.id_barang_masuk', 'left');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_masuk.id_barang', 'left');
		$this->db->join('ms_jenis_barang', 'ms_jenis_barang.id_jenis = ms_barang.id_jenis', 'left');
		$this->db->join('persediaan', 'persediaan.id_sedia = ms_jenis_barang.id_sedia', 'left');
		$this->db->where('ms_jenis_barang.id_sedia',$id_sedia);
		$this->db->where('tanggal_minta >=',$tmt);
		$this->db->where('tanggal_minta <=',$tmtdua);
		$query = $this->db->get();
		return $query->result_array();
	}





	public function delete($data)
	{
		$this->db->where('id_barang_masuk', $data['id_barang_masuk']);
		$this->db->delete('barang_masuk',$data);
	}

	

}


