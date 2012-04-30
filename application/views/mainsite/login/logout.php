<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<html lang="en">
	<head>
		<meta http-equiv="pragma" content="no-cache">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="expires" content="-1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	 	<link rel="shortcut icon" href="assets/images/favicon.ico" />
		<link rel="icon" href="assets/images/favicon.ico" />
		<title><?php echo $site_name; ?></title>
	    <?php
	    	$this->extloader->loadbase();
			$this->asset->stylesheet('shared/shared');
			$this->asset->javascript('shared/config');
		?>
	</head>
	<body scroll="no" onload="if (top != self) document.write(&#39;&lt;body style=\&#39;background:transparent;\&#39;&gt;&lt;/body&gt;&#39;);">
		<div id="loading-mask" style=""></div>
		<div id="loading">
    		<div class="loading-indicator">
    		<?php
				$this->asset->image('loading.gif', 'Loading Anim', array("width" => "64", "height" => "64", "sytle" => "margin-right:8px", "align" => "absmiddle"));
			?>
    		<h1>Please Wait, Logging out...</h1>
		</div>
		</div>
	  	<?php
	  		$this->asset->javascript('mainsite/login/logout');
	  	?>
	</body>
	<head>
		<meta http-equiv="pragma" content="no-cache">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="expires" content="-1">
	</head>
</html>