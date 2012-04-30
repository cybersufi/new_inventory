<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

switch($type) {
  	case 'list' :
    		$data['total'] = $total;
    		$data['data'] = array();
    		if ($res != null) {
      		switch($funcname) {
        			case 'glist' :
          			foreach ($res as $row) {
		            		$cur_row = array();
		            		$cur_row['gid'] = $row->gid;
		            		$cur_row['groupname'] = $row->groupname;
		            		$cur_row['groupdesc'] = $row->groupdesc;
						$cur_row['groupstatus'] = ($row->groupstatus == 1 ) ? true : false;
		            		$cur_row['issiteadmin'] = ($row->issiteadmin == 1 ) ? true : false;
		            		$cur_row['isadmin'] = ($row->isadmin == 1 ) ? true : false;
		            		$cur_row['isviewer'] = ($row->isviewer == 1 ) ? true : false;
						$cur_row['total'] = $row->total;
		            		array_push($data['data'], $cur_row);
		          	}
          		break;
				default:
					$data['data'] = null;
				break;
      		}
    		}
    	break;
  	case 'form' :
    		$data['success'] = $success;
    		$data['msg'] = $msg;
    	break;
}
  
echo json_encode($data);

?>