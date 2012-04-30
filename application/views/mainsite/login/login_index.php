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
			//$this->asset->stylesheet('shared/prettify');
			$this->asset->stylesheet('mainsite/login/login');
			
			$this->asset->javascript('shared/config');
			$this->asset->javascript('mainsite/login/config');
			//$this->asset->javascript('shared/prettify');
			$this->asset->javascript('mainsite/login/loginform');
			$this->asset->javascript('mainsite/login/login');
		?>
	</head>
	<body scroll="no" id="docs" onload="if (top != self) document.write(&#39;&lt;body style=\&#39;background:transparent;\&#39;&gt;&lt;/body&gt;&#39;);">
		<div id="loading-mask" style=""></div>
		<div id="loading">
			<div class="loading-indicator">
				<?php
					$this->asset->image('loading.gif', 'Loading Anim', array("width" => "64", "height" => "64", "style" => "margin-right:8px", "align" => "absmiddle"));
				?>
	    		<h1>Please wait. Loading page...</h1>
			</div>
		</div>
		<div id="header" style="height:45">
				<a href="http://extjs.com" style="float:right;margin-right:10px;">
		    		<?php
						$this->asset->image('extjs.gif', 'www.sencha.com', array("style" => "width:83px;height:24px;margin-top:5px;"));
					?>
	    		</a>
	    		<div class="api-title"><?php echo $site_name; ?></div>
		</div>
	</body>
	<head>
		<meta http-equiv="pragma" content="no-cache">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="expires" content="-1">
	</head>
</html>