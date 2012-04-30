<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<html lang="en">
<head>
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="expires" content="-1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php //echo $site_name; ?>Monitoring Dashboard</title>
    	<?php
    		$this->extloader->loadbase();
		$this->asset->stylesheet('shared/prettify');
		$this->asset->javascript('shared/config');
		$this->asset->javascript('monitoring/dashboard/dashboard');
		$this->asset->javascript('monitoring/dashboard/serverlist');
		$this->asset->javascript('monitoring/dashboard/mplist');
		$this->asset->javascript('monitoring/dashboard/cpugauge');
		$this->asset->javascript('monitoring/dashboard/cpudata/cpuusage');
		$this->asset->javascript('monitoring/dashboard/cpuusage');
		$this->asset->javascript('monitoring/dashboard/cpuusagehistory');
		$this->asset->javascript('monitoring/dashboard/memusage');
		$this->asset->javascript('monitoring/dashboard/memgauge');
		$this->asset->javascript('monitoring/dashboard/memusagehistory');
		$this->asset->javascript('monitoring/dashboard/dashboard');
	?>
</head>
<body>
	<script type="text/javascript">
		Ext.onReady(function(){
          	Ext.create('App.Monitoring.Dashboard').init();
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