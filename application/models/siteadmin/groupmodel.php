<?php

class GroupModel extends CI_Model {
	
	private $users_tbl;
	private $group_tbl;
	private $banned_tbl;
	private $group_count_tbl;
	
	const GET_DETAIL = 1;
	const BY_GROUPNAME = 2;
	
	public function __construct() {
		parent::__construct();
		$this->users_tbl = 'users';
		$this->group_tbl = 'groups';
		$this->banned_tbl = 'banned';
		$this->group_count_tbl = 'group_count';
	}
	
	public function __call($name, $arguments) {
    		switch ($name) {
 			case 'getGroupList' :
        			if (count($arguments) == 0) {
	          		return $this->groupList1();
		        	} else if (count($arguments) ==  1) {
		          	return $this->groupList2($arguments[0]);
		        	} else if (count($arguments) == 2) {
		          	return $this->groupList3($arguments[0],$arguments[1]);
		        	} else {
		          	trigger_error("Method <strong>$name</strong> with argument ". implode (',', $arguments)."doesn't exist", E_USER_ERROR);
		        	}
	        	break;
      		case 'getGroupListFiltered' :
		        	if (count($arguments) == 1) {
		          	return $this->groupList1($arguments[0]);
		        	} else if (count($arguments) == 2) {
		          	return $this->groupList2($arguments[0],$arguments[1]);
		        	} else if (count($arguments) == 3) {
		          	return $this->groupList3($arguments[0],$arguments[1], $arguments[2]);
		        	} else {
		          	trigger_error("Method <strong>$name</strong> with argument ". implode (',', $arguments)."doesn't exist", E_USER_ERROR);
		        	}
        		break;
	      	case 'getGroupCount' :
		        	if (count($arguments) == 0) {
		          	return $this->groupCount1();
		        	} else if (count($arguments) == 1) {
		          	return $this->groupCount1($arguments[0]);
		        	} else {
		          	trigger_error("Method <strong>$name</strong> with argument ". implode (',', $arguments)."doesn't exist", E_USER_ERROR);
		        	}
	        	break;
	      	case 'getGroup' :
		        	if (count($arguments) == 1) {
		          	return $this->getGroup1($arguments[0]);
		        	} else if (count($arguments) == 2) {
		          	if ($arguments[1] == GroupModel::GET_DETAIL) {
		            		return $this->getGroup3($arguments[0]);
		          	} else if ($arguments[1] == GroupModel::BY_GROUPNAME) {
		            		return $this->getGroup2($arguments[0]);
		          	}
		        	} else {
		          	trigger_error("Method <strong>$name</strong> with argument ". implode (',', $arguments)."doesn't exist", E_USER_ERROR);
		        	}
	        	break;
	      	case 'addGroup' :
		        	if (count($arguments) == 6) {
		          	return $this->addGroup1($arguments[0], $arguments[1], $arguments[2], $arguments[3], $arguments[4], $arguments[5]);
		        	} else {
		          	trigger_error("Method <strong>$name</strong> with argument ". implode (',', $arguments)."doesn't exist", E_USER_ERROR);
		        	}
	        	break;
	      	case 'delGroup' :
		        	if (count($arguments) == 1) {
		          	return $this->delGroup1($arguments[0]);
		        	} else {
		          	trigger_error("Method <strong>$name</strong> with argument ". implode (',', $arguments)."doesn't exist", E_USER_ERROR);
		        	}
	        	break;
	      	case 'editGroup':
		        	if (count($arguments) == 7) {
		          	return $this->editGroup1($arguments[0], $arguments[1], $arguments[2], $arguments[3], $arguments[4], $arguments[5], $arguments[6]);
		        	} else {
		         		trigger_error("Method <strong>$name</strong> with argument ". implode (',', $arguments)."doesn't exist", E_USER_ERROR);
		        	}
	        	break;
	      	default:
	        		trigger_error("Method <strong>$name</strong> doesn't exist", E_USER_ERROR);
	      	break;
		}
  	}
  
  	private function groupCount1($filters=null) {
    		$gl = $this->group_tbl;
    		$this->db->select($gl.'.id')
    		->from($gl);
    
    		if ($filters != null) {
      		$this->db->where($filters, NULL, FALSE);
    		}
    
    		return $this->db->count_all_results();
  	}
  
