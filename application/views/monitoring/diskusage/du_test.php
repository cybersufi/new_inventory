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
		$this->asset->stylesheet('inventory/shared/prettify');
		$this->asset->javascript('inventory/shared/config');
		//$this->asset->javascript('monitoring/diskusage/serverlist');
		//$this->asset->javascript('monitoring/diskusage/mplist');
		$this->asset->javascript('monitoring/diskusage/diskgauge');
		$this->asset->javascript('monitoring/diskusage/disktest');
		//$this->asset->javascript('monitoring/diskusage/usagehistory');
		//$this->asset->javascript('monitoring/diskusage/diskusage');
	?>
</head>
<body>
	<script type="text/javascript">
		Ext.require(['Ext.chart.*', 'Ext.chart.axis.Gauge', 'Ext.chart.series.*', 'Ext.Window']);
		Ext.onReady(function(){
			
			Ext.define('UsageData', {
			  	extend: 'Ext.data.Model',
			  	fields: [
			  		{name: 'usagedata', type: 'number'},
			  	],
			});
			
			var store1 = Ext.create('Ext.data.Store', {
			model: 'UsageData',
			remoteSort: true,
	  		proxy: {
		      	type: 'ajax',
		 		actionMethod: 'POST',
		 		url: site_url+'/monitoring/diskusage/getdiskusage',
		 		reader: {
		            	type: 'json',
		            	root: 'data',
		            	totalProperty: 'total'
		        	}
	       	},
	       	autoLoad: true,
	       	autoDestroy: true,
	   	});
			
			
          	Ext.create('Ext.Window', {
        width: 800,
        height: 250,
        minWidth: 650,
        minHeight: 225,
        title: 'Gauge Charts',
        layout: {
            type: 'hbox',
            align: 'stretch'
        },
        items: [{
	  		xtype: 'chart',
	       	style: 'background:#fff',
	       	animate: {
	           	easing: 'bounceOut',
	           	duration: 500
	       	},
	       	store: store1,
	       	insetPadding: 25,
	       	flex: 1,
	       	axes: [{
	           	type: 'gauge',
	           	position: 'gauge',
	           	minimum: 0,
	           	maximum: 100,
	           	steps: 10,
	           	margin: 7
	       	}],
	       	series: [{
	           	type: 'gauge',
	           	field: 'usagedata',
	           	donut: 80,
	           	colorSet: ['#3AA8CB', '#ddd']
	       	}]
	   	}]
    }).show();
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
