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
		$this->extloader->stylesheet('ux/css/checkheader');
		$this->extloader->javascript('ux/checkcolumn');
		$this->asset->stylesheet('siteadmin/group');
		$this->asset->javascript('siteadmin/config');
		$this->asset->javascript('siteadmin/group/config');
		$this->asset->javascript('siteadmin/group/grouplist');
		$this->asset->javascript('siteadmin/group/group');
	?>
</head>
<body>
	<div id="loading-mask-group" style=""></div>
	<div id="loading-group">
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
				Ext.create('App.Inventory.SiteAdmin.GroupList').init();
				
          		setTimeout(function(){
					Ext.get('loading-group').remove();
					Ext.get('loading-mask-group').fadeOut({remove:true});
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
