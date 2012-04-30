<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<html lang="en">
<head>
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="expires" content="-1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php //echo $site_name; ?>Disk Usage Monitoring</title>
    	<?php
    		$this->extloader->loadbase();
		$this->asset->stylesheet('shared/prettify');
		$this->asset->javascript('shared/config');
		$this->asset->javascript('monitoring/diskusage/serverlist');
		$this->asset->javascript('monitoring/diskusage/mplist');
		$this->asset->javascript('monitoring/diskusage/diskgauge');
		$this->asset->javascript('monitoring/diskusage/usagehistory');
		$this->asset->javascript('monitoring/diskusage/diskusage');
	?>
</head>
<body>
	<script type="text/javascript">
		Ext.onReady(function(){
          	Ext.create('App.Monitoring.Diskusage').init();
		});
    	</script>
    	<!--<iframe id="iframe-div" frameborder="0" scrolling="auto" src="" width="100%" height="100%"></iframe>-->
    	<script type="text/javascript">
		function change_parent_url() {
			document.location = site_url;
   		}		
    	</script>
</body>
<head>
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="expires" content="-1">
</head>
</html>
