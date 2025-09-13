<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Permintaan_pengadaan extends CI_Controller
{
	// Fungsi database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pjklaster_model');
		$this->load->model('Brg_keluar_model');
		$this->load->model('Brg_masuk_model');
		$this->load->model('Admin_brg_model');
		$this->load->model('Tahun_model');
		$this->load->model('Permintaan_pengadaan_model');
	}

	// test controller pj lagi aja
	public function index()
	{
		$id_klaster     = $this->session->userdata('id_klaster');

		$id_user_pj        = $this->session->userdata('id');
		$site 	= $this->konfigurasi_model->listing();
		$tahun 	= date('Y');
		$brg 	= $this->dasbor_model->terbaru($tahun);
		$listing = $this->Pjklaster_model->list_barang($id_klaster);

		$valid = $this->form_validation;

		$valid->set_rules(
			'jumlah_keluar',
			'Jumlah keluar',
			'required',
			array('required'    => 'Jumlah keluar harus diisi')
		);

		if ($valid->run() === FALSE) {

			$data = array(
				'title'		        => $site['namaweb'] . ' - ' . $site['tagline'],
				'tahun' 	        => $tahun,
				'brg'		        => $brg,
				'listing' 	        => $listing,
				'id_user_pj' 		=> $id_user_pj,
				'isi'		        => 'admin/pengadaan/list'
			);
			$this->load->view('admin/layout/wrapper', $data);
		} else {
			$i 	= $this->input;
			$data = array(
				'id_barang_keluar'		=> $i->post('id_barang_keluar'),
				'jumlah_keluar'			=> $i->post('jumlah_keluar'),
				'id_user_pj'			=> $id_user_pj,
				'status_validasi'		=> 'acc_pj'
			);


			$this->Brg_keluar_model->update($data);
			$this->session->set_flashdata('sukses', 'Data divalidasi');
			redirect(base_url('admin/pj_klaster'));
		}
	}



	//pencarian aproval
	public function cari_approval()
	{

		// $tmt 		= date('Y-m-01');
		// $sampai 	= date('Y-m-31');
		// $bulan 		= date('m');
		// $tahun 		= date('Y');
		$id_klaster = $this->session->userdata('id_klaster');
		$pengadaan      = $this->Permintaan_pengadaan_model->get_permintaan_by_satker($id_klaster);
		$status     = 'belum';
		// $taun       = $this->tahun_model->list_thn();

		// if (isset($_POST['tmt'])) {
		// 	$periode = ($this->input->post('tmt') . '/' . $this->input->post('sampai') . '/' . $id_klaster . '/' . $this->input->post('status'));
		// 	redirect(base_url('admin/pj_klaster/pencarian/' . $periode), 'refresh');
		// }


		$data = array(
			'title'         => 'List permintaan Pengadaan yang harus di approve',
			// 'tmt'           =>  $tmt,
			// 'sampai'        =>  $sampai,
			'pengadaan'         =>  $pengadaan,
			'status'         => $status,
			'id_klaster'    =>  $id_klaster,
			// 'id_user_pj'    =>  $id_user,
			// 'taun'          =>  $taun,
			'isi'           => 'admin/pengadaan/list_approv'
		);

		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function ajukanPengadaan()
	{
		$id_satker = $this->session->userdata('id_satker');
		$i 	= $this->input;

		$data = array(
			'id_barang'				=> $i->post('id_barang'),
			'nama_request'			=> $i->post('nama_request'),
			'level'			=> $i->post('input_by'),
			'id_satker'		=> $id_satker,
			'tanggal_request'	=> $i->post('tanggal_request_pengadaan'),
			'status'		=> 'proses_pptk'
		);
		$this->Permintaan_pengadaan_model->ajukanPengadaan($data);
		$this->session->set_flashdata('sukses', 'Permintaan pengadaan berhasil dikirim');
		redirect(base_url('admin/barang/riwayat/' . $i->post('id_barang') . '/' . $id_satker));
	}

	public function aksi()
	{
		$id_request = $this->input->post('id_request');
		$action     = $this->input->post('action');
		$keterangan = $this->input->post('keterangan');

		if ($action == 'setujui_pptk') {
			$this->db->where('id_request', $id_request)->update('permintaan_pengadaan', [
				'status' => 'disetujui_pptk',
				'keterangan' => $keterangan
			]);
			$this->session->set_flashdata('sukses', 'Permintaan berhasil disetujui ✅, Silahkan melakukan Proses');
		} elseif ($action == 'tolak_pptk') {
			$this->db->where('id_request', $id_request)->update('permintaan_pengadaan', [
				'status' => 'ditolak_pptk',
				'keterangan' => $keterangan
			]);
			$this->session->set_flashdata('error', 'Permintaan berhasil ditolak ❌');
		}

		redirect(base_url('admin/permintaan_pengadaan/cari_approval/'));
	}




	public function tolak($id_barang_keluar)
	{

		$jumlah_keluar = $this->input->post('jumlah_keluar');
		$tmt           = $this->input->post('tmt');
		$sampai        = $this->input->post('sampai');
		$id_user_pj = $this->session->userdata('id');

		$data = array(
			'id_barang_keluar' => $id_barang_keluar,
			'id_user_pj' 	   => $id_user_pj,
			'jumlah_keluar'    => $jumlah_keluar,
			'status_validasi'  => 'tolak_pj'
		);

		$this->Brg_keluar_model->update($data);
		$this->session->set_flashdata('sukses', 'Berhasil diapprove');

		redirect(base_url('admin/pj_klaster/cari_approval/'));
	}

	public function pencarian_klast()
	{
		$tmt         = $this->uri->segment(4);
		$sampai      = $this->uri->segment(5);
		$status      = $this->uri->segment(6);
		$id_klaster  = $this->session->userdata('id_klaster');
		$klast       = $this->Pjklaster_model->pencarian_klast($tmt, $sampai, $status, $id_klaster);

		if (isset($_POST['tmt'], $_POST['status_validasi']) && $_POST['status_validasi'] !== '0') {
			$periode = ($this->input->post('tmt') . '/' . $this->input->post('sampai') . '/' . $this->input->post('status_validasi') . '/' . $id_klaster);
			redirect(base_url('admin/pj_klaster/pencarian_klast/' . $periode), 'refresh');
		} else if (isset($_POST['tmt'])) {
			$periode = ($this->input->post('tmt') . '/' . $this->input->post('sampai') . '/' . $id_klaster);
			redirect(base_url('admin/pj_klaster/cari_klaster/' . $periode), 'refresh');
		}



		$data = array(
			'title'     => 'Hasil pencarian ',
			'tmt'       => $tmt,
			'sampai'       => $sampai,
			'status'     => $status,
			'id_klaster' => $id_klaster,
			'klast'     => $klast,
			'isi'       => 'admin/pj_klaster/list_approv'
		);

		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function cari_klaster()
	{
		$tmt         = $this->uri->segment(4);
		$sampai      = $this->uri->segment(5);
		$status      = $this->uri->segment(6);
		$id_klaster  = $this->session->userdata('id_klaster');
		$klast       = $this->Pjklaster_model->cari_klaster($tmt, $sampai, $id_klaster);


		if (isset($_POST['tmt'], $_POST['status_validasi']) && $_POST['status_validasi'] !== '0') {
			$periode = ($this->input->post('tmt') . '/' . $this->input->post('sampai') . '/' . $this->input->post('status_validasi') . '/' . $id_klaster);
			redirect(base_url('admin/pj_klaster/pencarian_klast/' . $periode), 'refresh');
		} else if (isset($_POST['tmt'])) {
			$periode = ($this->input->post('tmt') . '/' . $this->input->post('sampai') . '/' . $id_klaster);
			redirect(base_url('admin/pj_klaster/cari_klaster/' . $periode), 'refresh');
		}


		$data = array(
			'title'     => 'Hasil pencarian ',
			'tmt'       => $tmt,
			'sampai'       => $sampai,
			'status'     => $status,
			'id_klaster' => $id_klaster,
			'klast'     => $klast,
			'isi'       => 'admin/pj_klaster/list_approv'
		);

		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}
}
