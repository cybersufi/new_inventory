<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CpuModel extends CI_Model {
	
	private $cpu;
	private $slist;
	
	public function __construct() {
		parent::__construct();
		$this->cpu = 'app_servercpu';
    		$this->slist = 'app_serverlist';
	}
	
	public function __call($name, $arguments) {
    		switch ($name) {
 			case 'getCpuUsage' :
        			if (count($arguments) == 1) {
          			return $this->cpuUsage1($arguments[0]);
        			} else {
          			trigger_error("Method <strong>$name</strong> with argument ". implode (',', $arguments)."doesn't exist", E_USER_ERROR);
        			}
        		break;
			case 'getCpuData' :
        			if (count($arguments) == 1) {
          			return $this->cpuData1($arguments[0]);
        			} else {
          			trigger_error("Method <strong>$name</strong> with argument ". implode (',', $arguments)."doesn't exist", E_USER_ERROR);
        			}
        		break;
			case 'getCpuHistory' :
        			if (count($arguments) == 3) {
          			return $this->cpuHistory1($arguments[0], $arguments[1], $arguments[2]);
        			} else {
          			trigger_error("Method <strong>$name</strong> with argument ". implode (',', $arguments)."doesn't exist", E_USER_ERROR);
        			}
        		break;
      		default:
        			trigger_error("Method <strong>$name</strong> doesn't exist", E_USER_ERROR);
		}  
  	}
	
	private function cpuUsage1($serverid) {
  		$usage = null;	
  		$st = $this->cpu;
		$this->db->select($st.'.lastupdate ')
		->from($st)
		->where($st.'.serverid', $serverid)
		->order_by($st.'.lastupdate', 'desc')
		->limit(1);
		$res = $this->db->get();
		$row = $res->result();
		$date = 0;
		foreach ($row as $value) {
			$date = $value->lastupdate;
		}
		
	    	$this->db->select($st.'.cpuusage')
	    	->from($st)
		->where($st.'.serverid', $serverid)
		->where($st.'.lastupdate', $date)
	    	->limit(1);
	    	$res = $this->db->get();
	    	if ($res->num_rows() > 0) {
			$row = $res->result();
			foreach ($row as $value) {
				$usage = $value->cpuusage;
			}
		}
	    	return ($usage != null) ? $usage : 0;
  	}
	
	private function cpuHistory1($serverid, $sdate, $fdate) {
		$st = $this->cpu;
		$csql = $st.'.lastupdate between '.$sdate.' and '.$fdate;
		$this->db->select($st.'.cpuid, '.
		                  $st.'.lastupdate, '.
					   $st.'.cpuusage')
		->from($st)
		->where($st.'.serverid', $serverid)
		->where($csql);
		$res = $this->db->get();
		
		return ($res->num_rows() > 0) ? $res : false;
	}

	private function cpuData1($serverid) {
		$usage = null;	
  		$st = $this->cpu;
		$this->db->select($st.'.lastupdate ')
			->from($st)
			->where($st.'.serverid', $serverid)
			->order_by($st.'.lastupdate', 'desc')
			->limit(1);
		$res = $this->db->get();
		$row = $res->result();
		$date = 0;
		foreach ($row as $value) {
			$date = $value->lastupdate;
		}
		
	    	$this->db->select($st.'.cpuusage, '.
						$st.'.cpuidle')
	    	->from($st)
		->where($st.'.serverid', $serverid)
		->where($st.'.lastupdate', $date)
	    	->limit(1);
	    	$res = $this->db->get();
	    	return ($res->num_rows()) ? $res : false;
	}
	
}

?>
