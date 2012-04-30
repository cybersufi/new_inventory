<?php

class MountpointModel extends CI_Model {
	
	private $mplist;
	private $slist;
	private $data;
	
	public function __construct() {
		parent::__construct();
		$this->mplist = 'app_servermountpoint';
    		$this->slist = 'app_serverlist';
	}
	
	public function __call($name, $arguments) {
    		switch ($name) {
 			case 'getMpList' :
        			if (count($arguments) == 1) {
          			return $this->mpList1($arguments[0]);
        			} else {
          			trigger_error("Method <strong>$name</strong> with argument ". implode (',', $arguments)."doesn't exist", E_USER_ERROR);
        			}
        		break;
			case 'getMpHistory' :
        			if (count($arguments) == 4) {
          			return $this->mpHistory1($arguments[0], $arguments[1], $arguments[2], $arguments[3]);
        			} else {
          			trigger_error("Method <strong>$name</strong> with argument ". implode (',', $arguments)."doesn't exist", E_USER_ERROR);
        			}
        		break;
			case 'getMpUsage' :
        			if (count($arguments) == 1) {
          			return $this->mpUsage1($arguments[0]);
        			} else {
          			trigger_error("Method <strong>$name</strong> with argument ". implode (',', $arguments)."doesn't exist", E_USER_ERROR);
        			}
        		break;
      		default:
        			trigger_error("Method <strong>$name</strong> doesn't exist", E_USER_ERROR);
		}  
  	}
	
	private function mpList1($serverid) {
  		$st = $this->mplist;
		
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
		
	    	$this->db->select($st.'.mpid, '.
	    				  $st.'.serverid, '.
	                      $st.'.filesystem, '.
	                      $st.'.totalsize, '.
	                      $st.'.usedsize, '.
	                      $st.'.available, '.
	                      $st.'.mpusage, '.
	                      $st.'.mountedon')
	    	->from($st)
		->where($st.'.serverid', $serverid)
		->where($st.'.lastupdate', $date);
	    
	    	$res = $this->db->get();
	    
	    	return ($res->num_rows() > 0) ? $res : false;
  	}
	
	private function mpUsage1($mpid) {
		$usage = null;
		$st = $this->mplist;
		$this->db->select($st.'.mpusage')
		->from($st)
		->where($st.'.mpid', $mpid)
		->limit(1);
		$res = $this->db->get();
		if ($res->num_rows() > 0) {
			$row = $res->result();
			foreach ($row as $value) {
				$usage = $value->mpusage;
			}
		}
		return ($usage != null) ? $usage : 0;
	}
	
	private function mpHistory1($mpname, $serverid, $sdate, $fdate) {
		$st = $this->mplist;
		$csql = $st.'.lastupdate between '.$sdate.' and '.$fdate;
		$this->db->select($st.'.mpid, '.
		                  $st.'.lastupdate, '.
					   $st.'.mpusage')
		->from($st)
		->where($st.'.mountedon', $mpname)
		->where($st.'.serverid', $serverid)
		->where($csql);
		$res = $this->db->get();
		
		return ($res->num_rows() > 0) ? $res : false;
	}
}

?>
