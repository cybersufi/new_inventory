<html>
	<head>
		<title>Database Error</title>
		<style type="text/css">
			body {
				margin: 40px;
				font-family: Lucida Grande, Verdana, Sans-serif;
				font-size: 12px;
				background-color: #CCC;
				background: -webkit-linear-gradient(#CCC, #AAA);
				background: -moz-linear-gradient(#CCC, #AAA);
				filter: progid:DXImageTransform.Microsoft.gradient(startColorStr=#CCCCCC, endColorStr=#AAAAAA, GradientType=1);
				-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#CCCCCC, endColorstr=#AAAAAA, GradientType=1)";
				background-attachment: fixed;
			}

			#content  {
				border: #999 1px solid;
				background-color: #fff;
				padding: 20px 20px 12px 20px;
				-moz-box-shadow: 2px 5px 12px #555;
				-webkit-box-shadow: 2px 5px 12px #555;
				box-shadow: 2px 5px 12px #555;
			}
			
			#footer {
				color: #777;
				-webkit-margin-start: 3px;
				margin-top: 30px;
			}

			h1 {
				font-weight: normal;
				font-size: 18px;
				line-height: 30px;
				color #990000;
				margin: 0 0 4px 0;
			}
			
			h1 img {
				border: 0;
				float: right;
				-webkit-margin-start: 20px;
				margin-top: -4px;
			}
		</style>
	</head>
	<body>
		<div id="content">
			<h1>
				<?php echo $heading; ?>
				<img alt="error icon" src="<?php echo config_item('base_url'); ?>/assets/images/pages-icon/error.png" />
			</h1>
			<div id="errorSummary">
				<span><?php echo $message; ?></span>
			</div>
			
			<div id="suggestions">
				<span>Here are some suggestions:</span>
				<ul>
					<li>
						<p>Refresh this page.</p>
					</li>
					<li>
						<script type="text/javascript">
							var base_url = '<?php echo config_item('base_url'); ?>';
							var url = (self == top) ? base_url : "javascript:parent.change_parent_url()";
							document.write('<p>Return to the <a href="'+url+'">homepage</a></p>');
						</script>
					</li>
					<li>
						<p>If the problem persist, please contact the site administrator</p>
					</li>
				</ul>
			</div>
			<div id="footer"><?php echo config_item('site_name'); ?></div>
		</div>
	</body>
</html>