  	private function groupList1($filters=NULL) {    
    		return $this->groupList2(0,$filters);
	}
  
	private function groupList2($l,$filters=NULL) {
    		return $this->groupList3(0, $l, $filters);
  	}
  
  	private function groupList3($s, $l, $filters=NULL) {
    		$gl = $this->group_tbl;
		$gc = $this->group_count_tbl;
    
    		$this->db->select($gl.'.id as gid, '.
                             	$gl.'.title as groupname, '.
                             	$gl.'.description as groupdesc, '.
                             	$gl.'.groupstatus, '.
                             	$gl.'.issiteadmin, '.
						$gl.'.isadmin, '.
						$gl.'.isviewer, '.
	 					$gc.'.sum as total')
    		->from($gl)
		->join($gc, $gc.'.gid = '.$gl.'.id','left');
    
    		if ($filters != NULL) {
      		$this->db->where($filters, NULL, FALSE);
    		}
    
    		if ($l > 0) {
      		$this->db->limit($l,$s);
    		}
    
    		$res = $this->db->get();
    
    		return ($res->num_rows() > 0) ? $res : false;
  	}
  
  	private function getGroup1($id) {
    		$gl = $this->group_tbl;
    		$sql = $this->db->select($gl.'.id as gid')
           	->from($gl)
           	->where('id',$id)
           	->limit(1,0)
           	->get();
    		return $var = ($sql->num_rows() > 0) ? true : false;
  	}
  
  	private function getGroup2($gname) {
    		$gl = $this->group_tbl;
    		$sql = $this->db->select($gl.'.id')
           	->from($gl)
           	->where('title', $gname)
           	->limit(1,0)
           	->get();
    		return $var = ($sql->num_rows() > 0) ? true : false;
  	}
  
  	private function getGroup3($id) {
    		$gl = $this->group_tbl;
    		$sql = $this->db->select($gl.'.*')
           	->from($gl)
           	->where('id',$id)
           	->limit(1,0)
           	->get();
    		return $var = ($sql->num_rows() > 0) ? $sql : false;
  	}
  
  	private function addGroup1($gname, $desc, $gstatus, $issiteadmin, $isadmin, $isviewer) {
		$gl = $this->group_tbl;
    		$data = array();
    		$data['title'] = $gname;
    		$data['description'] = $desc;
    		$data['groupstatus'] = $gstatus;
    		$data['issiteadmin'] = $issiteadmin;
		$data['isadmin'] = $isadmin;
		$data['isviewer'] = $isviewer;
    		$this->db->insert($gl, $data);
    		return $var = ($this->db->affected_rows() > 0) ? true : false;
  	}
  
  	private function delGroup1($id) {
	    	$gl = $this->group_tbl;
	    	$this->db->delete($gl, array('id' => $id));
	    	return $var = ($this->db->affected_rows() > 0) ? true : false;
  	}
  
  	private function editGroup1($gid, $gname, $desc, $gstatus, $issiteadmin, $isadmin, $isviewer) {
	    	$gl = $this->group_tbl;
		$data = array();
		$data['title'] = $gname;
	    	$data['description'] = $desc;
	    	$data['groupstatus'] = $gstatus;
	    	$data['issiteadmin'] = $issiteadmin;
		$data['isadmin'] = $isadmin;
		$data['isviewer'] = $isviewer;
	    	$this->db->where('id', $gid);
	    	$this->db->update($gl, $data);
	    	return $var = ($this->db->affected_rows() > 0) ? true : false;
  	}
	
	function getCmbGroupList() {
		$grp_tbl = $this->group_tbl;
		
		$res = $this->db->select($grp_tbl.'.id, '.
								 $grp_tbl.'.title, '.
								 $grp_tbl.'.description')
		->from($grp_tbl)
		->order_by($grp_tbl.'.id','asc')
		->get();
		
		return ($res->num_rows() > 0) ? $res->result() : false;
	}
	
	function getGidByName($gname) {
		$res = $this->db->select($this->group_tbl.'.id')
		->from($this->group_tbl)
		->where($this->group_tbl.'.title', $gname)
		->limit(1)
		->get();
		
		return ($res->num_rows() > 0) ? $res->row() : false;
	}
}

?>
