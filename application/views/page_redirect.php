<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<html lang="en">
	<head>
		<meta http-equiv="pragma" content="no-cache">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="expires" content="-1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Redirecting - <?php echo $site_name; ?></title>
		<link rel="shortcut icon" href="assets/images/favicon.ico" />
		<link rel="icon" href="assets/images/favicon.ico" />
	    <?php
			$this->extloader->loadbase();
			$this->asset->stylesheet('shared/shared');
			$this->asset->javascript('shared/config');
		?>
	</head>
	<body scroll="no" id="docs">
		<div id="loading-mask" style=""></div>
	  	<div id="loading">
			<div class="loading-indicator">
		    	<?php
					$this->asset->image('loading.gif', 'Loading Anim', array("width" => "64", "height" => "64", "sytle" => "margin-right:8px", "align" => "absmiddle"));
				?>
		    	<h1>Please Wait, Redirecting...</h1><br>
				<h2>
		    	<script type="text/javascript">
					var base_url = '<?php echo config_item('base_url'); ?>';
					if (self == top) {
						document.write('<span>Click <a href="'+base_url+'">here</a> if you are not redirected</span>');
					} else {
						document.write('<span>Click <a href="javascript:parent.change_parent_url()">here</a> if you are not redirected</span>');
					}
				</script>
				</h2>
			</div>
	  	</div>
	  	<?php
	  		$this->asset->javascript('shared/page_redirect');
	  	?>
	</body>
	<head>
		<meta http-equiv="pragma" content="no-cache">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="expires" content="-1">
	</head> 
</html>