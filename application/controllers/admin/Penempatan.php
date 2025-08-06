<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penempatan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
			//Do your magic here
		$this->load->model('penempatan_model');
		$this->load->model('detil_barang_model');
		$this->load->model('unit_model');
		$this->load->model('satker_model');
	}

	// Index
	public function index() {
		$unit		= $this->unit_model->listing();
		$satker		= $this->satker_model->listing();
		$list 		= $this->penempatan_model->listing();

		$data = array(	'title'		=> 'Data penempatan barang IT',
			'satker'	=> $satker, 
			'unit'		=> $unit, 
			'list'		=> $list, 
			'isi'		=> 'admin/penempatan/list');
		$this->load->view('admin/layout/wrapper',$data);
		// Masuk database
	}


	public function tambah_baru()
	{	

		$id_detil 	= $this->uri->segment(4);
		$satker 	= $this->satker_model->listing();
		$unit		= $this->unit_model->listing();
		$detail 	= $this->detil_barang_model->detail($id_detil);

		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules('penerima','penerima','required[penempatan.penerima]',
			array(	'required'		=> 'Penerima harus diisi'));
		
		$valid->set_rules('tgl_penempatan','tgl_penempatan','required[penempatan.tgl_penempatan]',
			array(	'required'		=> 'tgl_penempatan barang harus diisi'));

		if($valid->run()===FALSE) {

			$data = array(	
				'title'		=> 'Tambah riwayat data penempatan barang',
				'unit'		=> $unit,
				'satker'	=> $satker,
				'id_detil'	=> $id_detil,
				'detail'	=> $detail,
				'isi'		=> 'admin/penempatan/tambah_baru');
			$this->load->view('admin/layout/wrapper',$data);
		// Masuk database
		}else{

			$i 	= $this->input;
			$data = array(
				'id_detil'				=> $i->post('id_detil'),
				'id_jenis'				=> $i->post('id_jenis'),
				'id_unit'				=> $i->post('id_unit'),
				'id_satker'				=> $i->post('id_satker'),
				'tgl_penempatan'		=> $i->post('tgl_penempatan'),
				'penerima'				=> $i->post('penerima'),
				'status'				=> "Aktif"
			);
			$this->penempatan_model->tambah($data);
			$this->session->set_flashdata('sukses','Data master barang berhasil ditambah');
			redirect(base_url('admin/detil_barang/riwayat'.'/'.$id_detil));
		}
		// End masuk database
		$data = array(	
			'title'		=> 'Tambah Barang',
			'satker'	=> $satker,
			'unit'		=> $unit,
			'isi'		=> 'admin/penempatan/tambah');
		$this->load->view('admin/layout/wrapper',$data);
	}




	public function tambah()
	{	

		$id_unit 	= $this->uri->segment(4);
		$id_satker 	= $this->uri->segment(5);
		// $satker 	= $this->satker_model->listing();
		// $unit	= $this->unit_model->listing();

		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules('penerima','penerima','required[penempatan.penerima]',
			array(	'required'		=> 'Penerima harus diisi'));
		
		$valid->set_rules('tgl_penempatan','tgl_penempatan','required[penempatan.tgl_penempatan]',
			array(	'required'		=> 'tgl_penempatan barang harus diisi'));

		if($valid->run()===FALSE) {

			$data = array(	
				'title'		=> 'Tambah data penempatan barang unit',
				'unit'		=> $unit,
				'satker'	=> $satker,
				'isi'		=> 'admin/penempatan/tambah');
			$this->load->view('admin/layout/wrapper',$data);
		// Masuk database
		}else{

			$i 	= $this->input;
			$data = array(
				'id_detil'				=> $i->post('id_detil'),
				'id_jenis'				=> $i->post('id_jenis'),
				'id_unit'				=> $i->post('id_unit'),
				'id_satker'				=> $i->post('id_satker'),
				'tgl_penempatan'		=> $i->post('tgl_penempatan'),
				'penerima'				=> $i->post('penerima'),
				'status'				=> "Aktif"
			);
			$this->penempatan_model->tambah($data);
			$this->session->set_flashdata('sukses','Data master barang berhasil ditambah');
			redirect(base_url('admin/penempatan/list_unit_brg'.'/'.$id_unit.'/'.$id_satker));
		}
	}

	

	public function ubah($id_tempat)
	{
		$tempat		= $this->penempatan_model->detail($id_tempat);

		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules('penerima','penerima','required',
			array(	'required'		=> 'penerima belum diisi'));

		if($valid->run()===FALSE) {
			
		// End validasi

			$data = array(	'title'		=> 'Ubah Data',
				'tempat'				=> $tempat,
				'isi'					=> 'admin/penempatan/ubah');
			$this->load->view('admin/layout/wrapper',$data);
		// Masuk database
		}else{
			$i 	= $this->input;
			$data = array('id_tempat'	=> $id_tempat,
				'tgl_penempatan'		=> $i->post('tgl_penempatan'),
				'penerima'				=> $i->post('penerima'),
				'status'				=> $i->post('status')
			);
			$this->penempatan_model->ubah($data);
			$this->session->set_flashdata('sukses','Data '.$tempat['nama_jenis'].' berhasil diubah');
			redirect(base_url('admin/detil_barang/riwayat'.'/'.$tempat['id_detil']));	
		}
	}


	// list unit
	public function list_unit($id_satker) {

		$id_satker	= $this->uri->segment(4);
		$satker 	= $this->satker_model->detail_satker($id_satker);
		$unit		= $this->unit_model->listing_satker($id_satker);
		
		// Validasi
		$valid = $this->form_validation;
		
		if($valid->run() === FALSE) {
		// End validasi
			
			$data = array(	'title'		=> 'Unit '.$satker['nama_satker'],
				'satker'	=> $satker,
				'unit'		=> $unit,
				'isi'		=> 'admin/penempatan/list_unit');
			$this->load->view('admin/layout/wrapper',$data);
		}
		// End masuk database		
	}

	public function getbarang()
	{

  		$nama = trim($this->input->get('term')); //get term parameter sent via text field. Not sure how secure get() is

  		$this->db->select('detil_barang.*, master_barang.type, master_barang.merk, penempatan.status'); 
  		$this->db->from('detil_barang');
  		$this->db->join('master_barang', 'master_barang.id_barang = detil_barang.id_barang', 'left');
  		$this->db->join('penempatan', 'penempatan.id_detil = detil_barang.id_detil', 'left');
  		$this->db->where('status', NULL);
  		$this->db->like('type', $nama);
  		$this->db->limit('5');
  		$query = $this->db->get();

  		if ($query->num_rows() > 0) 
  		{

  			$data['response'] = 'true'; 
  			$data['message'] = array(); 

  			foreach ($query->result() as $row)
  			{ 
  				$data['message'][] = array(  
  					'label'  	=> $row->merk.' '.$row->type.'-'.$row->kd_barang,
  					'value'  	=> $row->id_detil,
  					'jenis'  	=> $row->id_jenis,
  				);
  			}    
  		} 
  		else
  		{ $data['response'] = 'false'; //Set false if user not valid
  }

  echo json_encode($data);
} 

