<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_model extends CI_Model {

	public function __construct() {
		$this->load->database();
	}	
	
	// Listing
	public function listing() {
		$this->db->select('*');
		$this->db->from('ms_barang');
		$this->db->order_by('id_barang','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

  public function list_kel()
  {
    $this->db->select('*');
    $this->db->from('satker');
    $this->db->order_by('id_satker','ASC');
    // $this->db->where('id_satker<>', 1);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function detail($id_barang)
  {
    $this->db->select('ms_barang.*,ms_jenis_barang.nama_jenis,ms_satuan.satuan');
    $this->db->from('ms_barang');
    $this->db->join('ms_jenis_barang', 'ms_jenis_barang.id_jenis = ms_barang.id_jenis', 'left');
    $this->db->join('ms_satuan', 'ms_satuan.id_satuan = ms_barang.id_satuan', 'left');
    $this->db->where('id_barang',$id_barang);
    $this->db->order_by('id_barang', 'desc');
    $query = $this->db->get();
    return $query ->row_array();
  }

  public function detail_kel($id_barang,$id_satker)
  {
    $this->db->select('ms_barang.*,ms_jenis_barang.nama_jenis,ms_satuan.satuan,barang_masuk.id_barang_masuk, satker.nama_satker, satker.id_satker, barang_masuk.jumlah');
    $this->db->from('ms_barang');
    $this->db->join('barang_masuk', 'barang_masuk.id_barang = ms_barang.id_barang', 'left');
    $this->db->join('satker', 'satker.id_satker = barang_masuk.id_satker', 'left');
    $this->db->join('ms_jenis_barang', 'ms_jenis_barang.id_jenis = ms_barang.id_jenis', 'left');
    $this->db->join('ms_satuan', 'ms_satuan.id_satuan = ms_barang.id_satuan', 'left');
    $this->db->where('ms_barang.id_barang',$id_barang);
    $this->db->order_by('id_barang', 'desc');
    $query = $this->db->get();
    return $query ->row_array();
  }

  


	//detail
	 // public function detail($id_barang) {
  //    $query=$this->db->get_where('ms_barang',array('id_barang'=>$id_barang));
  //    return $query->row_array();
  //  }

   //tambah
  public function tambah($data)
  {
    $this->db->insert('ms_barang',$data);
  }

   //edit
  public function edit($data)
  {
  	$this->db->where('id_barang',$data['id_barang']);
  	$this->db->update('ms_barang',$data);
  }

  //hapus
  public function delete($data)
  {
  	$this->db->where('id_barang',$data['id_barang']);
  	$this->db->delete('ms_barang',$data);
  }
}