<?php 

$mainwidth = 24;

if(!empty($content_left))
{
	$mainwidth -= $content_left_width;
	$content_left = '
		<div class="pure-u-1 pure-u-md-'.$content_left_width.'-24" id="left">
			<div class="inside">
				'.$content_left.'
			</div>
		</div>';
}
if(!empty($content_right))
{
	$mainwidth -= $content_right_width;
	$content_right = '
		<div class="pure-u-1 pure-u-md-'.$content_right_width.'-24" id="right">
			<div class="inside">
				'.$content_right.'
			</div>
		</div>';
}
if(!empty($content_top))
{
	//$content_top = '';
	
	$content_top = '
		<div class="pure-g">
			<div id="content_top" class="pure-u-1">
				<div class="inside">
					'.$content_top.'
				</div>
			</div>
		</div>';
		
}

if(!empty($content_bottom))
{
	$content_bottom = '
		<div class="pure-g">
			<div class="pure-u-1" id="content_bottom">
				<div class="inside">
					'.$content_bottom.'
				</div>
			</div>
		</div>';
}
if(!empty($content_main))
{
	$content_main = '
	<div class="pure-u-1 pure-u-md-'.$mainwidth.'-24">
		<div class="inside">
			'.$content_main.'
		</div>
	</div>';
}
if(!empty($content_left) && !empty($content_right))
{
	//addStyle('div#content{width:513px;}');
}

?><!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="favicon" href="/favicon.ico" type="image/x-icon" />
	<?php echo getHead(); ?>
	<style type="text/css">#deutschlandtour_message{width:97%;height:50px;}<?php echo str_replace(array("\r","\n"),'',$g_add_css); ?></style>
	<script type="text/javascript">
		var _gaq = _gaq || [];  _gaq.push(['_setAccount', 'UA-43313114-1']);  _gaq.push(['_setDomainName', '<?php echo $_SERVER['HTTP_HOST'];?>']);  _gaq.push(['_trackPageview']); (function() {var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;   ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);  })();
	</script>
	<script type="text/javascript"><?php 
	echo JSMin::minify($g_js_func); ?>	$(document).ready(function(){<?php echo JSMin::minify($js); ?>});</script>
  </head>
  <body<?php echo $g_body_class; ?>>
   <?php getDebugging(); ?>
  
   	<div id="top">
		<div class="inner">
			<div class="pure-g">
				<div class="pure-u-1">
					<div id="layout_logo"><a href="<?php echo $logolink; ?>" title="foodsharing home">food<span>sharing</span></a></div>
                    <?php echo v_locale_switch(); ?>
					<?php echo $msgbar; ?>
					<?php echo $menu['mobile']; ?>
					<div class="menu">
							<?php echo $menu['default']; ?>
					</div>
					<div style="clear:both;"></div>
				</div>
			</div>
		</div>
<?php if(!empty($g_broadcast_message)) {?>
<div class="inner inside msg-inside info"><?php echo $g_broadcast_message;?></div>
<?php }?>
	</div>
	<?php echo $content_overtop; ?>
	<div id="main"<?php if(isMob()) { ?> class="mobile"<?php } ?>>
		<?php echo getBread(); ?>
		<?php echo $content_top; ?>
		<div class="pure-g mainpure">
			<?php 
			if(isMob())
			{
				echo $content_main;
				echo $content_right;
				echo $content_left;
			}
			else
			{
				echo $content_left;
				echo $content_main;
				echo $content_right;
			}
				
			?>
		</div>

		<?php echo $content_bottom; ?>
	</div>
	<?php getTemplate('footer'); ?>
	<?php echo $quizinfo; ?>
	<noscript>
		<div id="nojs">Ohne Javascript l&auml;ft hier leider nix!</div>
	</noscript> 
	<?php printHidden(); ?>

	<div class="pulse-msg ui-shadow ui-corner-all" id="pulse-error" style="display:none;"></div>
	<div class="pulse-msg ui-shadow ui-corner-all" id="pulse-info" style="display:none;"></div>
	<div class="pulse-msg ui-shadow ui-corner-all" id="pulse-success" style="display:none;"></div>
  </body>
</html>
