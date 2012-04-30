<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DefaultClass extends CI_Controller {

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
		echo "blah-invent";
		/*$data['site_name'] = $this->sitename;
		$data['base_url'] = $this->baseurl;
		$data['username'] = $this->session->userdata('uname');
		$data['lastlogin'] = $this->session->userdata('lastlogin');
		$data['ipaddress'] = $this->session->userdata('ipaddress');
		if (!empty($data['username'])) {
			if ($this->uri->segment(2) === FALSE) {
				$this->load->view('inventory/siteadmin/mainpage/main_index', $data);
			}
			else {
				$this->load->view('inventory/siteadmin/page_redirect');
			}
		}
		else {
			$this->load->view('inventory/siteadmin/login/login_index', $data);
		}*/
	}
}
?>