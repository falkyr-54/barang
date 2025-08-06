<?php
class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pegawai_barang_model');
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json; charset=UTF-8');
    }

    public function get_aktif_only()
    {
       $this->load->helper('url');

    // 1. Ambil data dari URL API
       $url = 'https://www.puskesmaspasarrebo.com/barang/index.php/admin/api/get_aktif_only';
       
       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       $result = curl_exec($ch);
       curl_close($ch);

    // 2. Decode hasil JSON ke array PHP
       $data['pegawai'] = json_decode($result, true);

    // 3. Kirim ke view
       $this->load->view('admin/pegawai_view', $data);
   }
}
