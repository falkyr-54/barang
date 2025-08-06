<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pers_cuti_hist extends CI_Controller {
	
	// Load database
	public function __construct() {
		parent:: __construct();
		$this->load->model('pers_cuti_hist_model','cm');
		$this->load->model('reff_model','jm');
	}
	
	// Index
	public function index() {
		$nrk		= $this->session->userdata('nrk');		
		$jencuti	= $this->jm->jencuti();
		$cuti		= $this->cm->pegawai($nrk);
		$pejtt		= $this->reff_model->pejtt();
		// Validasi
		$valid = $this->form_validation;
		
		$valid->set_rules('tmt','Tanggal mulai cuti','required',
			array(	'required'	=> 'Tanggal mulai cuti harus diisi'));
					
		if($valid->run() == FALSE) {
		// End validasi
		
		$data = array(	'title'		=> 'Data cuti',
						'cuti'		=> $cuti,
						'jencuti'	=> $jencuti,
						'pejtt'		=> $pejtt,
						'isi' 		=> 'cuti/list');
		$this->load->view('layout/wrapper', $data);
		// Masuk database
		}else{
			$i = $this->input;
			$data = array(	'nrk'		=> $nrk,
							'tmt'		=> $i->post('tmt'),
							'jencuti'	=> $i->post('jencuti'),
							'tgakhir'	=> $i->post('tgakhir'),
							'nosk'		=> $i->post('nosk'),
							'tgsk'		=> $i->post('tgsk'),
							'pejtt'		=> $i->post('pejtt'),
							'tg_post'	=> date('Y-m-d H:i:s'),
							);
			$this->cm->tambah($data);
			$this->session->set_flashdata('sukses','Data telah ditambah');
			redirect(base_url('cuti'));
		}
		// End masuk database
	}
	
	// Index
	public function edit($id_pers_cuti_hist) {
		$nrk		= $this->session->userdata('nrk');		
		$jencuti	= $this->jm->jencuti();
		$cuti		= $this->cm->detail_pegawai($nrk,$id_pers_cuti_hist);
		$pejtt		= $this->reff_model->pejtt();
		// Validasi
		$valid = $this->form_validation;
		
		$valid->set_rules('tmt','Tanggal mulai cuti','required',
			array(	'required'	=> 'Tanggal mulai cuti harus diisi'));
					
		if($valid->run() == FALSE) {
		// End validasi
		
		$data = array(	'title'		=> 'Edit cuti',
						'cuti'		=> $cuti,
						'jencuti'	=> $jencuti,
						'pejtt'		=> $pejtt,
						'isi' 		=> 'cuti/edit');
		$this->load->view('layout/wrapper', $data);
		// Masuk database
		}else{
			$i = $this->input;
			$data = array(	'id_pers_cuti_hist'	=> $id_pers_cuti_hist,
							'nrk'				=> $nrk,
							'tmt'				=> $i->post('tmt'),
							'jencuti'			=> $i->post('jencuti'),
							'tgakhir'			=> $i->post('tgakhir'),
							'nosk'				=> $i->post('nosk'),
							'tgsk'				=> $i->post('tgsk'),
							'pejtt'				=> $i->post('pejtt'),
							);
			$this->cm->edit($data);
			$this->session->set_flashdata('sukses','Data telah diupdate');
			redirect(base_url('cuti'));
		}
		// End masuk database
	}

	
	// Hapus
	public function delete($id_pers_cuti_hist) {
		$data = array('id_pers_cuti_hist'	=> $id_pers_cuti_hist);
		$this->cm->delete($data);
		$this->session->set_flashdata('sukses','Data telah dihapus');
		redirect(base_url('pers_cuti_hist'));
	}
}