public function list_unit_brg($id_unit,$id_satker)
{
	$id_unit	= $this->uri->segment(4);
	$id_satker	= $this->uri->segment(5);
	$satker 	= $this->satker_model->detail_satker($id_satker);
	$unit 		= $this->unit_model->detail($id_unit);
	$tempat		= $this->penempatan_model->unit_brg($id_unit,$id_satker);

		// Validasi
	$valid = $this->form_validation;

	$valid->set_rules('nama_sub_kategori','Nama','required',
		array(	'required'		=> 'Nama sub kategori harus diisi'));

	if($valid->run() === FALSE) {
		// End validasi

		$data = array(	'title'		=> 'Unit '.$unit['unit'].' '.$satker['nama_satker'],
			'tempat'	=> $tempat,
			'satker'	=> $satker,
			'id_satker'	=> $id_satker,
			'id_unit'	=> $id_unit,
			'unit'		=> $unit,
			'isi'		=> 'admin/penempatan/list_unit_brg');
		$this->load->view('admin/layout/wrapper',$data);
		// Masuk database
	}else{

		$i 	= $this->input;
		$data = array(
			'id_detil'				=> $i->post('id_detil'),
			'id_jenis'				=> $i->post('id_jenis'),
			'id_unit'				=> $i->post('id_unit'),
			'id_satker'				=> $i->post('id_satker'),
			'tgl_penempatan'		=> $i->post('tgl_penempatan'),
			'penerima'				=> $i->post('penerima'),
			'status'				=> "Aktif"
		);
		$this->penempatan_model->tambah($data);
		$this->session->set_flashdata('sukses','Data master barang berhasil ditambah');
		redirect(base_url('admin/penempatan/list_unit_brg'.'/'.$id_unit.'/'.$id_satker));
	}
}




}

/* End of file Data_pegawai.php */
/* Location: ./application/controllers/Data_pegawai.php */