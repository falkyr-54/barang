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
}
