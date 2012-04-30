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
		$this->asset->stylesheet('siteadmin/menu');
		$this->asset->javascript('siteadmin/config');
		$this->asset->javascript('siteadmin/menu/config');
		$this->asset->javascript('siteadmin/menu/menulist');
		$this->asset->javascript('siteadmin/menu/menuitemlist');
		$this->asset->javascript('siteadmin/menu/menupanel');
		$this->asset->javascript('siteadmin/menu/menu');
	?>
</head>
<body>
	<div id="loading-mask-menu" style=""></div>
	<div id="loading-menu">
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
				Ext.create('App.SiteAdmin.MenuManager').init();
				
          		setTimeout(function(){
					Ext.get('loading-menu').remove();
					Ext.get('loading-mask-menu').fadeOut({remove:true});
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
