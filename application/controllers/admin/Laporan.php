<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('Brg_masuk_model');
		$this->load->model('Brg_keluar_model');
		$this->load->model('Barang_model');
		$this->load->model('Laporan_model');
		$this->load->model('Jenis_model');
		$this->load->model('Satker_model');
		$this->load->model('Unit_model');
		$this->load->model('Brg_keluarkel_model');
		$this->load->model('Brg_masukkel_model');
	}

	public function cari_stok()
	{
		$tmt = date('Y-m-01');
		$tmtdua = 0;
		$id_jenis = 0;
		$satker           = $this->Satker_model->listing();
		$unit             = $this->Unit_model->listing();
		$barang 		  = $this->Jenis_model->listing();
		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();
		// $unit = $this->Unit_model->listing();
		// $id_satker = 0;
		// $id_unit = 0;


		if (isset($_POST['tmt'])) {
			$periode = ($this->input->post('tmt') . '/' . $this->input->post('tmtdua') . '/' . $this->input->post('id_jenis'));
			redirect(base_url('admin/laporan/tampil/' . $periode), 'refresh');
		}

		$data = array(
			'title'         => 'Laporan barang masuk',
			'tmt'           => $tmt,
			'tmtdua'        => $tmtdua,
			'barang'        => $barang,
			'id_jenis'      => $id_jenis,
			'expired6bulan'   => $expired6bln,
			'expired3bulan'   => $expired3bln,
			'expired1bulan'   => $expired1bln,
			// 'unit'        	=> $unit,
			// 'satker'        => $satker,
			// 'id_satker'     => $id_satker,
			// 'id_unit'       => $id_unit,
			'isi'           => 'admin/laporan/list'
		);

		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function cari_keluar()
	{

		$tmt = date('Y-m-01');
		$tmtdua = 0;
		$id_jenis = 0;
		$satker           = $this->Satker_model->listing();
		$unit             = $this->Unit_model->listing();
		$barang 		  = $this->Jenis_model->listing();
		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();
		// $unit = $this->Unit_model->listing();
		// $id_satker = 0;
		// $id_unit = 0;


		if (isset($_POST['tmt'])) {
			$periode = ($this->input->post('tmt') . '/' . $this->input->post('tmtdua') . '/' . $this->input->post('id_jenis'));
			redirect(base_url('admin/laporan/tampil_luar/' . $periode), 'refresh');
		}

		$data = array(
			'title'         => 'Pencarian Lap. Barang Keluar',
			'tmt'           => $tmt,
			'tmtdua'        => $tmtdua,
			'barang'        => $barang,
			'id_jenis'      => $id_jenis,
			'expired6bulan'   => $expired6bln,
			'expired3bulan'   => $expired3bln,
			'expired1bulan'   => $expired1bln,
			// 'unit'        	=> $unit,
			// 'satker'        => $satker,
			// 'id_satker'     => $id_satker,
			// 'id_unit'       => $id_unit,
			'isi'           => 'admin/laporan/list_luar'
		);

		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}


	public function tampil()
	{
		$tmt  		 = $this->uri->segment(4);
		$tmtdua  	 = $this->uri->segment(5);
		$id_jenis  	 = $this->uri->segment(6);
		$bulan	     = date('m', strtotime($tmtdua));
		$tahun	     = date('Y', strtotime($tmtdua));
		$jenis       = $this->Jenis_model->listing();
		$nama        = $this->Jenis_model->detail($id_jenis);
		$brg 	     = $this->Brg_masuk_model->pencarian_hasil($tmt, $tmtdua, $id_jenis);

		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();
		// $jml_masuk   = $this->Brg_masuk_model->get_jumlah_masuk($id_barang,$tmt,$tmtdua);
		// $jml_keluar  = $this->Brg_keluar_model->get_jumlah_keluar($id_barang,$tmt,$tmtdua);
		// $brg  		 = $this->Laporan_model->detail();

		if (isset($_POST['tmt'])) {
			$periode = ($this->input->post('tmt') . '/' . $this->input->post('tmtdua') . '/' . $this->input->post('id_jenis'));
			redirect(base_url('admin/laporan/tampil/' . $periode), 'refresh');
		}


		$data = array(
			'title' 	 => 'Laporan Barang Masuk ' . $nama['nama_jenis'],
			// 'jml_masuk'  => $jml_masuk,
			// 'jml_keluar' => $jml_keluar,
			'brg' 		 => $brg,
			'bulan' 	 => $bulan,
			'tahun'      => $tahun,
			'tmt' 		 => $tmt,
			'expired6bulan' => $expired6bln,
			'expired3bulan' => $expired3bln,
			'expired1bulan' => $expired1bln,
			'tmtdua'     => $tmtdua,
			'jenis'      => $jenis,
			'id_jenis'   => $id_jenis,
			'isi' 		 => 'admin/laporan/result_stok'
		);
		$this->load->view('admin/layout/wrapper', $data);
	}

	public function tampil_luar()
	{
		$tmt  		 = $this->uri->segment(4);
		$tmtdua  	 = $this->uri->segment(5);
		$id_jenis  	 = $this->uri->segment(6);
		$bulan	     = date('m', strtotime($tmtdua));
		$tahun	     = date('Y', strtotime($tmtdua));
		$barang       = $this->Jenis_model->listing();
		$nama        = $this->Jenis_model->detail($id_jenis);
		$brg 	     = $this->Brg_keluar_model->cari_brg_keluar($tmt, $tmtdua, $id_jenis);

		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();
		// $jml_masuk   = $this->Brg_masuk_model->get_jumlah_masuk($id_barang,$tmt,$tmtdua);
		// $jml_keluar  = $this->Brg_keluar_model->get_jumlah_keluar($id_barang,$tmt,$tmtdua);
		// $brg  		 = $this->Laporan_model->detail();

		if (isset($_POST['tmt'])) {
			$periode = ($this->input->post('tmt') . '/' . $this->input->post('tmtdua') . '/' . $this->input->post('id_jenis'));
			redirect(base_url('admin/laporan/tampil_luar/' . $periode), 'refresh');
		}


		$data = array(
			'title' 	 => 'Laporan Barang Keluar ' . $nama['nama_jenis'],
			'brg' 		 => $brg,
			'bulan' 	 => $bulan,
			'tahun'      => $tahun,
			'tmt' 		 => $tmt,
			'expired6bulan' => $expired6bln,
			'expired3bulan' => $expired3bln,
			'expired1bulan' => $expired1bln,
			'tmtdua'     => $tmtdua,
			'barang'     => $barang,
			'id_jenis'   => $id_jenis,
			'isi' 		 => 'admin/laporan/result_stok_luar'
		);
		$this->load->view('admin/layout/wrapper', $data);
	}


	//KELURAHAN
	public function masuk_kel()
	{

		$tmt = date('Y-m-01');
		$tmtdua = 0;
		$id_satker = 0;
		$satker           = $this->Satker_model->list_pustu();
		$unit             = $this->Unit_model->listing();
		$barang 		  = $this->Jenis_model->listing();
		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();
		// $unit = $this->Unit_model->listing();
		// $id_satker = 0;
		// $id_unit = 0;


		if (isset($_POST['tmt'])) {
			$periode = ($this->input->post('tmt') . '/' . $this->input->post('tmtdua') . '/' . $this->input->post('id_satker'));
			redirect(base_url('admin/laporan/tampil_pustu/' . $periode), 'refresh');
		}

		$data = array(
			'title'         => 'Pencarian Lap. Barang Masuk',
			'tmt'           => $tmt,
			'tmtdua'        => $tmtdua,
			'barang'        => $barang,
			'satker'        => $satker,
			'id_satker'     => $id_satker,
			'expired6bulan'   => $expired6bln,
			'expired3bulan'   => $expired3bln,
			'expired1bulan'   => $expired1bln,
			// 'id_jenis'      => $id_jenis,
			// 'unit'        	=> $unit,
			// 'id_unit'       => $id_unit,
			'isi'           => 'admin/laporan/list_pustu'
		);

		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function tampil_pustu()
	{
		$tmt  		 = $this->uri->segment(4);
		$tmtdua  	 = $this->uri->segment(5);
		$id_satker   = $this->uri->segment(6);
		$detail 	 = $this->Satker_model->detail($id_satker);
		$bulan	     = date('m', strtotime($tmtdua));
		$tahun	     = date('Y', strtotime($tmtdua));
		$satker      = $this->Satker_model->list_pustu();
		$brg 	     = $this->Brg_masukkel_model->masuk_pustu($tmt, $tmtdua, $id_satker);

		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();
		// $nama        = $this->Jenis_model->detail($id_jenis);
		// $jml_masuk   = $this->Brg_masuk_model->get_jumlah_masuk($id_barang,$tmt,$tmtdua);
		// $jml_keluar  = $this->Brg_keluar_model->get_jumlah_keluar($id_barang,$tmt,$tmtdua);
		// $brg  		 = $this->Laporan_model->detail();

		if (isset($_POST['tmt'])) {
			$periode = ($this->input->post('tmt') . '/' . $this->input->post('tmtdua') . '/' . $this->input->post('id_satker'));
			redirect(base_url('admin/laporan/tampil_pustu/' . $periode), 'refresh');
		}


		$data = array(
			'title' 	 => 'Laporan Barang Masuk ' . $detail['nama_satker'],
			// 'jml_masuk'  => $jml_masuk,
			// 'jml_keluar' => $jml_keluar,
			'brg' 		 => $brg,
			'bulan' 	 => $bulan,
			'tahun'      => $tahun,
			'tmt' 		 => $tmt,
			'expired6bulan' => $expired6bln,
			'expired3bulan' => $expired3bln,
			'expired1bulan' => $expired1bln,
			'tmtdua'     => $tmtdua,
			'jenis'      => $jenis,
			'satker'      => $satker,
			// 'id_jenis'   => $id_jenis,
			'id_satker'   => $id_satker,
			'isi' 		 => 'admin/laporan/result_pustu'
		);
		$this->load->view('admin/layout/wrapper', $data);
	}

	public function keluar_kel()
	{

		$tmt = date('Y-m-01');
		$tmtdua = 0;
		$id_jenis = 0;
		$satker           = $this->Satker_model->listing();
		$unit             = $this->Unit_model->listing();
		$barang 		  = $this->Jenis_model->listing();
		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();

		if (isset($_POST['tmt'])) {
			$periode = ($this->input->post('tmt') . '/' . $this->input->post('tmtdua') . '/' . $this->input->post('id_jenis'));
			redirect(base_url('admin/laporan/luar_pustu/' . $periode), 'refresh');
		}

		$data = array(
			'title'         => 'Pencarian Laporan Barang Keluar',
			'tmt'           => $tmt,
			'tmtdua'        => $tmtdua,
			'barang'        => $barang,
			'id_jenis'      => $id_jenis,
			'expired6bulan'   => $expired6bln,
			'expired3bulan'   => $expired3bln,
			'expired1bulan'   => $expired1bln,
			// 'unit'        	=> $unit,
			// 'satker'        => $satker,
			// 'id_satker'     => $id_satker,
			// 'id_unit'       => $id_unit,
			'isi'           => 'admin/laporan/list_luar'
		);

		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function luar_pustu()
	{
		$tmt  		 = $this->uri->segment(4);
		$tmtdua  	 = $this->uri->segment(5);
		$id_satker   = $this->uri->segment(6);
		$detail 	 = $this->Satker_model->detail($id_satker);
		$bulan	     = date('m', strtotime($tmtdua));
		$tahun	     = date('Y', strtotime($tmtdua));
		$brg 	     = $this->Brg_keluarkel_model->cari_brg_keluar($tmt, $tmtdua);
		$satker      = $this->Satker_model->list_pustu();

		if (isset($_POST['tmt'])) {
			$periode = ($this->input->post('tmt') . '/' . $this->input->post('tmtdua'));
			redirect(base_url('admin/laporan/luar_pustu/' . $periode), 'refresh');
		}


		$data = array(
			'title' 	 => 'Laporan Barang Keluar ' . $detail['nama_satker'],
			'brg' 		 => $brg,
			'bulan' 	 => $bulan,
			'tahun'      => $tahun,
			'tmt' 		 => $tmt,
			'tmtdua'     => $tmtdua,
			'jenis'      => $jenis,
			'id_jenis'   => $id_jenis,
			'isi' 		 => 'admin/laporan/result_stok_luar'
		);
		$this->load->view('admin/layout/wrapper', $data);
	}

	public function excel_keluar()
	{
		$tmt  		 = $this->uri->segment(4);
		$tmtdua  	 = $this->uri->segment(5);
		$id_jenis  	 = $this->uri->segment(6);
		$bulan	     = date('m', strtotime($tmtdua));
		$tahun	     = date('Y', strtotime($tmtdua));
		$jenis       = $this->Jenis_model->listing();
		$nama        = $this->Jenis_model->detail($id_jenis);
		$brg 	     = $this->Brg_keluar_model->cari_brg_keluar($tmt, $tmtdua, $id_jenis);
		// $jml_masuk   = $this->Brg_masuk_model->get_jumlah_masuk($id_barang,$tmt,$tmtdua);
		// $jml_keluar  = $this->Brg_keluar_model->get_jumlah_keluar($id_barang,$tmt,$tmtdua);
		// $brg  		 = $this->Laporan_model->detail();

		if (isset($_POST['tmt'])) {
			$periode = ($this->input->post('tmt') . '/' . $this->input->post('tmtdua') . '/' . $this->input->post('id_jenis'));
			redirect(base_url('admin/laporan/tampil_luar/' . $periode), 'refresh');
		}


		$data = array(
			'title' 	 => 'Laporan Jenis Barang ' . $nama['nama_jenis'],
			'brg' 		 => $brg,
			'bulan' 	 => $bulan,
			'tahun'      => $tahun,
			'tmt' 		 => $tmt,
			'tmtdua'     => $tmtdua,
			'jenis'      => $jenis,
			'nama'       => $nama,
			'id_jenis'   => $id_jenis
		);
		$this->load->view('admin/laporan/excel_brg_keluar', $data);
	}


	public function cetak_excel()
	{
		$tmt  		 = $this->uri->segment(4);
		$tmtdua  	 = $this->uri->segment(5);
		$id_jenis  	 = $this->uri->segment(6);
		$bulan	     = date('m', strtotime($tmtdua));
		$tahun	     = date('Y', strtotime($tmtdua));
		$jenis       = $this->Jenis_model->listing();
		$nama        = $this->Jenis_model->detail($id_jenis);
		$brg 	     = $this->Brg_masuk_model->cari_brg_masuk($tmt, $tmtdua, $id_jenis);
		// $jml_masuk   = $this->Brg_masuk_model->get_jumlah_masuk($id_barang,$tmt,$tmtdua);
		// $jml_keluar  = $this->Brg_keluar_model->get_jumlah_keluar($id_barang,$tmt,$tmtdua);
		// $brg  		 = $this->Laporan_model->detail();

		if (isset($_POST['tmt'])) {
			$periode = ($this->input->post('tmt') . '/' . $this->input->post('tmtdua') . '/' . $this->input->post('id_jenis'));
			redirect(base_url('admin/laporan/tampil/' . $periode), 'refresh');
		}


		$data = array(
			'title' 	 => 'Laporan Jenis Barang ' . $nama['nama_jenis'],
			'brg' 		 => $brg,
			'bulan' 	 => $bulan,
			'tahun'      => $tahun,
			'tmt' 		 => $tmt,
			'tmtdua'     => $tmtdua,
			'jenis'      => $jenis,
			'nama'       => $nama,
			'id_jenis'   => $id_jenis
		);
		$this->load->view('admin/laporan/excel_laporan', $data);
	}





	public function opname()
	{
		$id_jenis = 0;
		$jenis = $this->Jenis_model->listing();
		$satker = $this->Satker_model->listing();


		if (isset($_POST['id_jenis'])) {
			$periode = ($this->input->post('id_jenis'));
			redirect(base_url('admin/laporan/tampil_opname/' . $periode), 'refresh');
		}

		$data = array(
			'title'         => 'Pencarian Jenis Stok Opname',
			'id_jenis'      => $id_jenis,
			'jenis'      	=> $jenis,
			'satker'      	=> $satker,
			'isi'           => 'admin/laporan/list_opname'
		);

		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}


	public function tampil_opname()
	{
		$id_jenis   = $this->uri->segment(4);
		$jenis 		= $this->Jenis_model->listing();
		$satker 	= $this->Satker_model->listing();
		// $barang 	= $this->Laporan_model->list_brg_masuk($id_jenis);
		$ada 		= $this->Laporan_model->list_brg_ada($id_jenis);


		if (isset($_POST['id_jenis'])) {
			$periode = ($this->input->post('id_jenis') . '/' . $this->input->post('id_satker'));
			redirect(base_url('admin/laporan/tampil_opname/' . $periode), 'refresh');
		}

		$data = array(
			'title' 	 => 'Cari laporan ',
			'id_jenis'   => $id_jenis,
			'jenis'   	 => $jenis,
			'satker'   	 => $satker,
			// 'barang'   	 => $barang,
			'ada'   	 => $ada,
			'isi' 		 => 'admin/laporan/laporan_brg'
		);
		$this->load->view('admin/layout/wrapper', $data);
	}
}

/* End of file Laporan.php */
/* Location: ./application/controllers/admin/Laporan.php */
