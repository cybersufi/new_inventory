<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	    	<title><?php echo $site_name; ?></title>
	    	<link rel="shortcut icon" href="assets/images/favicon.ico" />
		<link rel="icon" href="assets/images/favicon.ico" />
	    	<?php
	    		$this->extloader->loadbase();
			$this->asset->stylesheet('inventory/shared/shared');
			$this->asset->javascript('inventory/shared/config');
		?>
	</head>
	<body scroll="no" id="docs">
		<div id="loading-mask" style=""></div>
		<div id="loading">
	    		<div class="loading-indicator">
	    		<?php
				$this->asset->image('loading.gif', 'Loading Anim', array("width" => "64", "height" => "64", "sytle" => "margin-right:8px", "align" => "absmiddle"));
			?>
	    		Please Wait, Logging out...
		</div>
		</div>
	  	<?php
	  		$this->asset->javascript('inventory/login/logout');
	  	?>
	</body>
</html>