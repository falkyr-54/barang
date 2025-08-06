<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penempatan_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->database();
	}

	public function listing()
	{
		$this->db->select('penempatan.*, satker.nama_satker, satker.id_satker');
		$this->db->from('penempatan');
		$this->db->join('satker', 'satker.id_satker = penempatan.id_satker', 'right');
		// $this->db->group_by('penempatan.id_satker','ASC');
		$this->db->order_by('satker.id_satker', 'asc');
		$this->db->group_by('satker.id_satker','asc');
		$query = $this->db->get();
		return $query->result_array();
	}

	//hitung pc per unit
	public function hitungpc($id_unit) {
		$this->db->select('*');
		$this->db->from('penempatan');
		$this->db->where('id_unit', $id_unit);
		$this->db->where(array('id_jenis' => '2'));
		$this->db->order_by('id_jenis','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	//hitung printer per unit
	public function hitungprinter($id_unit) {
		$this->db->select('*');
		$this->db->from('penempatan');
		$this->db->where('id_unit', $id_unit);
		$this->db->where(array('id_jenis' => '1'));
		$this->db->order_by('id_jenis','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	//hitung pc per unit
	public function hitungpc_satker($id_satker)
	{
		$this->db->select('*');
		$this->db->from('penempatan');
		$this->db->where('id_satker',$id_satker);
		$this->db->where(array('id_jenis' => '2'));
		$this->db->order_by('id_jenis','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	//hitung printer per satker
	public function hitungprinter_satker($id_satker) {
		$this->db->select('*');
		$this->db->from('penempatan');
		$this->db->where('id_satker', $id_satker);
		$this->db->where(array('id_jenis' => '1'));
		$this->db->order_by('id_jenis','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}




	public function unit()
	{
		$this->db->select('penempatan.*, unit_bagian.unit, satker.id_satker, unit_bagian.id_unit');
		$this->db->from('penempatan');
		$this->db->join('satker', 'satker.id_satker = penempatan.id_satker', 'right');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = satker.id_satker', 'right');
		// $this->db->where('satker.id_satker', $id_satker);
		$this->db->order_by('unit_bagian.id_unit', 'asc');
		$this->db->group_by('unit_bagian.id_unit');
		$query = $this->db->get();
		return $query->result_array();
	}
	

	public function unit_brg($id_unit,$id_satker)
	{
		$this->db->select('penempatan.*,jenis_barang.nama_jenis,barang_keluar.id_barang,satker.nama_satker,unit_bagian.unit');
		$this->db->from('penempatan');
		$this->db->join('barang_keluar', 'barang_keluar.id_barang_keluar = penempatan.id_barang_keluar', 'left');
		$this->db->join('satker', 'satker.id_satker = penempatan.id_satker', 'left');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = penempatan.id_unit', 'left');
		$this->db->join('jenis_barang', 'jenis_barang.id_jenis = penempatan.id_jenis', 'left');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->where('unit_bagian.id_unit', $id_unit);
		$this->db->where('satker.id_satker', $id_satker);
		$this->db->where('status', "Aktif");
		$this->db->order_by('id_barang', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function tambah($data)
	{
		$this->db->insert('penempatan',$data);
	}
	public function ubah($data)
	{
		$this->db->where('id_tempat', $data['id_tempat']);
		$this->db->update('penempatan', $data);
	}

	public function detail($id_tempat) {
		$this->db->select('penempatan.*,jenis_barang.nama_jenis,ms_barang.merk,ms_barang.type,satker.nama_satker,unit_bagian.unit,ms_barang.id_barang');
		$this->db->from('penempatan');
		$this->db->join('jenis_barang', 'jenis_barang.id_jenis = penempatan.id_jenis', 'left');
		$this->db->join('barang_keluar', 'barang_keluar.id_barang_keluar = penempatan.id_barang_keluar', 'left');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = penempatan.id_unit', 'left');
		$this->db->join('satker', 'satker.id_satker = penempatan.id_satker', 'left');
		$this->db->where('id_tempat', $id_tempat);
		$this->db->order_by('id_tempat', 'asc');
		$query = $this->db->get();
		return $query->row_array();
	}

	public function detail_brg($id_barang_keluar) {
		$this->db->select('penempatan.*,jenis_barang.nama_jenis,ms_barang.merk,ms_barang.type,satker.nama_satker,unit_bagian.unit,ms_barang.id_barang');
		$this->db->from('penempatan');
		$this->db->join('jenis_barang', 'jenis_barang.id_jenis = penempatan.id_jenis', 'left');
		$this->db->join('barang_keluar', 'barang_keluar.id_barang_keluar = penempatan.id_barang_keluar', 'left');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = penempatan.id_unit', 'left');
		$this->db->join('satker', 'satker.id_satker = penempatan.id_satker', 'left');
		$this->db->where('penempatan.id_barang_keluar', $id_barang_keluar);
		$this->db->order_by('id_tempat', 'asc');
		$query = $this->db->get();
		return $query->row_array();
	}

	public function detail_barang($id_barang_keluar) {
		$this->db->select('penempatan.*,barang_keluar.id_barang,satker.nama_satker,unit_bagian.unit');
		$this->db->from('penempatan');
		$this->db->join('barang_keluar', 'barang_keluar.id_barang_keluar = penempatan.id_barang_keluar', 'left');
		$this->db->join('satker', 'satker.id_satker = penempatan.id_satker', 'left');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = penempatan.id_unit', 'left');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->where('barang_keluar.id_barang_keluar', $id_barang_keluar);
		$this->db->order_by('id_tempat', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}
	

	public function hapus($data)
	{
		$this->db->where('id_barang', $data['id_barang']);
		$this->db->delete('penempatan',$data);
	}

	// Login
	public function login($username,$password)
	{
		$this->db->select('*');
		$this->db->from('penempatan');
		// where
		$this->db->where(array(	'username'	=> $username,
			'password'	=> sha1($password)
		));
		$this->db->order_by('penempatan.id_barang', 'desc');
		$query = $this->db->get();
		return $query->row();
	}

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */