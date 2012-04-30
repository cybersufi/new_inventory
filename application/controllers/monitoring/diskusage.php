<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DiskUsage extends CI_Controller {

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
		//echo "server monitoring - disk usage";
		$data['site_name'] = $this->sitename;
		$data['base_url'] = $this->baseurl;
		$this->load->view('monitoring/diskusage/du_index', $data);
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
		$this->load->view('monitoring/diskusage/du_res', $data);
	}
	
	public function getMpList() {
		$data['type'] = 'list';
		$data['funcname'] = 'mplist';
    		$data['res'] = null;
    		$data['total'] = 0;
		
		$serverid = $this->input->post('serverid');
		if (!empty($serverid)) {
			$this->load->model('monitoring/mountpointmodel', 'mm');
			$row = $this->mm->getMpList($serverid);
			if ($row) {
				$data['res'] = $row->result();
				$data['total'] = $row->num_rows();
			}
		}
		$this->load->view('monitoring/diskusage/du_res', $data);
	}
		
	public function getDiskUsage() {
		$data['type'] = 'single';
		$data['res'] = 0;
		$mpid = $this->input->post('mpid');
		if (!empty($mpid)) {
			$this->load->model('monitoring/mountpointmodel', 'mm');
			$row = $this->mm->getMpUsage($mpid);
			$data['res'] = $row;
		}
		$this->load->view('monitoring/diskusage/du_res', $data);
	}
	
	public function getUsageHistory() {
		$data['type'] = 'list';
		$data['funcname'] = 'hlist';
    		$data['res'] = null;
    		$data['total'] = 0;
		$mpname = $this->input->post('mpname');
		$serverid = $this->input->post('serverid');
		$sdate = $this->input->post('sdate');
		$sdate = (!empty($sdate)) ? strtotime($sdate) : 0;
		$fdate = $this->input->post('fdate');
		$fdate = (!empty($fdate)) ? strtotime($fdate) : 0;
		if (!empty($mpname)) {
			$this->load->model('monitoring/mountpointmodel', 'mm');
			$row = $this->mm->getMpHistory($mpname, $serverid, $sdate, $fdate);
			if ($row != FALSE) {
				$data['res'] = $row->result();
				$data['total'] = $row->num_rows();
			}
		}
		$this->load->view('monitoring/diskusage/du_res', $data);
	}
}
?>