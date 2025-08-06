 <?php
      defined('BASEPATH') OR exit('No direct script access allowed');

      class Validasi extends CI_Controller {

        // Load database
        public function __construct()
        {
          parent::__construct();
          $this->load->model('libur_model');
        }