<?php if ( ! defined('APPPATH')) exit('No direct script access allowed');

class DefaultClass extends CI_Controller {

	private $CI;
	private $sitename;
	private $baseurl;

	public function __construct() {
		parent::__construct();
		$this->CI =& get_Instance();
		$this->sitename = $this->CI->config->item('site_name');
	}
	
	public function index() {
		$data['site_name'] = $this->sitename;
		$data['base_url'] = base_url();
		$data['username'] = $this->session->userdata('uname');
		$data['lastlogin'] = $this->session->userdata('lastlogin');
		$data['ipaddress'] = $this->session->userdata('ipaddress');
		
		if (!empty($data['username'])) {
			$this->load->view('administrator/mainpage/main_index', $data);
		}
		else {
			redirect(base_url("/administrator/login"), 'refresh');
		}
	}
}
?>