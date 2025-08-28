<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai_barang_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->database();
    }
    public function get_aktif_only()
    {
        $query = $this->db->get('pegawai_barang');
        return $query->result_array();
    }

    public function detail($id_pegawai) {
     $query=$this->db->get_where('pegawai_barang',array('id_pegawai'=>$id_pegawai));
     return $query->row_array();
   }


    public function get_all()
    {
        $this->db->select('bk.id_barang_keluar, mb.nama_barang, p.nama_lengkap as nama_pegawai, 
                           bk.jumlah_keluar, bk.status_validasi, bk.tanggal_minta as tanggal_ambil');
        $this->db->from('barang_keluar bk');
        $this->db->join('ms_barang mb', 'bk.id_barang = mb.id_barang', 'left');
        $this->db->join('pegawai_barang p', 'bk.id_pegawai = p.id_pegawai', 'left');
        $this->db->order_by('bk.tanggal_minta', 'DESC');
        return $this->db->get()->result();
    }
}
