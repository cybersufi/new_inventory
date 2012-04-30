<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<html lang="en">
<head>
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="expires" content="-1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $site_name; ?> - Site Administration</title>
	<script type="text/javascript">
			var home_url = '<?php echo base_url(); ?>';
			var site_url = home_url+'administrator/';
			var sitename = document.title;
		</script>
	<?php
		$this->extloader->loadbase();
		$this->extloader->javascript('ux/SimpleIFrame');
		$this->asset->stylesheet('shared/prettify');
		$this->asset->stylesheet('administrator/mainpage'); 
		//$this->asset->javascript('administrator/mainpage/config');
		$this->asset->javascript('administrator/mainpage/navigationtree');
		$this->asset->javascript('administrator/mainpage/mainpage');
	?>
</head>
<body>
	<div id="header" style="display:none;">
		<a href="<?php echo $base_url; ?>" style="float:right;margin-right:10px;">
		<?php
			$this->asset->image('extjs.gif', 'extjs.com', array("style" => "width:83px;height:24px;margin-top:1px;"));
        	?>
      	</a>
		<div class="api-title"><?php echo $site_name; ?> - Site Administration</div>
  	</div>
	<div style="display:none;">
		<div id="session-user">
			Welcome &nbsp;<b><?php echo ucfirst($username); ?></b>,&nbsp;Last login:&nbsp;<?php echo date('d/m/Y H:i', $lastlogin); ?>
			,&nbsp;From:&nbsp;<?php echo $ipaddress; ?>
    	</div>
	</div>
	<script type="text/javascript">
		Ext.onReady(function(){
          	Ext.create('App.Inventory.SiteAdmin.Mainpage').init();
		});
	
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
