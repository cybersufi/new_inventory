<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
		$this->load->view('monitoring/dashboard/db_index', $data);
	}
	
	public function getServerList() {
		$data['type'] = 'list';
		$data['funcname'] = 'slist';
    		$data['res'] = null;
    		$data['total'] = 0;
		
		$servername = $this->input->post('query');
		$servername = (!empty($servername)) ? $servername : null;
		
		$this->load->model('monitoring/servermodel','sm');
		
		$res = $this->sm->getServerList($servername);
		
		if ($res) {
			$data['res'] = $res->result();
			$data['total'] = $res->num_rows();
		}
		$this->load->view('monitoring/dashboard/db_res', $data);
	}
	
	public function getCpuUsage() {
		$data['type'] = 'single';
		$data['res'] = 0;
		$serverid = $this->input->post('serverid');
		if (!empty($serverid)) {
			$this->load->model('monitoring/cpumodel', 'cm');
			$row = $this->cm->getCpuUsage($serverid);
			$data['res'] = $row;
		}
		$this->load->view('monitoring/dashboard/db_res', $data);
	}
	
	public function getCpuData() {
		$data['type'] = 'list';
		$data['funcname'] = 'cdata';
    		$data['res'] = null;
    		$data['total'] = 0;
		$serverid = $this->input->post('serverid');
		//$this->output->enable_profiler(TRUE);
		if (!empty($serverid)) {
			$this->load->model('monitoring/cpumodel', 'cm');
			$row = $this->cm->getCpuData($serverid);
			if ($row != FALSE) {
				$data['res'] = $row->result();
				$data['total'] = $row->num_rows();
			}
		}
		$this->load->view('monitoring/dashboard/db_res', $data);
	}
	
	public function getMemUsage() {
		$data['type'] = 'single';
		$data['res'] = 0;
		$serverid = $this->input->post('serverid');
		if (!empty($serverid)) {
			$this->load->model('monitoring/memorymodel', 'mm');
			$row = $this->mm->getMemoryUsage($serverid);
			$data['res'] = $row;
		}
		$this->load->view('monitoring/dashboard/db_res', $data);
	}
	
	public function getCpuHistory() {
		$data['type'] = 'list';
		$data['funcname'] = 'clist';
    		$data['res'] = null;
    		$data['total'] = 0;
		$serverid = $this->input->post('serverid');
		$sdate = $this->input->post('sdate');
		$sdate = (!empty($sdate)) ? strtotime($sdate) : 0;
		$fdate = $this->input->post('fdate');
		$fdate = (!empty($fdate)) ? strtotime($fdate) : 0;
		if (!empty($serverid)) {
			$this->load->model('monitoring/cpumodel', 'cm');
			$row = $this->cm->getCpuHistory($serverid, $sdate, $fdate);
			if ($row != FALSE) {
				$data['res'] = $row->result();
				$data['total'] = $row->num_rows();
			}
		}
		$this->load->view('monitoring/dashboard/db_res', $data);
	}

	public function getMemoryHistory() {
		$data['type'] = 'list';
		$data['funcname'] = 'mlist';
    		$data['res'] = null;
    		$data['total'] = 0;
		$serverid = $this->input->post('serverid');
		$sdate = $this->input->post('sdate');
		$sdate = (!empty($sdate)) ? strtotime($sdate) : 0;
		$fdate = $this->input->post('fdate');
		$fdate = (!empty($fdate)) ? strtotime($fdate) : 0;
		if (!empty($serverid)) {
			$this->load->model('monitoring/memorymodel', 'mm');
			$row = $this->mm->getMemoryHistory($serverid, $sdate, $fdate);
			if ($row != FALSE) {
				$data['res'] = $row->result();
				$data['total'] = $row->num_rows();
			}
		}
		$this->load->view('monitoring/dashboard/db_res', $data);
	}
}
?>