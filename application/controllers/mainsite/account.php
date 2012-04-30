<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

	private $CI;
	private $sitename;
	private $baseurl;
	private $index;
	private $result;

	public function __construct() {
		parent::__construct();
		$this->CI =& get_Instance();
		$this->sitename = $this->CI->config->item('site_name');
		$this->baseurl = $this->CI->config->item('base_url');
		$this->index = 'mainsite/account/account_index';
		$this->result = 'mainsite/account/account_res';
		$this->load->model('siteadmin/usermodel','um');
		$this->load->library('redux_auth');
	}
	
	public function index() {
		$data['site_name'] = $this->sitename;
		$data['base_url'] = $this->baseurl;
		$data['username'] = $this->session->userdata('uname');
		if (!empty($data['username'])) {
			$this->load->view($this->index, $data);
		} else {
			$this->load->view('page_redirect');
		}
	}
	
	public function chpass() {
		$data['site_name'] = $this->sitename;
		$data['base_url'] = $this->baseurl;
		$data['username'] = $this->session->userdata('uname');
		if (!empty($data['username'])) {
			$oldpass = $this->input->post('oldpasswd');
			$newpass1 = $this->input->post('newpasswd');
			$newpass2 = $this->input->post('repasswd');
			
			if($this->checkCredential($data['username'], $oldpass)) {
				if ($newpass1 == $newpass2 ) {
					$var = $this->redux_auth->reset_password($data['username'], $newpass1);
					if ($var) {
						$data['success'] = 'true';
						$data['msg'] ='User password changed.';
					} else {
						$data['success'] = 'false';
						$data['msg'] ='Unable to reset user password.';
					}
				} else {
					$data['success'] = 'false';
					$data['msg'] ='New password not same.';
				}
			} else {
				$data['success'] = 'false';
				$data['msg'] = 'Old password not match. Please try again';
			}
		} else {
			$data['success'] = 'false';
			$data['msg'] = 'Invalid data, Please try again';
		}
		$this->load->view($this->result, $data);
	}
	
	private function checkCredential($username, $userpass) {
		$res = $this->um->getUserCredential($username);
		if ($res) {
			$this->CI->config->load('redux_auth');
			$auth = $this->CI->config->item('auth');
			foreach($auth as $key => $value) {
				$this->$key = $value;
			}
			$pass = sha1(''.$res->hash.$userpass);
			if ($pass === $res->password) {
				return true;
			}
		} 
		return false;
	}
}
?>