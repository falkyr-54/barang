<?php
defined('BASEPATH') or exit('No direct script access allowed');


class admin_barang extends CI_Controller
{
	// Fungsi database
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_brg_model');
		$this->load->model('Brg_keluar_model');
		$this->load->model('Brg_masuk_model');
		$this->load->model('Tahun_model');
		$this->load->model('Barang_model');
	}


	public function index()
	{

		$tmt 		= date('Y-m-01');
		$sampai 	= date('Y-m-31');
		$bulan 		= date('m');
		$tahun 		= date('Y');
		$status 	= 'belum';
		$id_user_admin = $this->session->userdata('id');
		$klast      = $this->Admin_brg_model->now($bulan,$tahun);

		// $taun       = $this->tahun_model->list_thn();


		if (isset($_POST['tanggal_minta'])) 
		{
			$periode = ($this->input->post('tanggal_minta'));
			redirect(base_url('admin/admin_barang/pencarian/'.$periode),'refresh');
		}


		$data = array(
			'title'         => 'List barang yang harus di approve',
			'tmt'           =>  $tmt,
			'sampai'        =>  $sampai,
			'klast'         =>  $klast,
			'status'         =>  $status,
			'id_user_admin' =>  $id_user_admin,
			'isi'           => 'admin/admin_barang/list_approv');

		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}


	

	public function approve($id_barang_keluar) {

		$id_pengurus = $this->session->userdata('id');
		$libur     = $this->Admin_brg_model->detail($id_barang_keluar);
		$tmt       = $this->uri->segment(5);
		$sampai    = $this->uri->segment(6);

		// $id_barang 		 = $libur['id_barang'];
		// $id_barang_masuk = $libur['id_barang_masuk'];
		// $barang_jml      = $this->Brg_masuk_model->detail_brg($id_barang, $id_barang_masuk);
		// $stok_id         = $this->Brg_keluar_model->get_total_id($id_barang, $id_barang_masuk);
		// $check           = $barang_jml['jumlah'] - $stok_id['total'];

		$i 	= $this->input;
		$data = array(
			'id_barang_keluar'  => $id_barang_keluar,
			'id_pengurus'	    => $id_pengurus,
			'jumlah_keluar'	    => $i->post('jumlah_keluar'),
			'tgl_edit'          => date('Y-m-d H:i:s'),
			'status_validasi'   => 'acc_p');

		if ($i->post('jumlah_keluar') > $i->post('hasil')) {
			$this->session->set_flashdata('gagal', 'STOK PERMINTAAN MELEBIHI STOK BARANG TERSEDIA !');
			redirect(base_url('admin/admin_barang/'));
		} else{
			$this->Brg_keluar_model->update($data);
			$this->session->set_flashdata('sukses','berhasil diapprove');
			redirect(base_url('admin/admin_barang/'));
		}

		
	}


	public function tolak($id_barang_keluar) {

		$id_pengurus = $this->session->userdata('id');
		$libur     = $this->Admin_brg_model->detail($id_barang_keluar);
		$tmt       = $this->uri->segment(5);
		$sampai    = $this->uri->segment(6);
		

		$i 	= $this->input;
		$data = array('id_barang_keluar'  => $id_barang_keluar,
			'jumlah_keluar'			=> 0,
			'id_pengurus'			=> $id_pengurus,
			'tgl_edit'          => date('Y-m-d H:i:s'),
			'status_validasi' => 'tolak_p');

		$this->Brg_keluar_model->update($data);
		$this->session->set_flashdata('sukses','permintaan ditolak');
		redirect(base_url('admin/admin_barang/'));
	}


	public function pencarian()
	{
		$tmt         = $this->uri->segment(4);
		$sampai      = $this->uri->segment(5);
		$status      = $this->uri->segment(6);
		$id_klaster  = $this->session->userdata('id_klaster');
		$klast       = $this->Admin_brg_model->pencarian($tmt,$sampai,$status);

		if(isset($_POST['tmt'], $_POST['status_validasi']) && $_POST['status_validasi'] !== '0')
		{
			$periode = ($this->input->post('tmt').'/'.$this->input->post('sampai').'/'.$this->input->post('status_validasi'));
			redirect(base_url('admin/admin_barang/pencarian/'.$periode),'refresh');
		}else if(isset($_POST['tmt'])) {
			$periode = ($this->input->post('tmt') . '/' . $this->input->post('sampai'));
			redirect(base_url('admin/admin_barang/cari_klast/' . $periode), 'refresh');
		}



		$data = array(
			'title'     => 'Hasil pencarian ',
			'tmt'       => $tmt,
			'sampai'       => $sampai,
			'status'     => $status,
			'id_klaster' => $id_klaster,
			'klast'     => $klast,
			'isi'       => 'admin/admin_barang/list_approv');

		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}

	public function cari_klast()
	{
		$tmt         = $this->uri->segment(4);
		$sampai      = $this->uri->segment(5);
		$status      = $this->uri->segment(6);
		$id_klaster  = $this->session->userdata('id_klaster');
		$klast       = $this->Admin_brg_model->cari_klast($tmt,$sampai);

		
		if(isset($_POST['tmt'], $_POST['status_validasi']) && $_POST['status_validasi'] !== '0')
		{
			$periode = ($this->input->post('tmt').'/'.$this->input->post('sampai').'/'.$this->input->post('status_validasi'));
			redirect(base_url('admin/admin_barang/pencarian/'.$periode),'refresh');
		}else if(isset($_POST['tmt'])) {
			$periode = ($this->input->post('tmt') . '/' . $this->input->post('sampai'));
			redirect(base_url('admin/admin_barang/cari_klast/' . $periode), 'refresh');
		}


		$data = array(
			'title'     => 'Hasil pencarian ',
			'tmt'       => $tmt,
			'sampai'       => $sampai,
			'status'     => $status,
			'id_klaster' => $id_klaster,
			'klast'     => $klast,
			'isi'       => 'admin/admin_barang/list_approv');

		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}


}