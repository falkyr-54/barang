<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detil_barang extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('brg_keluar_model');
		$this->load->model('Brg_keluar_model');
		$this->load->model('transaksi_servis_model');
		$this->load->model('penempatan_model');
	}

	public function index()
	{
		$list = $this->brg_keluar_model->listing_detil();

		$data = array(
			'title' => 'Data Aset IT',
			'list'	=> $list,
			'isi'	=> 'admin/detil_barang/list'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}



	public function riwayat($id_barang_keluar)
	{
		$detil				= $this->brg_keluar_model->detail($id_barang_keluar);
		$id_barang_keluar	= $detil['id_barang_keluar'];
		$servis				= $this->transaksi_servis_model->detail_barang($id_barang_keluar);
		$penempatan			= $this->penempatan_model->detail_barang($id_barang_keluar);
		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();

		$data = array(
			'title'			=> 'Detail barang: ',
			'detil'			=> $detil,
			'servis'		=> $servis,
			'expired6bulan'	=> $expired6bln,
			'expired3bulan'	=> $expired3bln,
			'expired1bulan'	=> $expired1bln,
			'penempatan'	=> $penempatan,
			'isi'			=> 'admin/detil_barang/riwayat'
		);
		$this->load->view('admin/layout/wrapper', $data);
	}


	public function getbarang()
	{

		$nama = trim($this->input->get('term')); //get term parameter sent via text field. Not sure how secure get() is

		$this->db->select('id_barang, nama_barang');
		$this->db->from('master_barang');
		$this->db->like('nama_barang', $nama);
		$this->db->limit('10');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$data['response'] = 'true'; //If nik exists set true
			$data['message'] = array();

			foreach ($query->result() as $row) {

				$data['message'][] = array(
					'label' 	=> $row->nama_barang,
					'value' 	=> $row->id_barang,
				);
			}
		} else {
			$data['response'] = 'false'; //Set false if user not valid
		}

		echo json_encode($data);
	}
}

  /* End of file Data_pegawai.php */
/* Location: ./application/controllers/Data_pegawai.php */