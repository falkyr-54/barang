<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tanggal
{
	protected $CI;

	public function __construct()
	{
        $this->CI =& get_instance();
	}

	// Sitename
	public function namaweb()
	{
		$site = $this->CI->konfigurasi_model->listing();
		return $site->namaweb;
	}

	// Alamat
	public function logo()
	{
		$site 	= $this->CI->konfigurasi_model->listing();
		$logo 	= base_url('assets/upload/image/'.$site->logo);
		return $logo;
	}

	// Alamat
	public function icon()
	{
		$site 	= $this->CI->konfigurasi_model->listing();
		$icon 	= base_url('assets/upload/image/'.$site->icon);
		return $icon;
	}

	// Romawi
	public function romawi($bulan)
	{
		if($bulan=='01') {
			$romawi = 'Januari';
		}elseif($bulan=='02') {
			$romawi = 'Februari';
		}elseif($bulan=='03') {
			$romawi = 'Maret';
		}elseif($bulan=='04') {
			$romawi = 'April';
		}elseif($bulan=='05') {
			$romawi = 'Mei';
		}elseif($bulan=='06') {
			$romawi = 'Juni';
		}elseif($bulan=='07') {
			$romawi = 'Juli';
		}elseif($bulan=='08') {
			$romawi = 'Agustus';
		}elseif($bulan=='09') {
			$romawi = 'September';
		}elseif($bulan=='10') {
			$romawi = 'Oktober';
		}elseif($bulan=='11') {
			$romawi = 'November';
		}elseif($bulan=='12') {
			$romawi = 'Desember';
		}
		return $romawi;
	}

	// Romawi
	public function bulan($tanggal)
	{
		$tahun 	= date('Y',strtotime($tanggal));
		$bulan 	= date('m',strtotime($tanggal));
		$hari 	= date('l',strtotime($tanggal));

		if($bulan=='01') {
			$nama_bulan = 'Januari';
		}elseif($bulan=='02') {
			$nama_bulan = 'Februari';
		}elseif($bulan=='03') {
			$nama_bulan = 'Maret';
		}elseif($bulan=='04') {
			$nama_bulan = 'April';
		}elseif($bulan=='05') {
			$nama_bulan = 'Mei';
		}elseif($bulan=='06') {
			$nama_bulan = 'Juni';
		}elseif($bulan=='07') {
			$nama_bulan = 'Juli';
		}elseif($bulan=='08') {
			$nama_bulan = 'Agustus';
		}elseif($bulan=='09') {
			$nama_bulan = 'September';
		}elseif($bulan=='10') {
			$nama_bulan = 'Oktober';
		}elseif($bulan=='11') {
			$nama_bulan = 'November';
		}elseif($bulan=='12') {
			$nama_bulan = 'Desember';
		}
		$hasil 	= $nama_bulan. ' '.$tahun;
		return $hasil;
	}

	// Romawi
	public function bulan_pendek($bulan)
	{
		if($bulan=='01') {
			$nama_bulan_pendek = 'Jan';
		}elseif($bulan=='02') {
			$nama_bulan_pendek = 'Feb';
		}elseif($bulan=='03') {
			$nama_bulan_pendek = 'Mar';
		}elseif($bulan=='04') {
			$nama_bulan_pendek = 'Apr';
		}elseif($bulan=='05') {
			$nama_bulan_pendek = 'Mei';
		}elseif($bulan=='06') {
			$nama_bulan_pendek = 'Jun';
		}elseif($bulan=='07') {
			$nama_bulan_pendek = 'Jul';
		}elseif($bulan=='08') {
			$nama_bulan_pendek = 'Agus';
		}elseif($bulan=='09') {
			$nama_bulan_pendek = 'Sep';
		}elseif($bulan=='10') {
			$nama_bulan_pendek = 'Okt';
		}elseif($bulan=='11') {
			$nama_bulan_pendek = 'Nov';
		}elseif($bulan=='12') {
			$nama_bulan_pendek = 'Des';
		}
		return $nama_bulan_pendek;
	}

	// Romawi
	public function hari($tanggal)
	{
		$bulan 	= date('m',strtotime($tanggal));
		$hari 	= date('l',strtotime($tanggal));

		if($hari=='Sunday') {
			$nama_hari = 'Minggu';
		}elseif($hari=='Monday') {
			$nama_hari = 'Senin';
		}elseif($hari=='Tuesday') {
			$nama_hari = 'Selasa';
		}elseif($hari=='Wednesday') {
			$nama_hari = 'Rabu';
		}elseif($hari=='Thursday') {
			$nama_hari = 'Kamis';
		}elseif($hari=='Friday') {
			$nama_hari = 'Jumat';
		}elseif($hari=='Saturday') {
			$nama_hari = 'Sabtu';
		}

		if($bulan=='01') {
			$nama_bulan = 'Januari';
		}elseif($bulan=='02') {
			$nama_bulan = 'Februari';
		}elseif($bulan=='03') {
			$nama_bulan = 'Maret';
		}elseif($bulan=='04') {
			$nama_bulan = 'April';
		}elseif($bulan=='05') {
			$nama_bulan = 'Mei';
		}elseif($bulan=='06') {
			$nama_bulan = 'Juni';
		}elseif($bulan=='07') {
			$nama_bulan = 'Juli';
		}elseif($bulan=='08') {
			$nama_bulan = 'Agustus';
		}elseif($bulan=='09') {
			$nama_bulan = 'September';
		}elseif($bulan=='10') {
			$nama_bulan = 'Oktober';
		}elseif($bulan=='11') {
			$nama_bulan = 'November';
		}elseif($bulan=='12') {
			$nama_bulan = 'Desember';
		}

		$hasil = $nama_hari.', '.date('d',strtotime($tanggal)).' '.$nama_bulan.' '.date('Y',strtotime($tanggal));
		return $hasil;
	}

	// tanggal_bulan
	public function tanggal_bulan($tanggal)
	{
		$bulan 	= date('m',strtotime($tanggal));
		$hari 	= date('l',strtotime($tanggal));

		if($hari=='Sunday') {
			$nama_hari = 'Minggu';
		}elseif($hari=='Monday') {
			$nama_hari = 'Senin';
		}elseif($hari=='Tuesday') {
			$nama_hari = 'Selasa';
		}elseif($hari=='Wednesday') {
			$nama_hari = 'Rabu';
		}elseif($hari=='Thursday') {
			$nama_hari = 'Kamis';
		}elseif($hari=='Friday') {
			$nama_hari = 'Jumat';
		}elseif($hari=='Saturday') {
			$nama_hari = 'Sabtu';
		}

		if($bulan=='01') {
			$nama_bulan = 'Januari';
		}elseif($bulan=='02') {
			$nama_bulan = 'Februari';
		}elseif($bulan=='03') {
			$nama_bulan = 'Maret';
		}elseif($bulan=='04') {
			$nama_bulan = 'April';
		}elseif($bulan=='05') {
			$nama_bulan = 'Mei';
		}elseif($bulan=='06') {
			$nama_bulan = 'Juni';
		}elseif($bulan=='07') {
			$nama_bulan = 'Juli';
		}elseif($bulan=='08') {
			$nama_bulan = 'Agustus';
		}elseif($bulan=='09') {
			$nama_bulan = 'September';
		}elseif($bulan=='10') {
			$nama_bulan = 'Oktober';
		}elseif($bulan=='11') {
			$nama_bulan = 'November';
		}elseif($bulan=='12') {
			$nama_bulan = 'Desember';
		}

		$hasil = date('d',strtotime($tanggal)).' '.$nama_bulan.' '.date('Y',strtotime($tanggal));
		return $hasil;
	}

}

/* End of file Website.php */
/* Location: ./application/libraries/Website.php */
