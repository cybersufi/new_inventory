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
				$this->load->view('inventory/mainpage/main_index', $data);
			}
			else {
				$this->load->view('inventory/page_redirect', $data);
			}
		}
		else {
			$this->load->view('inventory/login/login_index', $data);
		}
	}
	
	public function getNav() {
		$issiteadmin = $this->session->userdata('issiteadmin');
		$isadmin = $this->session->userdata('isadmin');
		$isviewer = $this->session->userdata('isviewer');
		$nav = array();
		
		$nav[] = array(
			'text' => 'Home',
			'id' => 'node-home',
			'leaf' => true
		);
		
		if ($issiteadmin) {
			$nav[] = array(
				'text'=>'Site Administration',
				'expanded'=>false,
				'children'=> array(
					array(
			        		'text'=>'Users',
			        		'id'=>'node-user',
			        		'leaf'=>true
					), array(
			        		'text'=>'Groups',
			        		'id'=>'node-group',
			        		'leaf'=>true
					), array(
			        		'text'=>'Menu Manager',
			        		'id'=>'node-menu-manager',
			        		'leaf'=>true
					)
				)
			);
		}
		
		if ($isadmin) {
			$tmp = array(
				'text' => 'Server Inventory',
			    	'expanded' => false,
			    	'children' => null
			);
			
			$tmp['children'][] = array(
				'text' => 'Server List',
			   	'id' => 'node-server',
			   	'leaf' => true
			);
			
			$tmp['children'][] = array(
				'text' => 'Administration',
		        	'id' => 'node-serveradmin',
		        	'leaf' => true
			);
			
			$nav[] = $tmp;
			
			$tmp = array(
				'text' => 'Server Output',
	    			'expanded' => false,
	    			'children' => null
			);
			
			$tmp['children'][] = array(
				'text' => 'Overview',
		        	'id' => 'node-serverout',
		        	'leaf' => true
			);
			
			$this->load->model('serverout/serveroutperiodmodel','spm');
			$res = $this->spm->getPeriodList()->result();
			
			if ($res != null) {
				$this->load->library('appserverout/outputparser/dateconversion','','dc');
				$temp = array(
					'text' => 'View per Period',
				    	'expanded' => false,
				    	'children' => null
				);
				foreach ($res as $row) {
					$id = $row->id;
					$month = $this->dc->numberToText($row->month);
					$year = $row->year;
					
					$temp['children'][] = array(
						'text' => $month.' '.$year,
				        	'id' => 'node-serverout/viewoutput/'.$id,
				        	'leaf' => true
					);
				}
				$tmp['children'][] = $temp;
			}
				
			$nav[] = $tmp;
		}
    
		if ($isviewer) {
			$tmp = array(
				'text' => 'Server Inventory',
			    	'expanded' => false,
			    	'children' => null
			);
			
			$tmp['children'][] = array(
				'text' => 'Server List',
		        	'id' => 'node-server',
		        	'leaf' => true
			);
			
			$nav[] = $tmp;
		}
		 
		$nav[] = array (
			'text'=>'Account',
			'expanded'=>false,
			'children' => array(
				array (
					'text'=>'Change Password',
      				'id'=>'node-account',
      				'leaf'=>true
				), array (
					'text'=>'Logout',
      				'id'=>'node-logout',
      				'leaf'=>true
				)
			)
		);
					
		$data['nav'] = $nav;
		$this->load->view('administrator/mainpage/main_result', $data);
	}
}

?>
	