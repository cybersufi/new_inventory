<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<html lang="en">
	<head>
		<meta http-equiv="pragma" content="no-cache">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="expires" content="-1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	 	<link rel="shortcut icon" href="assets/images/favicon.ico" />
		<link rel="icon" href="assets/images/favicon.ico" />
		<title><?php echo $site_name; ?> - Administration Site</title>
		<script type="text/javascript">
			var home_url = '<?php echo base_url(); ?>';
			var site_url = home_url+'administrator/';
			var sitename = document.title;
		</script>
		<?php
			$this->extloader->loadbase();
			$this->asset->stylesheet('shared/prettify');
			$this->asset->stylesheet('administrator/login');
			
			$this->asset->javascript('shared/prettify');
			$this->asset->javascript('administrator/login/loginform');
			$this->asset->javascript('administrator/login/login');
		?>
	</head>
	<body scroll="no" id="docs">
		<div id="loading-mask" style=""></div>
		<div id="loading">
			<div class="loading-indicator">
				<?php
					$this->asset->image('loading.gif', 'Loading Anim', array("width" => "64", "height" => "64", "style" => "margin-right:8px", "align" => "absmiddle"));
				?>
	    		Loading...
			</div>
		</div>
		<div id="header" style="height:45">
			<a href="http://extjs.com" style="float:right;margin-right:10px;">
		    	<?php
					$this->asset->image('extjs.gif', 'www.sencha.com', array("style" => "width:83px;height:24px;margin-top:5px;"));
				?>
    		</a>
    		<div class="api-title"><?php echo $site_name; ?> - Administration</div>
		</div>
	</body>
	<head>
		<meta http-equiv="pragma" content="no-cache">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="expires" content="-1">
	</head>
</html>