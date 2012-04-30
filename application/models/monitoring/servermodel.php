<?php

class ServerModel extends CI_Model {
	
	private $slist;
	
	public function __construct() {
		parent::__construct();
		$this->slist = 'app_serverlist';
	}
	
	public function __call($name, $arguments) {
    		switch ($name) {
 			case 'getServerList' :
        			if (count($arguments) == 0) {
          			return $this->slist1(null);
        			} else if (count($arguments) ==  1) {
          			return $this->slist1($arguments[0]);
        			} else {
          			trigger_error("Method <strong>$name</strong> with argument ". implode (',', $arguments)."doesn't exist", E_USER_ERROR);
        			}
        		break;
      		default:
        			trigger_error("Method <strong>$name</strong> doesn't exist", E_USER_ERROR);
		}  
  	}
  
  	private function slist1($servername) {
    		$sl = $this->slist;
    		$this->db->select($sl.'.serverid, '.
                      $sl.'.servername ')
    		->from($sl);
    
    		if ($servername != NULL) {
			$this->db->like($sl.'.servername', $servername);
    		}

    		$res = $this->db->get();
    
    		return ($res->num_rows() > 0) ? $res : false;
  	}
}

?>
