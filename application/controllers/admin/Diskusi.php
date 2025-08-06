<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diskusi extends CI_Controller {
	
	// Fungsi database
	public function __construct() {
		parent::__construct();
		$this->load->model('program_model');
		$this->load->model('tempat_model');
		$this->load->model('pengunjung_model');
		$this->load->model('notulen_model');
	}
	
	// Index
	public function index() {
		
		$notulen	= $this->notulen_model->listing();
		
		$dayList = array(
			'Sun' => 'Minggu',
			'Mon' => 'Senin',
			'Tue' => 'Selasa',
			'Wed' => 'Rabu',
			'Thu' => 'Kamis',
			'Fri' => 'Jumat',
			'Sat' => 'Sabtu'); 	

		$data = array(	
			'title'			=> 'Data Notulen',
			'notulen'	=> $notulen,
			'hari'		=> $dayList, 
			'isi'		=> 'admin/diskusi/list');
		$this->load->view('admin/layout/wrapper', $data);
	}
	
	
	public function tambah()
	{
		// $notulen=$this->notulen_model->listing();
		$tempat=$this->tempat_model->listing();
		$program=$this->program_model->listing();

		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules('pemateri','Pemateri','required',array('required'=>'Pemateri Harus diisi'));

		$valid->set_rules('notulensi','Notulen','required',array('required'=>'Notulen Harus diisi'));

		$valid->set_rules('pendamping','Pendamping','required',array('required'=>'Pendamping Harus diisi'));

		$valid->set_rules('judul','Judul Penyuluhan','required',
			array(	'required'		=> 'Judul Penyuluhan harus diisi'));

		if($valid->run()) {
			if(!empty($_FILES['gambar']['name'])) {

				$config['upload_path'] 		= './assets/upload/gambar_kegiatan/';
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
				$config['max_size']			= '1000'; // KB	 atau 1MB		
				$this->load->library('upload', $config);
				if(! $this->upload->do_upload('gambar')) {

				// End validasi
					$data=array(
						'title'	=> 'Masukkan Data Notulensi',
						'tempat'=>$tempat,
						'program'=>$program,
						'isi'	=> 'admin/notulen/tambah');
					$this->load->view('admin/layout/wrapper',$data);
		// Masuk database
				}else{
					$upload_data				= array('uploads' =>$this->upload->data());

			// Image Editor
					$config['image_library']	= 'gd2';
					$config['source_image'] 	= './assets/upload/gambar_kegiatan/'.$upload_data['uploads']['file_name'];
					$config['new_image'] 		= './assets/upload/gambar_kegiatan/thumbs/';
					$config['create_thumb'] 	= TRUE;
					$config['maintain_ratio'] 	= TRUE;
			$config['width'] 			= 150; // Pixel
			$config['height'] 			= 150; // Pixel
			$config['thumb_marker'] 	= '';
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			
			// Masuk ke database
			$i 	= $this->input;
			//get url image to database
			$fullPath = base_url() .'assets/upload/gambar_kegiatan/thumbs/'. $upload_data['uploads']['file_name'];
			$data = array(	
				'id_program'		=> $i->post('id_program'),
				'id_tempat'			=> $i->post('id_tempat'),
				'tm'				=> $i->post('tm'),
				'mu'				=> $i->post('mu'),
				'ms'				=> $i->post('ms'),
				'total_hadir'		=> $i->post('total_hadir'),
				'judul'				=> $i->post('judul'),
				'notulensi'			=> $i->post('notulensi'),
				'pemateri'			=> $i->post('pemateri'),
				'pendamping'		=> $i->post('pendamping'),
				'jam'				=> $i->post('jam'),
				'tanggal'			=> $i->post('tanggal'),
				'gambar'			=> $$fullPaths
				
			);
			$this->notulen_model->tambah($data);
			$this->session->set_flashdata('sukses','Data Notulen telah ditambah');
			redirect(base_url('admin/notulen'));
		}}
		else{
			$i 	= $this->input;
			$data = array(	'id_program'		=> $i->post('id_program'),
				'id_tempat'			=> $i->post('id_tempat'),
				'tm'				=> $i->post('tm'),
				'mu'				=> $i->post('mu'),
				'ms'				=> $i->post('ms'),
				'total_hadir'		=> $i->post('total_hadir'),
				'judul'				=> $i->post('judul'),
				'notulensi'			=> $i->post('notulensi'),
				'pemateri'			=> $i->post('pemateri'),
				'pendamping'		=> $i->post('pendamping'),
				'jam'				=> $i->post('jam'),
				'tanggal'			=> $i->post('tanggal')

			);
			$this->notulen_model->tambah($data);
			$this->session->set_flashdata('sukses','Data Notulen telah ditambah');
			redirect(base_url('admin/notulen'));
		}}
		// End masuk database
		$data=array(
			'title'	=> 'Masukkan Data Notulensi',
			'tempat'=>$tempat,
			'program'=>$program,
			'isi'	=> 'admin/notulen/tambah');
		$this->load->view('admin/layout/wrapper',$data);
	}

	public function gettempat()
	{

              $nama = trim($this->input->get('term')); //get term parameter sent via text field. Not sure how secure get() is

              $this->db->select('tempat, jenis_tempat, wilayah, id_tempat'); 
              $this->db->from('master_tempat');
              $this->db->like('tempat', $nama);
              // $this->db->where(array('j_kel'=>'perempuan'));
              $this->db->limit('10');
              $query = $this->db->get();

              if ($query->num_rows() > 0) 
              {
                  $data['response'] = 'true'; //If nik exists set true
                  $data['message'] = array(); 

                  foreach ($query->result() as $row)
                  {

                  	$data['message'][] = array(  
                  		'label' 	=> $row->tempat,
                  		'value' 	=> $row->id_tempat,
                  		'jenis'  	=> $row->jenis_tempat,
                  		'wilayah'  => $row->wilayah,
                  	);
                  }    
              } 
              else
              {
                  $data['response'] = 'false'; //Set false if user not valid
              }

              echo json_encode($data);
          } 

          //FUNGSI EDIT
          public function edit($id_notulen)
          {
          	$notulen = $this->notulen_model->notulen_detail($id_notulen);
          	$tempat=$this->tempat_model->listing();
          	$program=$this->program_model->listing();

          	$valid = $this->form_validation;

          	$valid->set_rules('pemateri','Pemateri','required',array('required'=>'Pemateri Harus diisi'));

          	$valid->set_rules('notulensi','Notulen','required',array('required'=>'Notulen Harus diisi'));

          	$valid->set_rules('pendamping','Pendamping','required',array('required'=>'Pendamping Harus diisi'));

          	$valid->set_rules('judul','Judul Penyuluhan','required',
          		array(	'required'		=> 'Judul Penyuluhan harus diisi'));

          	if($valid->run()) {
          		if(!empty($_FILES['gambar']['name'])) {

          			$config['upload_path'] 		= './assets/upload/gambar_kegiatan/';
          			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
			$config['max_size']			= '2000'; // KB	 atau 2MB		
			$this->load->library('upload', $config);
			if(! $this->upload->do_upload('gambar'))  {
		// End validasi

				$data = array(	'title'		=> 'Edit Notulen',
					'notulen'	=> $notulen,
					'program'	=> $program,
					'tempat'	=> $tempat,
					'isi'		=> 'admin/notulen/edit');
				$this->load->view('admin/layout/wrapper',$data);
		// Masuk database
			}else{
				$upload_data				= array('uploads' =>$this->upload->data());
				// Image Editor
				$config['image_library']	= 'gd2';
				$config['source_image'] 	= './assets/upload/gambar_kegiatan/'.$upload_data['uploads']['file_name']; 
				$config['new_image'] 		= './assets/upload/gambar_kegiatan/thumbs/';
				$config['create_thumb'] 	= TRUE;
				$config['maintain_ratio'] 	= TRUE;
				$config['width'] 			= 150; // Pixel
				$config['height'] 			= 150; // Pixel
				$config['thumb_marker'] 	= '';
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				
				// Hapus gambar lama
				if($notulen['gambar']!="") {
					unlink('./assets/upload/gambar_kegiatan/'.$notulen['gambar']);
					unlink('./assets/upload/gambar_kegiatan/thumbs/'.$notulen['gambar']);
				}
				// End hapus gambar lama
				
				$i 	= $this->input;
				$fullPath = base_url() .'assets/upload/gambar_kegiatan/thumbs/'. $upload_data['uploads']['file_name'];
				$data = array(	'id_notulen'			=> $id_notulen,
					'id_program'		=> $i->post('id_program'),
					'id_tempat'			=> $i->post('id_tempat'),
					'tm'				=> $i->post('tm'),
					'mu'				=> $i->post('mu'),
					'ms'				=> $i->post('ms'),
					'total_hadir'		=> $i->post('total_hadir'),
					'judul'				=> $i->post('judul'),
					'notulensi'			=> $i->post('notulensi'),
					'pemateri'			=> $i->post('pemateri'),
					'pendamping'		=> $i->post('pendamping'),
					'jam'				=> $i->post('jam'),
					'tanggal'			=> $i->post('tanggal'),
					'gambar'			=> $fullPath
					
				);
				$this->notulen_model->edit($data);
				$this->session->set_flashdata('sukses','Data berhasil diubah');
				redirect(base_url('admin/notulen'));
			}}else{
				$i 	= $this->input;
				$data = array(	'id_notulen'			=> $id_notulen,
					'id_program'		=> $i->post('id_program'),
					'id_tempat'			=> $i->post('id_tempat'),
					'tm'				=> $i->post('tm'),
					'mu'				=> $i->post('mu'),
					'ms'				=> $i->post('ms'),
					'total_hadir'		=> $i->post('total_hadir'),
					'judul'				=> $i->post('judul'),
					'notulensi'			=> $i->post('notulensi'),
					'pemateri'			=> $i->post('pemateri'),
					'pendamping'		=> $i->post('pendamping'),
					'jam'				=> $i->post('jam'),
					'tanggal'			=> $i->post('tanggal'),
				);
				$this->notulen_model->edit($data);
				$this->session->set_flashdata('sukses','Data berhasil diubah');
				redirect(base_url('admin/notulen'));
			}
		}
		// End masuk database
		$data = array(	'title'		=> 'Edit Notulensi',
			'notulen'	=> $notulen,
			'program'	=> $program,
			'tempat'	=> $tempat,
			'isi'		=> 'admin/notulen/edit');
		$this->load->view('admin/layout/wrapper',$data);
	}



	// Hapus
	public function delete($id_notulen) {
		$notulen 	= $this->notulen_model->detail($id_notulen);
		$nip	= $pegawai['nip'];
		// Hapus gambar
		if($notulen['gambar']!="") {
			unlink('./assets/upload/image/'.$notulen['gambar']);
		}

		$data = array('id_notulen'	=> $id_notulen);

		$this->notulen_model->delete($data);
		$this->session->set_flashdata('sukses','Data notulen telah dihapus');
		redirect(base_url('admin/notulen/'));
	}
}