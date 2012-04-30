<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller {
	
	private $CI;
	private $siteName;
	private $baseurl;
	private $index;
	private $result;
	
	/*  
	 * constructor
	 */
	
	public function __construct() {
		parent::__construct();	
		$this->CI =& get_Instance();
		$this->siteName = $this->CI->config->item('site_name');
		$this->baseurl = $this->CI->config->item('base_url');
		$this->index = 'siteadmin/menu/menu_index';
		$this->result = 'siteadmin/menu/menu_result';
		//$this->load->model('siteadmin/groupmodel','gm');
	}
	
	public function Index() {
		$issiteadmin = $this->session->userdata('issiteadmin');
		if ($issiteadmin) {
			$data['site_name'] = $this->siteName." - Menu Manager";
			$this->load->view($this->index, $data);
		} else {
			$this->load->view('page_redirect');
		}
	}
}

?>