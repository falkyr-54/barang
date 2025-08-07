<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Brg_masuk extends CI_Controller
{

  // Fungsi database
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Jenis_model');
    $this->load->model('Barang_model');
    $this->load->model('Satuan_model');
    $this->load->model('Rekanan_model');
    $this->load->model('Brg_keluar_model');
    $this->load->model('Brg_masuk_model');
  }

  // Index
  public function index()
  {

    $barang_masuk  = $this->Brg_masuk_model->listing();

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


  public function get_data_barang()
  {
    $nama = trim($this->input->get('term'));
    // variable lain bisa dipake dari view yang diset
    // $datalain = $this-&gt;input-&gt;get('datalain');

    // load data ke model
    $data_barang = $this->Brg_masuk_model()->get_sparepart_by($term, 'id_barang,kode_barang,nama_barang');

    // keluarkan dalam bentuk json
    echo json_encode($data_barang);
  }


  public function tambah()
  {

    $id_barang  = $this->uri->segment(4);
    $id_satker  = $this->session->userdata('id_satker');;
    $barang     = $this->Barang_model->detail($id_barang);
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

    if ($valid->run()) {
      if (!empty($_FILES['gambar']['name'])) {

        $config['upload_path']    = './assets/upload/image/';
        $config['allowed_types']  = 'gif|jpg|png|jpeg';
        $config['max_size']     = '2000'; // KB  atau 2MB   
        $this->load->library('upload', $config);
        if (! $this->upload->do_upload('gambar')) {
          // End validasi
          $data = array(
            'title'      => 'Transaksi masuk',
            'rekanan'    => $rekanan,
            'barang'     => $barang,
            'id_satker'  => $id_satker,
            'error'      => $this->upload->display_errors(),
            'isi'        => 'admin/barang_masuk/tambahcoba'
          );

          $this->load->view('admin/layout/wrapper', $data);
        } else {
          $upload_data        = array('uploads' => $this->upload->data());

          // Image Editor
          $config['image_library']  = 'gd2';
          $config['source_image']   = './assets/upload/image/' . $upload_data['uploads']['file_name'];
          $config['new_image']      = './assets/upload/image/thumbs/';
          $config['create_thumb']   = TRUE;
          $config['maintain_ratio'] = TRUE;
          $config['width']          = 150; // Pixel
          $config['height']         = 150; // Pixel
          $config['thumb_marker']   = '';
          $this->load->library('image_lib', $config);
          $this->image_lib->resize();

          // Masuk ke database
          $i  = $this->input;

          $data = array(
            'id_satker'         => $id_satker,
            'id_barang'         => $i->post('id_barang'),
            'id_rekanan'        => $i->post('id_rekanan'),
            'tahun_pengadaan'   => $i->post('tahun_pengadaan'),
            'tgl_datang'        => $i->post('tgl_datang'),
            'no_sp'            => $i->post('no_sp'),
            'id_paket_ekatalog' => $i->post('id_paket_ekatalog'),
            'ed_barang'         => $i->post('ed_barang'),
            'no_bacth'          => $i->post('no_bast'),
            'jenis_pemesanan' => $i->post('jenis_pemesanan'),
            'metode_pengadaan' => $i->post('metode_pengadaan'),
            'tgl_sip'           => $i->post('tgl_sip'),
            'nilai_pesanan' => $i->post('nilai_pesanan'),
            'no_bacth_lot_barang' => $i->post('no_batch'),
            'status_pesanaan' => $i->post('status_pesanan'),
            'jumlah'            => $i->post('jumlah'),
            'harga'             => $i->post('harga'),
            'harga_satuan'      => $i->post('harga'),
            'tgl_bacth_barang_datang' => $i->post('tgl_datang'),
            'spesifikasi'       => $i->post('spesifikasi'),
            'tkdn'              => $i->post('tkdn'),
            'sumber'            => $i->post('sumber'),
            'gambar'            => $upload_data['uploads']['file_name'],
            'input_by'          => $this->session->userdata('username'),
            'tgl_input'         => date('Y-m-d H:i:s')
          );
          $this->Brg_masuk_model->tambah($data);
          $this->session->set_flashdata('sukses', 'Data berhasil simpan');
          redirect(base_url('admin/barang/riwayat/' . $id_barang));
        }
      } else {
        $i  = $this->input;
        $data = array(
          'id_satker'         => $id_satker,
          'id_barang'         => $i->post('id_barang'),
          'id_rekanan'        => $i->post('id_rekanan'),
          'tahun_pengadaan'   => $i->post('tahun_pengadaan'),
          'tgl_datang'        => $i->post('tgl_datang'),
          'no_sp'            => $i->post('no_sp'),
          'id_paket_ekatalog' => $i->post('id_paket_ekatalog'),
          'ed_barang'         => $i->post('ed_barang'),
          'no_bacth'          => $i->post('no_bast'),
          'jenis_pemesanan' => $i->post('jenis_pemesanan'),
          'metode_pengadaan' => $i->post('metode_pengadaan'),
          'tgl_sip'           => $i->post('tgl_sip'),
          'nilai_pesanan' => $i->post('nilai_pesanan'),
          'no_bacth_lot_barang' => $i->post('no_batch'),
          'status_pesanaan' => $i->post('status_pesanan'),
          'jumlah'            => $i->post('jumlah'),
          'harga'             => $i->post('harga'),
          'harga_satuan'      => $i->post('harga'),
          'tgl_bacth_barang_datang' => $i->post('tgl_datang'),
          'spesifikasi'       => $i->post('spesifikasi'),
          'tkdn'              => $i->post('tkdn'),
          'sumber'            => $i->post('sumber'),
          'gambar'            => $upload_data['uploads']['file_name'],
          'input_by'          => $this->session->userdata('username'),
          'tgl_input'         => date('Y-m-d H:i:s')
        );
        $this->Brg_masuk_model->tambah($data);
        $this->session->set_flashdata('sukses', 'Data berhasil simpan');
        redirect(base_url('admin/barang/riwayat/' . $id_barang));
      }
    }
    // End masuk database
    $data = array(
      'title'      => 'Transaksi masuk',
      'rekanan'    => $rekanan,
      'barang'     => $barang,
      'expired6bulan' => $expired6bln,
      'expired3bulan' => $expired3bln,
      'expired1bulan' => $expired1bln,
      'id_satker'  => $id_satker,
      'isi'        => 'admin/barang_masuk/tambahcoba'
    );
    $this->load->view('admin/layout/wrapper', $data);
  }




  //FUNGSI EDIT
  public function edit($id_barang_masuk)
  {

    $brg              = $this->Brg_masuk_model->detail($id_barang_masuk);
    $id_barang_masuk  = $brg['id_barang_masuk'];
    $satuan           = $this->Satuan_model->listing();
    $rekanan          = $this->Rekanan_model->listing();
    $expired6bln = $this->Brg_keluar_model->list_expired6bulan();
    $expired3bln = $this->Brg_keluar_model->list_expired3bulan();
    $expired1bln = $this->Brg_keluar_model->list_expired1bulan();
    // print_r($diskusi);die;

    $data = array(
      'title'    => 'Edit Barang masuk',
      'brg'        => $brg,
      'rekanan'   => $rekanan,
      'satuan'    => $satuan,
      'expired6bulan' => $expired6bln,
      'expired3bulan' => $expired3bln,
      'expired1bulan' => $expired1bln,
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
        'tgl_edit'          => date('Y-m-d H:i:s')
      );

      $this->Brg_masuk_model->update($data);
      $this->session->set_flashdata('sukses', 'Data berhasil diubah');
      redirect(base_url('admin/barang/riwayat/' . $brg['id_barang']));
    }
  }


  // Hapus
  public function delete($id_barang_masuk)
  {


    $barang    = $this->Barang_model->detail($id_barang);
    $id_barang = $barang['id_barang'];

    $data = array('id_barang_masuk'  => $id_barang_masuk);
    $this->Brg_masuk_model->delete($data);
    $this->session->set_flashdata('sukses', 'Data barang masuk berhasil dihapus');
    redirect(base_url('admin/barang/riwayat/' . $id_barang));
  }
}
