<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends CI_Controller {
	
	private $CI;
	private $siteName;
	private $baseurl;
	private $isedit;
	private $isread;
	private $isexecute;
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
		$this->index = 'siteadmin/group/group_index';
		$this->result = 'siteadmin/group/group_result';
		$this->load->model('siteadmin/groupmodel','gm');
	}
	
	/*
	 * check credential function
	 */
	
	private function checkCredential() {
		
	}
	
	public function Index() {
		$issiteadmin = $this->session->userdata('issiteadmin');
		if ($issiteadmin) {
			$data['site_name'] = $this->siteName." - Group List";
			$this->load->view($this->index, $data);
		} else {
			$this->load->view('page_redirect');
		}
	}
	
	public function groupCmbList() {
		$data['type'] = 'list';
		$data['funcname'] = 'glist';
		$data['res'] = $this->gm->getCmbGroupList();
		$this->load->view('group/group_cmb_list',$data);
	}
	
	public function getGroupList() {
		$issiteadmin = $this->session->userdata('issiteadmin');
		
		$data['type'] = 'list';
		$data['funcname'] = 'glist';
    		$data['res'] = null;
    		$data['total'] = 0;
		
		if ($issiteadmin) {
			$start = $this->input->post('start');
		    	$limit = $this->input->post('limit');
			$filters = $this->input->post('filter');
		    	$isFiltered = false;
		    	$sl = "";
		    
		    	if (!empty($filters)) {
		      	$isFiltered = true;
		      	$filters = $this->filterParser($filters);
		    	}
		    
		    	if (empty($start) && empty($limit)) {
		      	$sl = ($isFiltered) ? $this->gm->getGroupListFiltered($filters) : $this->gm->getGroupList();
		    	} else if (empty($start)) {
		      	$sl = ($isFiltered) ? $this->gm->getGroupListFiltered($filters) : $this->gm->getGroupList($limit);
		    	} else {
		      	$sl = ($isFiltered) ? $this->gm->getGroupListFiltered($filters) : $this->gm->getGroupList($start, $limit);
		    	}
		    
		    	$data['res'] = $sl->result();
		    	$data['total'] = ($isFiltered) ? $this->gm->getGroupCount($filters) : $this->gm->getGroupCount();
		}
    		$this->load->view($this->result, $data);
	}
	
	public function addGroup() {
		$issiteadmin = $this->session->userdata('issiteadmin');
		$data['type'] = 'form';
    		$isSuccess = false;
    		$data['success'] = false;
    		$data['msg'] = null;
		if ($issiteadmin) {
			$config = array(
				array(
					'field'   => 'groupname', 
					'label'   => 'Group Name', 
					'rules'   => 'required'
				)
			);
			$this->form_validation->set_rules($config);
	    		if ($this->form_validation->run() == true) {
	      		$groupname = $this->input->post('groupname');
	      		$groupdesc = $this->input->post('groupdesc');
	      		$groupstatus = $this->input->post('groupstatus');
	      		$issiteadmin = $this->input->post('issiteadmin');
	      		$isadmin = $this->input->post('isadmin');
	      		$isviewer = $this->input->post('isviewer');
	      		if (!$this->gm->getGroup($groupname, GroupModel::BY_GROUPNAME) && !empty($groupname)) {
	        			$isSuccess = $this->gm->addGroup($groupname, $groupdesc, $groupstatus, $issiteadmin, $isadmin, $isviewer);
	      		}
	      
	      		if ($isSuccess) {
	        			$data['success'] = 'true';
	        			$data['msg'] = 'Group added to the list';
	      		} else {
	        			$data['success'] = 'false';
	        			$data['msg'] = 'Invalid data, Group not added to the list';
      			}
	    		} else {
	      		$data['success'] = 'false';
	      		$data['msg'] = 'Invalid data, Please try again';
	    		}
  		} else {
	  		$data['success'] = 'false';
    			$data['msg'] = 'Unsufficient privilege. Please try again';
	  	}
    		$this->load->view($this->result, $data);
	}
	
	public function delGroup() {
		$data['type'] = 'form';
    		$isSuccess = false;
    		$data['success'] = $isSuccess;
		$data['msg'] = null;
		$issiteadmin = $this->session->userdata('issiteadmin');
		if ($issiteadmin) {
			$config = array(
				array(
					'field'   => 'ids', 
					'label'   => 'ids', 
					'rules'   => 'required'
				)
			);
					
			$this->form_validation->set_rules($config);
	    		if ($this->form_validation->run() == true) {
	    			$ids = $this->input->post('ids');
	      		$ids = explode(";", $ids);
				foreach ($ids as $item) {
	        			if ($this->gm->getGroup($item) && !empty($item)) {
	          			$isSuccess = $this->gm->delGroup($item);
	        			}
      			}  
	      		if ($isSuccess) {
	        			$data['success'] = 'true';
	        			$data['msg'] = 'Group(s) deleted from list';
      			} else {
		        		$data['success'] = 'false';
		        		$data['msg'] = 'Invalid data, Group(s) not deleted from list';
      			}
	    		} else {
	      		$data['success'] = 'false';
	      		$data['msg'] = 'Invalid data, Please try again';
	    		}
		} else {
			$data['success'] = 'false';
    			$data['msg'] = 'Unsufficient privilege. Please try again';
		}
    		$this->load->view($this->result, $data);
	}
	
	public function editGroup() {
		$data['type'] = 'form';
    		$isSuccess = false;
    		$data['success'] = $isSuccess;
    		$data['msg'] = null;
		$issiteadmin = $this->session->userdata('issiteadmin');
		if ($issiteadmin) {
			$config = array(
				array(
					'field'   => 'gid', 
					'label'   => 'gid', 
					'rules'   => 'required'
				), array(
					'field'   => 'groupname', 
					'label'   => 'Group Name', 
					'rules'   => 'required'
				)
			);
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == true) {
	      		$gid = $this->input->post('gid');
	      		$groupname = $this->input->post('groupname');
	      		$groupdesc = $this->input->post('groupdesc');
	      		$groupstatus = $this->input->post('groupstatus');
	      		$issiteadmin = $this->input->post('issiteadmin');
	      		$isadmin = $this->input->post('isadmin');
	      		$isviewer = $this->input->post('isviewer');
				if ($this->gm->getGroup($gid) && !empty($gid)) {
	        			$isSuccess = $this->gm->editGroup($gid, $groupname, $groupdesc, $groupstatus, $issiteadmin, $isadmin, $isviewer);
	      		}
	      
	     	 	if ($isSuccess) {
		 	       	$data['success'] = 'true';
		   	     	$data['msg'] = 'Change successfuly submitted';
		      	} else {
		    		    	$data['success'] = 'false';
		     	   	$data['msg'] = 'Invalid data, Please try again';
	     		}
	    		} else {
		      	$data['success'] = 'false';
		      	$data['msg'] = 'Invalid data, Please try again';
		    	}
	    	} else {
		    	$data['success'] = 'false';
		    	$data['msg'] = 'Unsufficient privilege. Please try again';
  	  	}
	    	$this->load->view($this->result, $data);
	}
	
	private function filterParser($filters) {  
    		$filters = json_decode($filters);
    		$where = ' "0" = "0" ';
    		$qs = '';
    		
    		if (is_array($filters)) {
        		for ($i=0;$i<count($filters);$i++){
            		$filter = $filters[$i];
            
            		$field = '';
            
            		switch ($filter->field) {
	              		case 'gid' :
	                		$field = 'id';
	                	break;
					case 'groupname' :
           				$field = 'title';
           			break;
					case 'groupdesc' :
           				$field = 'description';
           			break;
					case 'total' :
                			$field = 'sum';
                		break;
              			default : 
                			$field = $filter->field;
					break;
      			}
            
            		if ($filter->type == 'boolean') {
            			$value = (strstr($filter->value, "yes")) ? 1 : 0;
            		} else {
            			$value = $filter->value;
				}
						
            		$compare = isset($filter->comparison) ? $filter->comparison : null;
            		$filterType = $filter->type;
    
            		switch($filterType){
                		case 'string' : $qs .= " AND ".$field." LIKE '%".$value."%'"; break;
                		case 'list' :
                    		if (strstr($value,',')) {
                        			$fi = explode(',',$value);
                        			for ($q=0;$q<count($fi);$q++){
                            			$fi[$q] = "'".$fi[$q]."'";
             					}
                        			$value = implode(',',$fi);
                        			$qs .= " AND ".$field." IN (".$value.")";
                    		} else {
                        			$qs .= " AND ".$field." = '".$value."'";
                    		}
                		break;
                		case 'boolean' : $qs .= " AND ".$field." = ".($value); break;
                		case 'numeric' :
                    		switch ($compare) {
                        		case 'eq' : $qs .= " AND ".$field." = ".$value; break;
                        		case 'lt' : $qs .= " AND ".$field." < ".$value; break;
                        		case 'gt' : $qs .= " AND ".$field." > ".$value; break;
               		}
                		break;
                		case 'date' :
               			switch ($compare) {
                        			case 'eq' : $qs .= " AND ".$field." = '".date('Y-m-d',strtotime($value))."'"; break;
                        			case 'lt' : $qs .= " AND ".$field." < '".date('Y-m-d',strtotime($value))."'"; break;
                        			case 'gt' : $qs .= " AND ".$field." > '".date('Y-m-d',strtotime($value))."'"; break;
               			}
           			break;
           		}
        		}
        		$where .= $qs;
    		}
    		return $where;
  	}
}

?>