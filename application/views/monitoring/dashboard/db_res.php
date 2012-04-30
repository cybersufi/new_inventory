<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

switch($type) {
  	case 'list' :
    		$data['total'] = $total;
    		$data['data'] = array();
    		//if ($res != null) {
      		switch($funcname) {
        			case 'slist' :
					if ($res != null) {
	          			foreach ($res as $row) {
			            		$cur_row = array();
			            		$cur_row['serverid'] = $row->serverid;
			            		$cur_row['servername'] = $row->servername;
			            		array_push($data['data'], $cur_row);
			          	}
					}
					$res = null;
          		break;
				case 'clist' :
					if ($res != null) {
						foreach ($res as $row) {
							$cur_row = array();
							$cur_row['historyid'] = $row->cpuid;
							$cur_row['historydate'] = date("d/m/y", $row->lastupdate);
							$cur_row['historydata'] = $row->cpuusage;
							array_push($data['data'], $cur_row);
						}
					}
					$res = null;
				break;
				case 'cdata' :
					if ($res != FALSE) {
						foreach ($res as $row) {
							$cur_row = array();
							$cur_row['cpuusage'] = $row->cpuusage;
							$cur_row['cpuidle'] = $row->cpuidle;
							array_push($data['data'], $cur_row);
						}
					} else {
						$cur_row = array();
						$cur_row['cpuusage'] = 0;
						$cur_row['cpuidle'] = 0;
						array_push($data['data'], $cur_row);
					}
					$res = null;
				break;
				case 'mlist' :
					if ($res != null) {
						foreach ($res as $row) {
							$cur_row = array();
							$cur_row['historyid'] = $row->memid;
							$cur_row['historydate'] = date("d/m/y", $row->lastupdate);
							$cur_row['historydata'] = $row->memusage;
							array_push($data['data'], $cur_row);
						}
					}
					$res = null;
				break;
      		}
    		//}
    	break;
	case 'single' :
		$data['data']['usagedata'] = $res;
	break; 
}

echo json_encode($data);

?>