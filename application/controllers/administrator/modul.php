<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends CI_Controller {
	
	private $CI;
	private $siteName;
	private $baseurl;
	
	/*  
	 * constructor
	 */
	public function __construct() {
		parent::__construct();	
		$this->CI =& get_Instance();
		$this->siteName = $this->CI->config->item('site_name');
		$this->baseurl = $this->CI->config->item('base_url');
	}
	
	public function index() {
		
	}
	
}

?>