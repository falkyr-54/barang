<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_unit extends CI_Controller
{

  // Fungsi database
  public function __construct()
  {
    parent::__construct();
    $this->load->model('barang_unit_model');
  }

  // Index
  public function index()
  {

    $id_unit = $this->session->userdata('id_unit');
    $keluar  = $this->barang_unit_model->list_brgku($id_unit);

    $data = array(
      'title'    => 'Data Barang Keluar',
      'keluar'   => $keluar,
      'isi'      => 'admin/barang_unit/list'
    );
    $this->load->view('admin/layout/wrapper', $data);
  }



  public function validasiku()
  
  {
    $id_satker     = $this->session->userdata('id_satker');
    $site   = $this->konfigurasi_model->listing();
    $tahun  = date('Y');
    $brg  = $this->dasbor_model->terbaru($tahun);
    $listing = $this->Brg_keluar_model->list_barang($id_satker);
    
    $data = array(
      'title'   => $site['namaweb'] . ' - ' . $site['tagline'],
      'tahun' => $tahun,
      'brg' => $brg,
      'listing' => $listing,
      'isi' => 'admin/dasbor/list'
    );
    $this->load->view('admin/layout/wrapper', $data);
  }
  

}
