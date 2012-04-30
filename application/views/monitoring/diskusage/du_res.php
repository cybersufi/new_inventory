<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

switch($type) {
  	case 'list' :
    		$data['total'] = $total;
    		$data['data'] = array();
    		if ($res != null) {
      		switch($funcname) {
        			case 'slist' :
          			foreach ($res as $row) {
		            		$cur_row = array();
		            		$cur_row['serverid'] = $row->serverid;
		            		$cur_row['servername'] = $row->servername;
		            		array_push($data['data'], $cur_row);
		          	}
          		break;
				case 'mplist' :
					foreach ($res as $row) {
						$cur_row = array();
						$cur_row['mpid'] = $row->mpid;
						$cur_row['serverid'] = $row->serverid;
						$cur_row['mpname'] = $row->mountedon;
						$cur_row['totalsize'] = $row->totalsize;
						$cur_row['usedsize'] = $row->usedsize;
						$cur_row['freesize'] = $row->available;
						$cur_row['usage'] = $row->mpusage; 
						array_push($data['data'], $cur_row);
					}
				break;
				case 'hlist' :
					foreach ($res as $row) {
						$cur_row = array();
						$cur_row['historyid'] = $row->mpid;
						$cur_row['historydate'] = date("d/m/y", $row->lastupdate);
						$cur_row['historydata'] = $row->mpusage;
						array_push($data['data'], $cur_row);
					}
				break;
      		}
    		}
    	break;
	case 'single' :
		$data['data']['usagedata'] = $res;
	break; 
}

echo json_encode($data);

?>