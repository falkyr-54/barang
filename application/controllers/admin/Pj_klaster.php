<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Pj_klaster extends CI_Controller
{
	// Fungsi database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Pjklaster_model');
		$this->load->model('Brg_keluar_model');
		$this->load->model('Tahun_model');
	}


	public function index()
	{
		$id_klaster     = $this->session->userdata('id_klaster');
		
		$id_user_pj        = $this->session->userdata('id');
		$site 	= $this->konfigurasi_model->listing();
		$tahun 	= date('Y');
		$brg 	= $this->dasbor_model->terbaru($tahun);
		$listing = $this->Pjklaster_model->list_barang($id_klaster);

		$valid = $this->form_validation;
		
		$valid->set_rules('jumlah_keluar','Jumlah keluar','required',
			array('required'    => 'Jumlah keluar harus diisi'));
		
		if($valid->run() === FALSE) {

			$data = array(
				'title'		        => $site['namaweb'] . ' - ' . $site['tagline'],
				'tahun' 	        => $tahun,
				'brg'		        => $brg,
				'listing' 	        => $listing,
				'id_user_pj' 		=> $id_user_pj,
				'isi'		        => 'admin/pj_klaster/list');
			$this->load->view('admin/layout/wrapper', $data);


		}else{
			$i 	= $this->input;
			$data = array(	
				'id_barang_keluar'		=> $i->post('id_barang_keluar'),
				'jumlah_keluar'			=> $i->post('jumlah_keluar'),
				'id_user_pj'			=> $id_user_pj,
				'status_validasi'		=> 'acc_pj'
			);


			$this->Brg_keluar_model->update($data);
			$this->session->set_flashdata('sukses','Data divalidasi');
			redirect(base_url('admin/pj_klaster'));
		}

	}



	//pencarian aproval
	public function cari_approval()
	{

		$tmt 		= date('Y-m-01');
		$sampai 	= date('Y-m-31');
		$bulan 		= date('07');
		$tahun 		= date('2025');
		$id_user_pj = $this->session->userdata('id');
		$id_klaster = $this->session->userdata('id_klaster');
		$klast      = $this->Pjklaster_model->now($bulan,$tahun,$id_klaster);
		// $taun       = $this->tahun_model->list_thn();



		if (isset($_POST['tanggal_minta'])) 
		{
			$periode = ($this->input->post('tanggal_minta'));
			redirect(base_url('admin/pj_klaster/pencarian/'.$periode),'refresh');
		}


		$data = array(
			'title'         => 'List barang yang harus di approve',
			'tmt'           =>  $tmt,
			'sampai'        =>  $sampai,
			'klast'         =>  $klast,
			'id_klaster'    =>  $id_klaster,
			'id_user_pj'    =>  $id_user_pj,
			// 'taun'          =>  $taun,
			'isi'           => 'admin/pj_klaster/list_approv');

		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function approve($id_barang_keluar) {

		$id_klaster = $this->session->userdata('id_klaster');
		$libur     = $this->Pjklaster_model->detail($id_klaster,$id_barang_keluar);
		$tmt       = $this->uri->segment(5);
		$sampai    = $this->uri->segment(6);


		$i 	= $this->input;
		$data = array('id_barang_keluar'  => $id_barang_keluar,
			'jumlah_keluar'			=> $i->post('jumlah_keluar'),
			'status_validasi' => "acc_pj");

		$this->Brg_keluar_model->update($data);
		$this->session->set_flashdata('sukses','berhasil diapprove');
		redirect(base_url('admin/pj_klaster/cari_approval/'));
	}


	public function tolak($id_barang_keluar) {

		$id_klaster = $this->session->userdata('id_klaster');
		$libur     = $this->Pjklaster_model->detail($id_klaster,$id_barang_keluar);
		$tmt       = $this->uri->segment(5);
		$sampai    = $this->uri->segment(6);
		

		$i 	= $this->input;
		$data = array('id_barang_keluar'  => $id_barang_keluar,
			'jumlah_keluar'			=> $i->post('jumlah_keluar'),
			'status_validasi' => "tolak_pj");

		$this->Brg_keluar_model->update($data);
		$this->session->set_flashdata('sukses','berhasil diapprove');
		redirect(base_url('admin/pj_klaster/cari_approval/'));
	}



}