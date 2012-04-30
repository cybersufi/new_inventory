<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {
	
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
		$data['username'] = $this->session->userdata('uname');
		$data['lastlogin'] = $this->session->userdata('lastlogin');
		$data['ipaddress'] = $this->session->userdata('ipaddress');
		if (!empty($data['username'])) {
			if ($this->uri->segment(1) === FALSE) {
				$this->load->view('mainsite/mainpage/main_index', $data);
			}
			else {
				$this->load->view('page_redirect', $data);
			}
		}
		else {
			$this->load->view('mainsite/login/login_index', $data);
		}
	}
	
	public function getNav() {
		$issiteadmin = $this->session->userdata('issiteadmin');
		$isadmin = $this->session->userdata('isadmin');
		$nav = array();
		
		$nav[] = array (
			'text'=>'Site',
			'expanded'=>false,
			'children' => array(
				array(
					'text' => 'Home',
					'id' => 'node-home',
					'leaf' => true
				), array (
					'text'=>'Change Password',
      				'id'=>'node-mainsite/account',
      				'leaf'=>true
				), array (
					'text'=>'Logout',
      				'id'=>'node-logout',
      				'leaf'=>true
				)
			)
		);
		
		if ($issiteadmin) {
			$nav[] = array(
				'text'=>'Site Administration',
				'expanded'=>false,
				'children'=> array(
					array(
			        		'text'=>'Users',
			        		'id'=>'node-siteadmin/user',
			        		'leaf'=>true
					), array(
			        		'text'=>'Groups',
			        		'id'=>'node-siteadmin/group',
			        		'leaf'=>true
					), array(
			        		'text'=>'Menu Manager',
			        		'id'=>'node-siteadmin/menu',
			        		'leaf'=>true
					)
				)
			);
		}
		
		if ($isadmin) {
			$nav[] = array(
				'text'=>'Server Monitoring',
				'expanded'=>false,
				'children'=> array(
					array(
			        		'text'=>'Disk Usage',
			        		'id'=>'node-admin/dusage',
			        		'leaf'=>true
					)
				)
			);
		}
					
		$data['nav'] = $nav;
		$this->load->view('mainsite/mainpage/main_result', $data);
	}
}

?>
	