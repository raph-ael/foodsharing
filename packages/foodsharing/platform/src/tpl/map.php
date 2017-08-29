<?php 
header("Pragma-directive: no-cache");
header("Cache-directive: no-cache");
header("Cache-control: no-cache");
header("Pragma: no-cache");
header("Expires: 0");

?><!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>foodsharing | Restlos Glücklich!</title>
	<link rel="favicon" href="favicon.ico" type="image/x-icon" />
	<?php echo getHead(); ?>
	
	<link rel="stylesheet" href="/js/markercluster/dist/MarkerCluster.css" />
	<link rel="stylesheet" href="/js/markercluster/dist/MarkerCluster.Default.css" />

	<style type="text/css"><?php echo $g_add_css; ?></style>
	
	<script type="text/javascript">
		var _gaq = _gaq || [];  _gaq.push(['_setAccount', 'UA-43313114-1']);  _gaq.push(['_setDomainName', '<?php echo $_SERVER['HTTP_HOST']; ?>']);  _gaq.push(['_trackPageview']); (function() {var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;   ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);  })();
	</script>
	<script type="text/javascript">
	<?php echo JSMin::minify($g_js_func); ?>
	$(document).ready(function(){
		<?php echo JSMin::minify($js); ?>
	});
	</script>
	
</head>
<body<?php echo $g_body_class; ?>>
	<div id="top">
		<div class="inner">
			<div class="pure-g">
				<div class="pure-u-1">
					<div id="layout_logo"><a href="/" title="foodsharing home"><span>food</span>sharing</a></div>
					<?php echo $msgbar; ?>
					<?php echo $menu['mobile']; ?>
					<div class="menu">
							<?php echo $menu['default']; ?>
					</div>
					<div style="clear:both;"></div>
				</div>
			</div>
		</div>
	</div>

<?php echo $content_main; ?>
<?php echo $content_top; ?>
<noscript>
	<div id="nojs">Ohne Javascript l&auml;ft hier leider nix!</div>
</noscript> 
<?php printHidden(); ?>
<div class="pulse-msg ui-shadow" id="pulse-error" style="display:none;"></div>
<div class="pulse-msg ui-shadow" id="pulse-info" style="display:none;"></div>
<div class="pulse-msg ui-shadow ui-corner-all" id="pulse-success" style="display:none;"></div>
</body>
</html>
