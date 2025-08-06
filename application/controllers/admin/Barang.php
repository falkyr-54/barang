<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Barang extends CI_Controller
{
	// Fungsi database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Barang_model');
		$this->load->model('Brg_masuk_model');
		$this->load->model('Brg_masukkel_model');
		$this->load->model('Brg_keluar_model');
		$this->load->model('Brg_keluarkel_model');
		$this->load->model('Jenis_model');
		$this->load->model('Satuan_model');
		$this->load->model('Unit_model');
		$this->load->model('Satker_model');
	}

	// Pengguna
	public function index()
	{
		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();
		$barang = $this->Barang_model->listing();
		$id_satkerku = $this->uri->segment(4); {
			$data = array(
				'title'			=> 'Data Master Jenis Barang',
				'barang'		=>	$barang,
				'id_satkerku'	=>	$id_satkerku,
				'expired6bulan' => $expired6bln,
				'expired3bulan' => $expired3bln,
				'expired1bulan' => $expired1bln,
				'isi'			=> 'admin/barang/list_brg'
			);
			$this->load->view('admin/layout/wrapper', $data);
		}
	}

	public function proses()
	{
		$barang = $this->Barang_model->listing();
		$id_satkerku = $this->uri->segment(4);
		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan(); {
			$data = array(
				'title'			=> 'Data Barang',
				'barang'		=>	$barang,
				'id_satkerku'	=>	$id_satkerku,
				'expired6bulan' => $expired6bln,
				'expired3bulan' => $expired3bln,
				'expired1bulan' => $expired1bln,
				'isi'			=> 'admin/barang/proses'
			);
			$this->load->view('admin/layout/wrapper', $data);
		}
	}

	public function list_pkl($id_satker)
	{
		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();
		$barang = $this->Barang_model->listing();
		$id_satkerku = $this->uri->segment(4); {
			$data = array(
				'title'			=> 'Data Master Jenis Barang',
				'barang'		=>	$barang,
				'id_satkerku'	=>	$id_satkerku,
				'expired6bulan' => $expired6bln,
				'expired3bulan' => $expired3bln,
				'expired1bulan' => $expired1bln,
				'isi'			=> 'admin/barang/list'
			);
			$this->load->view('admin/layout/wrapper', $data);
		}
	}

	public function list_today($id_satker)
	{

		$id_satker 	= $this->uri->segment(4);
		$skrg 		= date('Y-m-d');
		$masuk  	= $this->Brg_masuk_model->list_skrg($id_satker, $skrg);
		$keluar 	= $this->Brg_keluar_model->list_skrg($id_satker, $skrg);
		$satker 	= $this->Satker_model->detail($id_satker);
		$satuan 	= $this->Satuan_model->listing();
		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();



		// $barang 	= $this->Barang_model->detail_kel($id_barang,$id_satker);
		// $jml_masuk  = $this->Brg_masukkel_model->get_jumlah_masuk($id_barang,$id_satker);
		// $jml_keluar = $this->Brg_keluarkel_model->get_jumlah_keluar($id_barang,$id_satker);

		// Validasi$keluar
		$valid = $this->form_validation;

		$valid->set_rules('kode_barang', 'Kode Barang', 'required', array('required' => 'Kode Barang Harus diisi'));

		$valid->set_rules('nama_barang', 'Nama Barang', 'required', array('required' => 'Nama Barang Harus diisi'));

		if ($valid->run() === FALSE) {

			$data = array(
				'title'		=> 'Transaksi Barang Hari ini ' . ' ' . $satker['nama_satker'],
				'id_satker'	=> $id_satker,
				'satker'	=> $satker,
				// 'jml_masuk'	=> $jml_masuk,
				// 'jml_keluar'=> $jml_keluar,
				'masuk'		=> $masuk,
				'keluar'	=> $keluar,
				'expired6bulan' => $expired6bln,
				'expired3bulan' => $expired3bln,
				'expired1bulan' => $expired1bln,
				'isi'		=> 'admin/barang/hari_ini'
			);
			$this->load->view('admin/layout/wrapper', $data);
		}
	}


	public function kelurahan()
	{
		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();

		$today = date('Y-m-d');

		$lurah = $this->Barang_model->list_kel();


		$data = array(
			'title'			=> 'Data Transaksi Puskesmas',
			'lurah'			=>	$lurah,
			'expired6bulan' => $expired6bln,
			'expired3bulan' => $expired3bln,
			'expired1bulan' => $expired1bln,
			'isi'			=> 'admin/barang/dasbor'
		);
		$this->load->view('admin/layout/wrapper', $data);
	}

	public function tambah()
	{
		$jenis_brg = $this->Jenis_model->listing();
		$satuan = $this->Satuan_model->listing();
		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();
		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules('kode_barang', 'Kode Barang', 'required', array('required' => 'Kode Barang Harus diisi'));

		$valid->set_rules('nama_barang', 'Nama Barang', 'required', array('required' => 'Nama Barang Harus diisi'));

		if ($valid->run() === FALSE) {

			$data = array(
				'title'		=> 'Tambahkan Data Barang',
				'jenis_brg'	=> $jenis_brg,
				'satuan'	=> $satuan,
				'expired6bulan' => $expired6bln,
				'expired3bulan' => $expired3bln,
				'expired1bulan' => $expired1bln,
				'isi'		=> 'admin/barang/tambah'
			);
			$this->load->view('admin/layout/wrapper', $data);
		} else {

			// Masuk ke database
			$i 	= $this->input;
			$data = array(
				'id_jenis'			=> $i->post('id_jenis'),
				'id_satuan'			=> $i->post('id_satuan'),
				'kode_barang'		=> $i->post('kode_barang'),
				'nama_barang'		=> $i->post('nama_barang')
			);
			$this->Barang_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data Barang telah ditambah');
			redirect(base_url('admin/barang'));
		}
	}


	public function edit($id_barang)
	{
		$barang = $this->Barang_model->detail($id_barang);
		$jenis_brg = $this->Jenis_model->listing();
		$satuan = $this->Satuan_model->listing();
		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();
		$valid = $this->form_validation;

		$valid->set_rules(
			'kode_barang',
			'Kode Jenis Barang',
			'required',
			array('required'		=> 'Kode Jenis Barang harus diisi')
		);

		$valid->set_rules(
			'nama_barang',
			'Nama Barang',
			'required',
			array('required'		=> 'Nama Barang harus diisi')
		);

		if ($valid->run() === FALSE) {
			$data = array(
				'title'		=> 'Ubah Data Barang',
				'barang'		=> $barang,
				'satuan'		=> $satuan,
				'jenis_brg'		=> $jenis_brg,
				'expired6bulan' => $expired6bln,
				'expired3bulan' => $expired3bln,
				'expired1bulan' => $expired1bln,
				'isi'		=> 'admin/barang/edit'
			);
			$this->load->view('admin/layout/wrapper', $data);
		} else {
			$i 	= $this->input;
			$data = array(
				'id_barang'		=> $id_barang,
				'id_jenis'		=> $i->post('id_jenis'),
				'id_satuan'		=> $i->post('id_satuan'),
				'kode_barang'	=> $i->post('kode_barang'),
				'nama_barang'	=> $i->post('nama_barang'),

			);
			// print_r($data);die();
			$this->Barang_model->edit($data);
			$this->session->set_flashdata('sukses', 'Data barang berhasil diubah');
			redirect(base_url('admin/barang'));
		}
	}

	public function riwayat($id_barang)
	{

		$id_satker   = $this->session->userdata('id_satker');
		$barang      = $this->Barang_model->detail($id_barang);
		$masuk       = $this->Brg_masuk_model->list_brg($id_barang);
		$keluar      = $this->Brg_keluar_model->list_brgku($id_barang);
		$satuan      = $this->Satuan_model->listing();
		$jml_masuk   = $this->Brg_masuk_model->get_jumlah_masuk($id_barang);
		$jml_keluar  = $this->Brg_keluar_model->get_jumlah_keluar($id_barang);
		
		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules('kode_barang', 'Kode Barang', 'required', array('required' => 'Kode Barang Harus diisi'));

		$valid->set_rules('nama_barang', 'Nama Barang', 'required', array('required' => 'Nama Barang Harus diisi'));

		if ($valid->run() === FALSE) {

			$data = array(
				'title'		=> 'Transaksi Barang',
				'barang'	=> $barang,
				'jml_masuk'	=> $jml_masuk,
				'jml_keluar' => $jml_keluar,
				'masuk'		=> $masuk,
				'keluar'		=> $keluar,
				'id_satker'	=> $id_satker,
				'isi'		=> 'admin/barang/riwayat'
			);
			$this->load->view('admin/layout/wrapper', $data);
		}
	}




	public function riwayat_kel($id_barang, $id_satker)
	{
		$id_barang 	= $this->uri->segment(4);
		$id_satker 	= $this->uri->segment(5);
		$barang 	= $this->Barang_model->detail_kel($id_barang, $id_satker);
		$satker 	= $this->Satker_model->detail($id_satker);

		$masuk  	= $this->Brg_masukkel_model->list_brg($id_barang, $id_satker);
		$keluar 	= $this->Brg_keluarkel_model->list_brg($id_barang, $id_satker);

		$satuan 	= $this->Satuan_model->listing();

		$jml_masuk  = $this->Brg_masukkel_model->get_jumlah_masuk($id_barang, $id_satker);
		$jml_keluar = $this->Brg_keluarkel_model->get_jumlah_keluar($id_barang, $id_satker);

		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();


		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules('kode_barang', 'Kode Barang', 'required', array('required' => 'Kode Barang Harus diisi'));

		$valid->set_rules('nama_barang', 'Nama Barang', 'required', array('required' => 'Nama Barang Harus diisi'));

		if ($valid->run() === FALSE) {

			$data = array(
				'title'		=> 'Transaksi Barang' . ' ' . $satker['nama_satker'],
				'barang'	=> $barang,
				'jml_masuk'	=> $jml_masuk,
				'jml_keluar' => $jml_keluar,
				'masuk'		=> $masuk,
				'keluar'	=> $keluar,
				'expired6bulan' => $expired6bln,
				'expired3bulan' => $expired3bln,
				'expired1bulan' => $expired1bln,
				// 'brg'		=> $brg,
				'id_satker'		=> $id_satker,
				'isi'		=> 'admin/barang/riwayat_kel'
			);
			$this->load->view('admin/layout/wrapper', $data);
		} else {

			// Masuk ke database
			$i 	= $this->input;
			$data = array(
				'id_jenis'			=> $i->post('id_jenis'),
				'id_satuan'			=> $i->post('id_satuan'),
				'kode_barang'		=> $i->post('kode_barang'),
				'nama_barang'		=> $i->post('nama_barang')
			);
			$this->Barang_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data Barang telah ditambah');
			redirect(base_url('admin/barang'));
		}
	}

	public function delete($id_jenis)
	{

		$data = array('id_jenis'	=> $id_jenis);
		$this->Barang_model->delete($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/jenis_brg'));
	}


	public function cari_masuk()
	{
		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();


		$tmt = date('Y-m-01');
		$tmtdua = 0;
		$unit = $this->Unit_model->listing();
		// $sampai = date('Y-m-31');

		if (isset($_POST['tmt'])) {
			$periode = ($this->input->post('tmt'));
			redirect(base_url('admin/barang/pencarian_masuk/' . $periode), 'refresh');
		}

		$data = array(
			'title'         => 'Pencarian Transaksi',
			'tmt'           => $tmt,
			'tmtdua'        => $tmtdua,
			'expired6bulan' => $expired6bln,
			'expired3bulan' => $expired3bln,
			'expired1bulan' => $expired1bln,
			// 'unit'          => $unit,
			// 'id_unit'       => $id_unit,
			'isi'           => 'admin/barang_masuk/cari_masuk'
		);

		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function pencarian_masuk()
	{

		$tmt         = $this->uri->segment(4);
		$tmtdua  	 = $this->uri->segment(5);
		// $id_unit     = $this->uri->segment(5);
		$id_pegawai  = $this->session->userdata('id');
		$masuk   	 = $this->Brg_masuk_model->pencarian_hasil($tmt, $tmtdua);

		if (isset($_POST['tmt'])) {
			$periode = ($this->input->post('tmt') . '/' . $this->input->post('tmtdua'));
			redirect(base_url('admin/barang/pencarian_masuk/' . $periode), 'refresh');
		}

		$data = array(
			'title'     => 'Hasil Pencarian ',
			'tmt'       => $tmt,
			'tmtdua'    => $tmtdua,
			'masuk'     => $masuk,
			// 'id_unit'   => $id_unit,
			'isi'       => 'admin/barang_masuk/result_masuk'
		);

		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}


	public function cari_keluar()
	{
		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();

		$tmt = date('Y-m-01');
		$tmtdua = 0;
		$unit = $this->Unit_model->listing();
		$id_unit = 0;


		if (isset($_POST['tmt'])) {
			$periode = ($this->input->post('tmt') . '/' . $this->input->post('tmtdua'));
			redirect(base_url('admin/barang/pencarian_keluar/' . $periode), 'refresh');
		}

		$data = array(
			'title'         => 'Pencarian Transaksi',
			'tmt'           => $tmt,
			'tmtdua'        => $tmtdua,
			'unit'          => $unit,
			'expired6bulan' => $expired6bln,
			'expired3bulan' => $expired3bln,
			'expired1bulan' => $expired1bln,
			'id_unit'       => $id_unit,
			'isi'           => 'admin/barang_keluar/cari_keluar'
		);

		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function pencarian_keluar()
	{

		$tmt         = $this->uri->segment(4);
		$tmtdua      = $this->uri->segment(5);
		// $id_unit     = $this->uri->segment(6);
		$unit 		 = $this->Unit_model->listing();
		$id_pegawai  = $this->session->userdata('id');
		// $keluar   	 = $this->Brg_keluar_model->pencarian_hasil($tmt,$tmtdua,$id_unit);
		$keluar = $this->Brg_keluar_model->pencarian_hasil_tgl($tmt, $tmtdua);

		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();


		if (isset($_POST['tmt'])) {
			// $periode = ($this->input->post('tmt').'/'.$this->input->post('tmtdua').'/'.$this->input->post('id_unit'));
			$periode = ($this->input->post('tmt') . '/' . $this->input->post('tmtdua'));
			redirect(base_url('admin/barang/pencarian_keluar/' . $periode), 'refresh');
		}

		// if ($id_unit==0) 
		// {
		// 	$data = array(
		// 	'title'     => 'Hasil Pencarian ',
		// 	'tmt'       => $tmt,
		// 	'tmtdua'    => $tmtdua,
		// 	'id_unit'   => $id_unit,
		// 	'unit'      => $unit,
		// 	'keluar'    => $keluar_unit,
		// 	'isi'       => 'admin/barang_keluar/result_keluar');
		// }else{
		$data = array(
			'title'     => 'Hasil Pencarian ',
			'tmt'       => $tmt,
			'tmtdua'    => $tmtdua,
			'expired6bulan' => $expired6bln,
			'expired3bulan' => $expired3bln,
			'expired1bulan' => $expired1bln,
			// 'id_unit'   => $id_unit,
			'unit'      => $unit,
			'keluar'    => $keluar,
			'isi'       => 'admin/barang_keluar/result_keluar'
		);
		// }

		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
}
