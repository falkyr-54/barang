<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Brg_masuk_kel extends CI_Controller
{

  // Fungsi database
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Jenis_model');
    $this->load->model('Barang_model');
    $this->load->model('Satuan_model');
    $this->load->model('Rekanan_model');
    $this->load->model('Satker_model');
    $this->load->model('Brg_masukkel_model');
    $this->load->model('Brg_keluar_model');
    $this->load->model('Unit_model');
  }

  // Index
  public function index()
  {

    $barang_masuk  = $this->Brg_masukkel_model->listing();

    $dayList = array(
      'Sun' => 'Minggu',
      'Mon' => 'Senin',
      'Tue' => 'Selasa',
      'Wed' => 'Rabu',
      'Thu' => 'Kamis',
      'Fri' => 'Jumat',
      'Sat' => 'Sabtu'
    );

    $data = array(
      'title'      => 'Data Barang Masuk',
      'barang_masuk'  => $barang_masuk,
      'hari'    => $dayList,
      'isi'    => 'admin/barang_masuk/list'
    );
    $this->load->view('admin/layout/wrapper', $data);
  }



  public function tambah()
  {

    $id_barang  = $this->uri->segment(4);
    $id_satker  = $this->uri->segment(5);
    $barang     = $this->Barang_model->detail_kel($id_barang, $id_satker);
    $satker     = $this->Satker_model->detail($id_satker);
    $jenis_brg  = $this->Jenis_model->listing();
    $satuan     = $this->Satuan_model->listing();
    $rekanan    = $this->Rekanan_model->listing();

    $expired6bln = $this->Brg_keluar_model->list_expired6bulan();
    $expired3bln = $this->Brg_keluar_model->list_expired3bulan();
    $expired1bln = $this->Brg_keluar_model->list_expired1bulan();
    // Validasi
    $valid = $this->form_validation;

    $valid->set_rules('jumlah', 'jumlah', 'required', array('required' => 'Jumlah Harus diisi'));

    $valid->set_rules('nama_barang', 'Nama Barang', 'required', array('required' => 'Nama Barang Harus diisi'));

    if ($valid->run() === FALSE) {

      $data = array(
        'title'   => 'Tambahkan Data Barang Masuk' . ' ' . $satker['nama_satker'],
        'rekanan' => $rekanan,
        'barang'  => $barang,
        'expired6bulan' => $expired6bln,
        'expired3bulan' => $expired3bln,
        'expired1bulan' => $expired1bln,
        'id_satker'  => $id_satker,
        'isi'     => 'admin/barang_masuk/tambahcoba'
      );
      $this->load->view('admin/layout/wrapper', $data);
    } else {

      // Masuk ke database
      if ($this->session->userdata('level') == "admin") {

        $i  = $this->input;
        $data = array(
          'id_barang'         => $i->post('id_barang'),
          'id_rekanan'        => $i->post('id_rekanan'),
          'id_jenis'          => $i->post('id_jenis'),
          'id_satker'         => $id_satker,
          'tgl_datang'        => $i->post('tgl_datang'),
          'jumlah'            => $i->post('jumlah'),
          'harga'             => $i->post('harga'),
          'spesifikasi'       => $i->post('spesifikasi'),
          'tahun_pengadaan'   => $i->post('tahun_pengadaan'),
          'input_by'          => $this->session->userdata('username'),
          'tgl_input'         => date('Y-m-d H:i:s')
        );
      } else {
        $i  = $this->input;
        $data = array(
          'id_barang'         => $i->post('id_barang'),
          'id_rekanan'        => 6,
          'id_jenis'          => $i->post('id_jenis'),
          'id_satker'         => $id_satker,
          'tgl_datang'        => $i->post('tgl_datang'),
          'jumlah'            => $i->post('jumlah'),
          'harga'             => $i->post('harga'),
          'spesifikasi'       => $i->post('spesifikasi'),
          'tahun_pengadaan'   => $i->post('tahun_pengadaan'),
          'input_by'          => $this->session->userdata('username'),
          'tgl_input'         => date('Y-m-d H:i:s')
        );
      }
      $this->Brg_masukkel_model->tambah($data);
      $this->session->set_flashdata('sukses', 'Data berhasil simpan');
      // redirect(base_url('admin/barang/riwayat_kel/'.$id_barang.'/'.$id_satker));
      redirect(base_url('admin/barang/list_today/' . $id_satker));
    }
  }

  public function kirim($id_barang_keluar, $id_satker)
  {

    $id_rekanan       = $this->session->userdata('id_satker');
    $id_satker        = $this->uri->segment(5);
    $brg              = $this->Brg_keluar_model->detail($id_barang_keluar);
    $program          = $this->program_model->listing();
    $id_barang_keluar = $brg['id_barang_keluar'];
    $satuan           = $this->Satuan_model->listing();
    $rekanan          = $this->Rekanan_model->detail($id_rekanan);
    $satker           = $this->Satker_model->listing();
    $unit             = $this->Unit_model->listing();
    $expired6bln = $this->Brg_keluar_model->list_expired6bulan();
    $expired3bln = $this->Brg_keluar_model->list_expired3bulan();
    $expired1bln = $this->Brg_keluar_model->list_expired1bulan();

    // print_r($diskusi);die;

    $data = array(
      'title'   => 'Tambahkan Data Barang Masuk',
      'brg'       => $brg,
      'satuan'    => $satuan,
      'satker'    => $satker,
      'unit'      => $unit,
      'rekanan'   => $rekanan,
      'expired6bulan' => $expired6bln,
      'expired3bulan' => $expired3bln,
      'expired1bulan' => $expired1bln,
      'id_satker' => $id_satker,
      'id_rekanan' => $id_rekanan,
      'isi'       => 'admin/barang_masuk/tambahkirim'
    );
    $this->load->view('admin/layout/wrapper', $data);

    $valid = $this->form_validation;

    $valid->set_rules(
      'nama_barang',
      'Nama Barang',
      'required',
      array('required'    => 'Nama Barang harus diisi')
    );

    if ($valid->run()) {


      $i  = $this->input;
      $data = array(
        'id_barang_keluar'  => $id_barang_keluar,
        'id_satker'         => $id_satker,
        'id_barang'         => $i->post('id_barang'),
        'id_jenis'          => $i->post('id_jenis'),
        'id_rekanan'        => $i->post('id_rekanan'),
        'jumlah'            => $i->post('jumlah'),
        'harga'             => $i->post('harga'),
        'tahun_pengadaan'   => $i->post('tahun_pengadaan'),
        'tgl_datang'        => $i->post('tgl_datang'),
        'spesifikasi'       => $i->post('spesifikasi'),
        'input_by'          => $this->session->userdata('username'),
        'tgl_input'         => date('Y-m-d H:i:s'),
        'edit_by'           => $this->session->userdata('username'),
        'tgl_edit'          => date('Y-m-d H:i:s')
      );
      $this->Brg_masukkel_model->tambah($data);
      $this->session->set_flashdata('sukses', 'Data berhasil terkirim');
      redirect(base_url('admin/barang/riwayat_kel/' . $brg['id_barang'] . '/' . $id_satker));
    }
  }



  //FUNGSI EDIT
  public function edit($id_barang_masuk)
  {

    $brg              = $this->Brg_masukkel_model->detail($id_barang_masuk);
    $id_barang_masuk = $brg['id_barang_masuk'];
    $satuan           = $this->Satuan_model->listing();
    $rekanan          = $this->Rekanan_model->listing();
    // print_r($diskusi);die;

    $data = array(
      'title'    => 'Edit Barang Masuk',
      'brg'        => $brg,
      'rekanan'   => $rekanan,
      'satuan'    => $satuan,
      'isi'      => 'admin/barang_masuk/edit'
    );
    $this->load->view('admin/layout/wrapper', $data);

    $valid = $this->form_validation;

    $valid->set_rules(
      'nama_barang',
      'Nama Barang',
      'required',
      array('required'    => 'Nama Barang harus diisi')
    );

    if ($valid->run()) {

      if ($this->session->userdata('level') == "admin") {
        $i   = $this->input;
        $data = array(
          'id_barang_masuk'      => $id_barang_masuk,
          'id_barang'       => $i->post('id_barang'),
          'id_rekanan'       => $i->post('id_rekanan'),
          'jumlah'           => $i->post('jumlah'),
          'harga'           => $i->post('harga'),
          'tahun_pengadaan' => $i->post('tahun_pengadaan'),
          'tgl_datang'       => $i->post('tgl_datang'),
          'spesifikasi'     => $i->post('spesifikasi'),
          'edit_by'         => $this->session->userdata('username'),
          'tgl_edit'        => date('Y-m-d H:i:s')
        );
      } else {
        $i  = $this->input;
        $data = array(
          'id_barang_masuk'     => $id_barang_masuk,
          'id_barang'       => $i->post('id_barang'),
          'jumlah'          => $i->post('jumlah'),
          'harga'           => $i->post('harga'),
          'tahun_pengadaan' => $i->post('tahun_pengadaan'),
          'tgl_datang'      => $i->post('tgl_datang'),
          'spesifikasi'     => $i->post('spesifikasi'),
          'edit_by'         => $this->session->userdata('username'),
          'tgl_edit'        => date('Y-m-d H:i:s')
        );
      }

      $this->Brg_masukkel_model->update($data);
      $this->session->set_flashdata('sukses', 'Data berhasil diubah');
      redirect(base_url('admin/barang/list_today/' . $id_satker));
      // redirect(base_url('admin/barang/riwayat_kel/'.$brg['id_barang'].'/'.$brg['id_satker']));
    }
  }


  // Hapus
  public function delete($id_barang_masuk)
  {

    $data = array('id_barang_masuk'  => $id_barang_masuk);
    $this->Brg_masukkel_model->delete($data);
    $this->session->set_flashdata('sukses', 'Data barang masuk berhasil dihapus');
    redirect(base_url('admin/brg_masuk/'));
  }
}
