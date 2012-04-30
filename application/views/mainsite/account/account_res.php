<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	$res['success'] = $success;
	$res['msg'] = $msg;
	
	echo json_encode($res);
?>