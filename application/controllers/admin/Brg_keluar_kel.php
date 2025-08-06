<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Brg_keluar_kel extends CI_Controller
{

  // Fungsi database
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Jenis_model');
    $this->load->model('Barang_model');
    $this->load->model('Satuan_model');
    $this->load->model('Rekanan_model');
    $this->load->model('Brg_keluarkel_model');
    	$this->load->model('Brg_keluar_model');
    $this->load->model('Brg_masukkel_model');
    $this->load->model('Unit_model');
    $this->load->model('Satker_model');
  }

  // Index
  public function index()
  {

    $barang_keluar  = $this->Brg_keluarkel_model->listing();

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
      'title'        => 'Data Barang Keluar',
      'barang_keluar'  => $barang_keluar,
      'hari'         => $dayList,
      'isi'          => 'admin/barang_keluar/list'
    );
    $this->load->view('admin/layout/wrapper', $data);
  }



  public function tambah()
  {

    $id_barang  = $this->uri->segment(4);
    $id_satker  = $this->uri->segment(5);
    $id_msk_kel = $this->uri->segment(6);
    $barang     = $this->Barang_model->detail($id_barang);
    $barang_jml = $this->Brg_masukkel_model->detail_brg($id_barang, $id_satker, $id_msk_kel);
    $satker     = $this->Satker_model->detail($id_satker);
    $jenis_brg  = $this->Jenis_model->listing();
    $satuan     = $this->Satuan_model->listing();
    $satker     = $this->Satker_model->listing();
    $unit       = $this->Unit_model->listing();
    $stok_id    = $this->Brg_keluarkel_model->get_total_id($id_barang, $id_msk_kel);
    $check      = $barang_jml['jumlah'] - $stok_id['total'];

    $expired6bln = $this->Brg_keluar_model->list_expired6bulan();
    $expired3bln = $this->Brg_keluar_model->list_expired3bulan();
    $expired1bln = $this->Brg_keluar_model->list_expired1bulan();

    // Validasi
    $valid = $this->form_validation;

    $valid->set_rules('jumlah_keluar', 'jumlah', 'required', array('required' => 'Jumlah Harus diisi'));

    $valid->set_rules('nama_barang', 'Nama Barang', 'required', array('required' => 'Nama Barang Harus diisi'));

    if ($valid->run() === FALSE) {

      $data = array(
        'title'        => 'Transaksi Barang Keluar',
        'satker'       => $satker,
        'barang'       => $barang,
        'unit'         => $unit,
        'check'        => $check,
        'id_satker'    => $id_satker,
        'expired6bulan' => $expired6bln,
        'expired3bulan' => $expired3bln,
        'expired1bulan' => $expired1bln,
        'id_msk_kel'    => $id_msk_kel,
        'id_barang'    => $id_barang,
        'isi'     => 'admin/barang_keluar/tambah'
      );
      $this->load->view('admin/layout/wrapper', $data);
    } else {

      // Masuk ke database
      $i  = $this->input;
      $data = array(
        'id_barang'         => $i->post('id_barang'),
        'id_msk_kel'        => $id_msk_kel,
        'id_pegawai'        => $i->post('id_pegawai'),
        'id_jenis'          => $i->post('id_jenis'),
        'tanggal_minta'     => $i->post('tanggal_minta'),
        'id_satker'         => $i->post('id_satker'),
        'id_unit'           => $i->post('id_unit'),
        'jumlah_keluar'     => $i->post('jumlah_keluar'),
        'keterangan'        => $i->post('keterangan'),
        'input_by'          => $this->session->userdata('username'),
        'tgl_input'        => date('Y-m-d H:i:s')
      );

      if ($i->post('jumlah_keluar') > $check) {
        $this->session->set_flashdata('sukses', 'STOK PERMINTAAN MELEBIHI STOK BARANG TERSEDIA');
        redirect(base_url('admin/Brg_keluar_kel/tambah/' . $id_barang . '/' . $id_satker . '/' . $id_msk_kel), 'refresh');
      } else {
        $this->Brg_keluarkel_model->tambah($data);
        $this->session->set_flashdata('sukses', 'Data berhasil simpan');
        redirect(base_url('admin/barang/riwayat_kel/' . $id_barang . '/' . $id_satker));
      }
    }
  }


  //FUNGSI EDIT
  public function edit($id_barang_keluar)
  {

    $brg              = $this->Brg_keluarkel_model->detail($id_barang_keluar);
    $program          = $this->program_model->listing();
    $id_barang_keluar = $brg['id_barang_keluar'];
    $satuan           = $this->Satuan_model->listing();
    $rekanan          = $this->Rekanan_model->listing();
    $satker           = $this->Satker_model->listing();
    $unit             = $this->Unit_model->listing();
    // print_r($diskusi);die;

    $data = array(
      'title'   => 'Edit Barang masuk',
      'brg'       => $brg,
      'rekanan'   => $rekanan,
      'satuan'    => $satuan,
      'satker'    => $satker,
      'unit'      => $unit,
      'isi'     => 'admin/barang_keluar/edit'
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
        'id_barang_keluar'      => $id_barang_keluar,
        'id_pegawai'        => $i->post('id_pegawai'),
        'jumlah_keluar'     => $i->post('jumlah_keluar'),
        'tanggal_minta'     => $i->post('tanggal_minta'),
        'id_satker'         => $i->post('id_satker'),
        'id_unit'           => $i->post('id_unit'),
        'jumlah_keluar'     => $i->post('jumlah_keluar'),
        'keterangan'        => $i->post('keterangan'),
        'edit_by'           => $this->session->userdata('username'),
        'tgl_edit'          => date('Y-m-d H:i:s')
      );
      $this->Brg_keluarkel_model->update($data);
      $this->session->set_flashdata('sukses', 'Data berhasil diubah');
      redirect(base_url('admin/barang/riwayat_kel/' . $brg['id_barang'] . '/' . $brg['id_satker']));
    }
  }


  public function getnip()
  {

    $nama = trim($this->input->get('term')); //get term parameter sent via text field. Not sure how secure get() is

    $this->db->select('id_pegawai, nama_lengkap, id_unit');
    $this->db->from('pegawai_barang');
    $this->db->like('nama_lengkap', $nama);
    $this->db->limit('5');
    $query = $this->db->get();

    // $this->db->where(array('j_kel'=>'perempuan'));
    if ($query->num_rows() > 0) {
      $data['response'] = 'true'; //If nik exists set true
      $data['message'] = array();

      foreach ($query->result() as $row) {

        $data['message'][] = array(
          'label'  => $row->nama_lengkap,
          'value'  => $row->id_pegawai,
          'unit'  => $row->id_unit,
        );
      }
    } else {
      $data['response'] = 'false'; //Set false if user not valid
    }

    echo json_encode($data);
  }

  // Hapus
  public function delete($id_luar_kel)
  {

    $id_barang = $this->uri->segment(5);
    $id_satker = $this->uri->segment(6);

    $data = array('id_luar_kel' => $id_luar_kel);
    $this->Brg_keluarkel_model->delete($data);
    $this->session->set_flashdata('sukses', 'Data barang masuk berhasil dihapus');
    redirect(base_url('admin/barang/riwayat_kel/' . $id_barang . '/' . $id_satker));
  }
}
