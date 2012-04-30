<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MemoryModel extends CI_Model {
	
	private $mem;
	private $slist;
	
	public function __construct() {
		parent::__construct();
		$this->mem = 'app_servermemory';
    		$this->slist = 'app_serverlist';
	}
	
	public function __call($name, $arguments) {
    		switch ($name) {
 			case 'getMemoryUsage' :
        			if (count($arguments) == 1) {
          			return $this->memUsage1($arguments[0]);
        			} else {
          			trigger_error("Method <strong>$name</strong> with argument ". implode (',', $arguments)."doesn't exist", E_USER_ERROR);
        			}
        		break;
			case 'getMemoryHistory' :
        			if (count($arguments) == 3) {
          			return $this->memHistory1($arguments[0], $arguments[1], $arguments[2]);
        			} else {
          			trigger_error("Method <strong>$name</strong> with argument ". implode (',', $arguments)."doesn't exist", E_USER_ERROR);
        			}
        		break;
      		default:
        			trigger_error("Method <strong>$name</strong> doesn't exist", E_USER_ERROR);
		}  
  	}
	
	private function memUsage1($serverid) {
  		$usage = null;	
  		$st = $this->mem;
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
		
	    	$this->db->select($st.'.memusage')
	    	->from($st)
		->where($st.'.serverid', $serverid)
		->where($st.'.lastupdate', $date)
	    	->limit(1);
	    	$res = $this->db->get();
	    	if ($res->num_rows() > 0) {
			$row = $res->result();
			foreach ($row as $value) {
				$usage = $value->memusage;
			}
		}
	    	return ($usage != null) ? $usage : 0;
  	}
	
	private function memHistory1($serverid, $sdate, $fdate) {
		$st = $this->mem;
		$csql = $st.'.lastupdate between '.$sdate.' and '.$fdate;
		$this->db->select($st.'.memid, '.
		                  $st.'.lastupdate, '.
					   $st.'.memusage')
		->from($st)
		->where($st.'.serverid', $serverid)
		->where($csql);
		$res = $this->db->get();
		
		return ($res->num_rows() > 0) ? $res : false;
	}
}

?>
