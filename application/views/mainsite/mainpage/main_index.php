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
		$this->extloader->javascript('ux/SimpleIFrame');
		$this->asset->stylesheet('shared/prettify');
		$this->asset->stylesheet('mainsite/mainpage/mainpage'); 
		$this->asset->javascript('shared/config');
		$this->asset->javascript('mainsite/mainpage/config');
		$this->asset->javascript('mainsite/mainpage/navigationtree');
		$this->asset->javascript('mainsite/mainpage/mainpage');
	?>
</head>
<body onload="if (top != self) document.write(&#39;&lt;body style=\&#39;background:transparent;\&#39;&gt;&lt;/body&gt;&#39;);">
	<div id="loading-mask" style=""></div>
	<div id="loading">
		<div class="loading-indicator">
			<?php
				$this->asset->image('loading.gif', 'Loading Anim', array("width" => "64", "height" => "64", "style" => "margin-right:8px", "align" => "absmiddle"));
			?>
    		<h1>Please wait. Loading page...</h1>
		</div>
	</div>
	<div id="header" style="display:none;">
    		<a href="<?php echo $base_url; ?>" style="float:right;margin-right:10px;">
		<?php
			$this->asset->image('extjs.gif', 'extjs.com', array("style" => "width:83px;height:24px;margin-top:1px; padding-top:5px;"));
        	?>
      	</a>
		<div class="api-title"><?php echo $site_name; ?></div>
  	</div>
    <div style="display:none;">
    	<div id="session-user">
			Welcome &nbsp;<b><?php echo ucfirst($username); ?></b>,&nbsp;Last login:&nbsp;<?php echo date('d/m/Y H:i', $lastlogin); ?>
			,&nbsp;From:&nbsp;<?php echo $ipaddress; ?>
    	</div>
	</div>
	<script type="text/javascript">
		Ext.onReady(function(){
          	Ext.create('App.Inventory.Mainpage').init();
          	
          	setTimeout(function() {
				Ext.get('loading').remove();
				Ext.get('loading-mask').fadeOut({remove:true});
			}, 250);
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
