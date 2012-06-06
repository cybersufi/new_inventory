<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	
	private $CI;
	private $sitename;
	private $baseurl;

	public function __construct() {
		parent::__construct();
		$this->CI =& get_Instance();
		$this->sitename = $this->CI->config->item('site_name');
		$this->baseurl = $this->CI->config->item('base_url');
	}
	
	public function index() {
		$data['site_name'] = $this->sitename;
		$data['base_url'] = $this->baseurl;
		
		$issiteadmin = $this->session->userdata('issiteadmin');
		
		if ($issiteadmin) {
			//$this->load->view('inventory/home/home_siteadmin', $data);
			$this->load->view('administrator/home/home_index', $data);
		} else {
			$this->load->view('inventory/page_redirect', $data);
		}
		
	}
}