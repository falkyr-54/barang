<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notulen extends CI_Controller {
	
	// Fungsi database
	public function __construct() {
		parent::__construct();
		$this->load->model('program_model');
		$this->load->model('tempat_model');
		$this->load->model('pengunjung_model');
		$this->load->model('notulen_model');
		$this->load->model('diskusi_model');
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
			'isi'		=> 'admin/notulen/list');
		$this->load->view('admin/layout/wrapper', $data);
	}
	
	
	public function tambah()
	{
		// $notulen=$this->notulen_model->listing();
		$tempat=$this->tempat_model->listing();
		$program=$this->program_model->listing();

		$data=array(
			'title'	=> 'Masukkan Data Notulensi',
			'tempat'=>$tempat,
			'program'=>$program,
			'isi'	=> 'admin/notulen/tambah');
		$this->load->view('admin/layout/wrapper',$data);


		// Validasi
		$valid = $this->form_validation;

		$valid->set_rules('pemateri','Pemateri','required',array('required'=>'Pemateri Harus diisi'));

		$valid->set_rules('notulensi','Notulen','required',array('required'=>'Notulen Harus diisi'));

		$valid->set_rules('pendamping','Pendamping','required',array('required'=>'Pendamping Harus diisi'));

		$valid->set_rules('judul','Judul Penyuluhan','required',
			array(	'required'		=> 'Judul Penyuluhan harus diisi'));

		if($valid->run())  
		{
			// Masuk ke database
			$i 	= $this->input;
			
			$datanotulen = array(	
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
				'tanggal'			=> $i->post('tanggal')
				// 'gambar'			=> $$fullPaths
				
			);
			$inputnotulen = $this->db->insert('notulen',$datanotulen);

			if ($inputnotulen) {
				$id = $this->db->insert_id();
				foreach ($_POST['nama'] as $key=> $value) {
					$data = array(
						'id_notulen'=>$id,
						'nama'=>$_POST['nama'][$key],
						'umur'=>$_POST['umur'][$key],
						'pertanyaan'=>$_POST['pertanyaan'][$key],
						'jawaban'=>$_POST['jawaban'][$key]
					);
					$this->db->insert('diskusi',$data);
				}

				$this->session->set_flashdata('sukses','Data Notulen telah ditambah');
				redirect('admin/Notulen');
			}

		}

	}

		// End masuk database




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
               $id_notulen=$notulen['id_notulen'];
               $diskusi=$this->diskusi_model->detail_diskusi($id_notulen);
          	// print_r($diskusi);die;

               $data = array(	'title'		=> 'Edit Notulen',
                'notulen'	=> $notulen,
                'program'	=> $program,
                'tempat'	=> $tempat,
                'diskusi'	=> $diskusi,
                'isi'		=> 'admin/notulen/edit');
               $this->load->view('admin/layout/wrapper',$data);

               $valid = $this->form_validation;

               $valid->set_rules('pemateri','Pemateri','required',array('required'=>'Pemateri Harus diisi'));

               $valid->set_rules('notulensi','Notulen','required',array('required'=>'Notulen Harus diisi'));

               $valid->set_rules('pendamping','Pendamping','required',array('required'=>'Pendamping Harus diisi'));

               $valid->set_rules('judul','Judul Penyuluhan','required',
                array(	'required'		=> 'Judul Penyuluhan harus diisi'));

               if($valid->run()) {

                $i 	= $this->input;
                $datanotulen = array(	'id_notulen'			=> $id_notulen,
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
					// 'gambar'			=> $fullPath

               );


                $this->db->where('id_notulen',$id_notulen);
                $inputnotulen = $this->db->update('notulen',$datanotulen);
                // exit;

                if ($inputnotulen) {

                 foreach ($_POST['nama'] as $key=> $value) {
                  $data = array(
                   'id_notulen'=>$id_notulen,
                   'nama'=>$_POST['nama'][$key],
                   'umur'=>$_POST['umur'][$key],
                   'pertanyaan'=>$_POST['pertanyaan'][$key],
          					// 'id_diskusi'=>$_POST['id_diskusi'][$key],
                   'jawaban'=>$_POST['jawaban'][$key]
                 );

                  // print_r($data)
                  // exit;
                  $this->db->where('id_diskusi',$_POST['id_diskusi'][$key]);
                  $post=$this->db->update('diskusi',$data);
                }

                $this->session->set_flashdata('sukses','Data berhasil diubah');
                redirect(base_url('admin/notulen'));
              }
            }
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