<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{

  public function __construct()
  {
    $this->load->database();
  }


  public function detail()
  {
    $this->db->select('ms_barang.*,ms_jenis_barang.nama_jenis,ms_satuan.satuan');
    $this->db->from('ms_barang');
    $this->db->join('ms_jenis_barang', 'ms_jenis_barang.id_jenis = ms_barang.id_jenis', 'left');
    $this->db->join('ms_satuan', 'ms_satuan.id_satuan = ms_barang.id_satuan', 'left');
    $this->db->where('id_barang', 1);
    $this->db->order_by('id_barang', 'desc');
    $query = $this->db->get();
    return $query->row_array();
  }

  public function list_brg_masuk($id_barang, $id_barang_masuk)
  {
    $this->db->select('barang_masuk.*,ms_barang.nama_barang,ms_rekanan.nama_rekanan,ms_satuan.satuan,ms_barang.id_satuan');
    $this->db->from('barang_masuk');
    $this->db->join('ms_barang', 'ms_barang.id_barang = barang_masuk.id_barang', 'right');
    $this->db->join('ms_rekanan', 'ms_rekanan.id_rekanan = barang_masuk.id_rekanan', 'left');
    $this->db->join('ms_satuan', 'ms_satuan.id_satuan = ms_barang.id_satuan', 'left');
    $this->db->where('ms_barang.id_barang', $id_barang);
    $this->db->where('id_barang_masuk ', $id_barang_masuk);
    $this->db->order_by('ms_barang.id_barang', 'ASC');
    $query = $this->db->get();
    return $query->row_array();
  }

  public function list_brg_ada($id_jenis)
  {
    $this->db->select('ms_barang.*,barang_masuk.harga,ms_satuan.satuan,barang_masuk.id_satker,barang_masuk.id_barang_masuk');
    $this->db->from('ms_barang');
    $this->db->join('barang_masuk', 'barang_masuk.id_barang = ms_barang.id_barang', 'left');
    $this->db->join('ms_satuan', 'ms_satuan.id_satuan = ms_barang.id_satuan', 'left');
    $this->db->join('satker', 'satker.id_satker = barang_masuk.id_satker', 'left');
    $this->db->where('ms_barang.id_jenis', $id_jenis);
    $this->db->order_by('ms_barang.id_barang', 'asc');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function get_jumlah_keluar($id_barang)
  {
    $this->db->select('SUM(jumlah_keluar) as total');
    $this->db->from('barang_keluar');
    $this->db->where('id_barang', $id_barang);
    // $this->db->where('id_satker ',$id_satker);
    $query = $this->db->get();
    return $query->row_array();
  }

  public function get_jumlah_masuk($id_barang)
  {
    $this->db->select('SUM(jumlah) as total');
    $this->db->from('barang_masuk');
    $this->db->where('id_barang', $id_barang);
    // $this->db->where('id_satker',$id_satker);
    $query = $this->db->get();
    return $query->row_array();
  }

  // public function get_jumlah_stok_per_bulan($id_barang, $start_date, $end_date)
  // {
  //   if (empty($id_barang) || empty($start_date) || empty($end_date)) {
  //     return array('total' => 0);
  //   }

  //   $this->db->select_sum('jumlah', 'total');
  //   $this->db->from('barang_keluar');
  //   $this->db->where('id_barang_masuk', $id_barang);
  //   $this->db->where('tanggal_keluar >=', $start_date);
  //   $this->db->where('tanggal_keluar <=', $end_date);
  //   $query = $this->db->get();

  //   $result = $query->row_array();
  //   return $result ? $result : array('total' => 0);
  // }
}
