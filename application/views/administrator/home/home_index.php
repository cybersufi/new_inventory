<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<html lang="en">
<head>
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="expires" content="-1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $site_name; ?></title>
    <?php
   		$this->extloader->loadbase();
		$this->asset->stylesheet('administrator/home'); 
		
		$this->asset->javascript('administrator/config');
		$this->asset->javascript('administrator/home/config');
		$this->asset->javascript('administrator/home/loggeduser');
		$this->asset->javascript('administrator/home/newuser');
		$this->asset->javascript('administrator/home/userstat');
		$this->asset->javascript('administrator/home/siteadmin');
	?>
</head>
<body>
	<div id="loading-mask-home" style=""></div>
	<div id="loading-home">
		<div class="loading-indicator">
			<?php
				$this->asset->image('loading.gif', 'Loading Anim', array("width" => "64", "height" => "64", "style" => "margin-right:8px", "align" => "absmiddle"));
			?>
    		<h1>Please wait. Loading page...</h1>
		</div>
	</div>
	<div id="content">
		<script type="text/javascript">
			Ext.onReady(function(){
				Ext.create('App.Inventory.SiteAdmin.Mainpage').init();
			
				setTimeout(function(){
					Ext.get('loading-home').remove();
					Ext.get('loading-mask-home').fadeOut({remove:true});
				}, 250);
          	
			});
    	</script>
	</div>
</body>
<head>
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="expires" content="-1">
</head>
</html>
