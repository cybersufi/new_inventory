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
		$this->asset->stylesheet('shared/shared');
		$this->asset->javascript('shared/config');
		$this->asset->javascript('mainsite/account/config');
		$this->asset->javascript('mainsite/account/chpass');
	?>
	<style type="text/css">
		html, body {
			font-family: Segoe ui, Helvetica, Arial, sans-serif;
			background-attachment: fixed;
			background-color:#FFFFFF;
			padding: 20;
			font-size: .75em;
		}
		
		h2 {
			color: #2C2C2C;
			font-size: 1.5em;
			font-weight: normal;
			margin: 0 0 5px 0;
			padding: 0;
		}
		
		p {
			color: #333;
			margin: 0 0 10px 0;
			padding: 0;
			line-height: 1.2em;
		}
		
		ul, menu, dir {
			display: block; 
			list-style-type: disc;
		}
		
		li {
			display: list-item;
		}
	</style>
</head>
<body>
	<div id="loading-mask" style=""></div>
	<div id="loading">
		<div class="loading-indicator">
			<?php
				$this->asset->image('loading.gif', 'Loading Anim', array("width" => "64", "height" => "64", "style" => "margin-right:8px", "align" => "absmiddle"));
			?>
    		<h1>Please wait. Loading page...</h1>
		</div>
	</div>
	<div id="passwd-header" style="padding-bottom: 20px;">
		<p>Enter your existing password, type a new password, and then type it again to confirm it.</p>
		<p>After saving, you may need to re-enter your credentials and log on again. You will be prompted after your password has been changed successfully.</p>
	</div>
	<script type="text/javascript">
		Ext.onReady(function(){
			var chpassform = Ext.create('App.Inventory.Account.ChangePasswordPanel');
			chpassform.render(document.getElementById('passwd-form'));
			
			setTimeout(function() {
				Ext.get('loading').remove();
				Ext.get('loading-mask').fadeOut({remove:true});
			}, 250);
			
		});
    	</script>
    	<div id="passwd-form" style="padding-bottom: 40px"></div>
    	<div id="passwd-tips">
    		<h2>Common password pitfalls to avoid</h2>
		<p>Cyber criminals use sophisticated tools that can rapidly decipher passwords.</p>
		<p>Avoid creating passwords using:</p>
		<ul>
			<li>
				<p>- <strong>Dictionary words in any language.</strong></p>
			</li>
			<li>
				<p>- <strong>Words spelled backwards, common misspellings, and abbreviations.</strong></p>
			</li>
			<li>
				<p>- <strong>Sequences or repeated characters.</strong>Examples: 12345678, 222222, abcdefg, or adjacent letters on your keyboard (qwerty).</p>
			</li>
			<li>
				<p>- <strong>Personal information.</strong>Your name, birthday, driver's license, passport number, or similar information.</p>
			</li>
		</ul>
    	</div>
</body>
<head>
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="expires" content="-1">
</head>
</html>
