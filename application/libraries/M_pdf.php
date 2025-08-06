<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pdf
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
	}

	public function mpdf()
	{
		$this->ci = & get_instance();

	}

	public function load($param  = null)
	{
		include(APPPATH.'/third_party/mpdf/mpdf.php');
		if ($param == null) {
			$param = '"en-GB-x","Legal","","",10,10,10,10,6,3';
		}
		return new mPDF($param);
	}
	

}

/* End of file mpdf.php */
/* Location: ./application/libraries/mpdf.php */
