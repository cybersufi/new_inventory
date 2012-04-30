<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	private $CI;
	private $sitename;

	public function __construct() {
		parent::__construct();
		$this->CI =& get_Instance();
		$this->sitename = $this->CI->config->item('site_name');
		$this->load->library('redux_auth');
	}
	
	public function index() {
		$data['site_name'] = $this->sitename;
		$data['username'] = $this->session->userdata('uname');
		$data['lastlogin'] = $this->session->userdata('lastlogin');
		$data['ipaddress'] = $this->session->userdata('ipaddress');
		if (!empty($data['username'])) {
			redirect(base_url('administrator'), 'refresh');
		}
		else {
			$this->load->view('administrator/login/login_index', $data);
		}
	}
	
	public function doLogin() {
		$sess_id = $this->session->userdata('id');
		if (empty($sess_id)) {
			$config = array(
				array(
					'field'   => 'username', 
					'label'   => 'Username', 
					'rules'   => 'required'
				), array(
					'field'   => 'password', 
					'label'   => 'Password', 
					'rules'   => 'required'
				)
			);
			
			$this->form_validation->set_rules($config);
			
			if ($this->form_validation->run()) {
				$redux = $this->redux_auth->login (
					$this->input->post('username'),
					$this->input->post('password')
				);
				
				switch($redux){
					case 'NOT_ACTIVATED': 
						$data['success'] = 'false';
						$data['msg'] = 'Access Denied. Your account is not activated. Please contact the administrator';
						break;
					
					case 'BANNED': 
						$data['success'] = 'false';
						$data['msg'] = 'Access Denied. '.$this->session->flashdata('login');
						break;
					
					case 'false': 
						$data['success'] = 'false';
						$data['msg'] = 'Access Denied. Wrong Username or Password';
						break;
					
					case 'true': 
						$data['success'] = 'true';
						$data['msg'] = 'Access Granted. Welcome "'.strtoupper($this->input->post('username')).'".';
						break;
					
					default: 
						$data['success'] = 'false';
						$data['msg'] = 'Access Denied.';
				}
				
				$this->load->view('administrator/login/login_result', $data);
			}
			else {
				$data['success'] = 'false';
				$data['msg'] = 'Invalid data, Please try again';
				$this->load->view('administrator/login/login_result', $data);
			}
		} else {
			redirect(base_url('administrator'), 'refresh');
		}
	}
	
	function doLogout() {
		$this->redux_auth->logout();
		redirect(base_url('administrator'), 'refresh');
		/*$data['site_name'] = $this->sitename;
		$this->load->view('inventory/siteadmin/login/logout', $data);*/
	}
}

?>