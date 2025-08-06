<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_servis extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('brg_keluar_model');
		$this->load->model('Brg_keluar_model');
		$this->load->model('unit_model');
		$this->load->model('rekanan_model');
		$this->load->model('transaksi_servis_model');
	}

	public function index()
	{
		$list = $this->transaksi_servis_model->listing();
		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();

		$data = array(
			'title' => 'Daftar barang servis',
			'list'	=> $list,
			'expired6bulan'	=> $expired6bln,
			'expired3bulan'	=> $expired3bln,
			'expired1bulan'	=> $expired1bln,
			'isi'	=> 'admin/transaksi_servis/list'
		);
		$this->load->view('admin/layout/wrapper', $data, FALSE);
	}


	public function tambah()
	{
		$rekanan 	= $this->rekanan_model->listing();
		$unit 		= $this->unit_model->listing();
		$barang 	= $this->brg_keluar_model->listing();
		$expired6bln = $this->Brg_keluar_model->list_expired6bulan();
		$expired3bln = $this->Brg_keluar_model->list_expired3bulan();
		$expired1bln = $this->Brg_keluar_model->list_expired1bulan();


		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules(
			'kerusakan',
			'kerusakan',
			'required',
			array('required'		=> 'kerusakan harus diisi')
		);

		if ($valid->run() === FALSE) {

			$data = array(
				'title'			=> 'Input data',
				'rekanan'		=> $rekanan,
				'unit'			=> $unit,
				'expired6bulan'	=> $expired6bln,
				'expired3bulan'	=> $expired3bln,
				'expired1bulan'	=> $expired1bln,
				'barang'		=> $barang,
				'isi'			=> 'admin/transaksi_servis/tambah'
			);
			$this->load->view('admin/layout/wrapper', $data);
			// Masuk database
		} else {
			$i 	= $this->input;
			$data = array(
				'id_barang_keluar'	    => $i->post('id_barang_keluar'),
				'id_unit'				=> $i->post('id_unit'),
				'id_satker'				=> $i->post('id_satker'),
				'id_rekanan'			=> $i->post('id_rekanan'),
				'kerusakan'				=> $i->post('kerusakan'),
				'tgl_servis'		    => $i->post('tgl_servis'),
				'pemberi_it'		    => $i->post('pemberi_it'),
				'penerima_servis'	    => $i->post('penerima_servis'),
				'status'			    => 'proses',
				'kerusakan'		    	=> $i->post('kerusakan'),
				'id_user'			    => $this->session->userdata('id')
			);
			// print_r($data);die();
			$this->transaksi_servis_model->tambah($data);
			$this->session->set_flashdata('sukses', 'Data servis berhasil ditambah');
			redirect(base_url('admin/transaksi_servis'));
		}
	}


	public function ubah($id_servis)
	{
		$servis	= $this->transaksi_servis_model->detail($id_servis);
		$rekanan 	= $this->rekanan_model->listing();

		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules(
			'harga',
			'harga',
			'required',
			array('required'		=> 'harga belum diisi')
		);

		if ($valid->run() === FALSE) {

			// End validasi

			$data = array(
				'title'		=> 'Ubah Data',
				'servis'				=> $servis,
				'rekanan'				=> $rekanan,
				'isi'					=> 'admin/transaksi_servis/ubah'
			);
			$this->load->view('admin/layout/wrapper', $data);
			// Masuk database
		} else {
			$i 	= $this->input;
			$data = array(
				'id_servis'	=> $id_servis,
				'id_rekanan'			=> $i->post('id_rekanan'),
				'kerusakan'				=> $i->post('kerusakan'),
				'tgl_servis'		    => $i->post('tgl_servis'),
				'tgl_selesai'		    => $i->post('tgl_selesai'),
				'status'			    => $i->post('status'),
				'keterangan'		    => $i->post('keterangan'),
				'harga'		   			=> $i->post('harga'),
				'penerima_it'			=> $i->post('penerima_it'),
				'pemberi_servis'		=> $i->post('pemberi_servis'),
				'id_user'			    => $this->session->userdata('id_user')
			);
			$this->transaksi_servis_model->ubah($data);
			$this->session->set_flashdata('sukses', 'Data ' . $servis['nama_barang'] . ' berhasil diubah');
			redirect(base_url('admin/transaksi_servis'));
		}
	}


	public function hapus($id_employee)
	{
		$id_employee 	= $this->uri->segment(4);
		$id_fasyankes = $this->uri->segment(5);

		$data = array('id_employee'	=> $id_employee);
		$this->pegawai_klinik_model->hapus($data);
		$this->session->set_flashdata('sukses', 'Data telah dihapus');
		redirect(base_url('admin/data_sdmk/datasdmk/' . $id_fasyankes));
	}

	public function getbarang()
	{

		$nama = trim($this->input->get('term')); //get term parameter sent via text field. Not sure how secure get() is

		$this->db->select('barang_keluar.*, ms_barang.nama_barang, unit_bagian.unit, unit_bagian.id_unit, satker.id_satker, satker.nama_satker,');
		$this->db->from('barang_keluar');
		$this->db->join('ms_barang', 'ms_barang.id_barang = barang_keluar.id_barang', 'left');
		$this->db->join('unit_bagian', 'unit_bagian.id_unit = barang_keluar.id_unit', 'left');
		$this->db->join('satker', 'satker.id_satker = barang_keluar.id_satker', 'left');
		// $this->db->join('penempatan', 'penempatan.id_barang_keluar = barang_keluar.id_barang_keluar', 'left');
		// $this->db->where('status <>', NULL);
		$this->db->like('seri', $nama);
		$this->db->limit('10');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {

			$data['response'] = 'true';
			$data['message'] = array();

			foreach ($query->result() as $row) {
				$data['message'][] = array(
					'label'  	=> $row->seri,
					'value'  	=> $row->id_barang_keluar,
					'nu'  		=> $row->unit,
					'sat'  		=> $row->nama_satker,
					'bar'  		=> $row->nama_barang,
					'unit'  	=> $row->id_unit,
					'satker'  	=> $row->id_satker,
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