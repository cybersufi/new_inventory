<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forbidden extends CI_Controller {
	
	private $baseurl;
	private $sitename;
	
	public function __construct() {
		parent::__construct();
		$this->CI =& get_Instance();
		$this->sitename = $this->CI->config->item('site_name');
		$this->baseurl = $this->CI->config->item('base_url');
	}
	
	public function index() {
		$data['base_url'] = $this->baseurl;
		$data['sitename'] = $this->sitename;
		$data['heading'] = 'Forbidden Access !!!!';
		$data['message'] = 'No direct script access allowed';
		$this->load->view('error/forbidden', $data);
	}
	
}

?>