<?php 
/**
 * Automatically includes classes
*
* @throws Exception
*
* @param  string $class_name  Name of the class to load
* @return void
*/

require_once 'config.inc.php';
require_once 'lib/func.inc.php';
require_once 'lib/Session.php';

//session_init();
S::init();

require_once 'lib/db.class.php';
require_once 'lib/Caching.php';
require_once 'lib/Manual.class.php';
require_once 'lang/' . LOCALE . '/' . LOCALE . '.php';
require_once 'lib/view.inc.php';
require_once 'lib/minify/JSMin.php';

error_reporting(E_ALL);

if(isset($_GET['logout']))
{
	$_SESSION['client'] = array();
	unset($_SESSION['client']);
	\Foodsharing\Refactor\Helper::logout();
}

$content_main = '';
$content_right = '';
$content_left = '';;
$content_top = '';
$content_bottom = '';

$content_left_width = 5;
$content_right_width = 6;

$g_template = 'default';
$content_overtop = '';
$js = '';
$g_js_func = '';
$g_head = '';
$g_title = array('foodsharing');
$g_bread = array();

$g_data = getPostData();

$g_form_valid = true;
$g_ids = array();
$g_script = array();
$g_css = array();
$g_add_css = '';
$hidden = '';

$g_meta = array(
		'description' => 'Auf foodsharing.de kannst Du Deine Lebensmittel vor dem Verfall an soziale Einrichtungen oder andere Personen abgeben',
		'keywords' => 'foodsharing, essen, lebensmittel, ablaufdatum, Lebensmittelverschwendung, essen wegschmeissen, spenden, lebensmitteltausch',
		'author' => 'foodsharing',
		'robots' => 'all',
		'allow-search' => 'yes',
		'revisit-after' => '1 days',
		'google-site-verification' => 'pZxwmxz2YMVLCW0aGaS5gFsCJRh-fivMv1afrDYFrks'
);

$db = new ManualDb();

addHead('<link rel="stylesheet" href="/css/pure/pure.min.css">
    <!--[if lte IE 8]>
        <link rel="stylesheet" href="/css/pure/grids-responsive-old-ie-min.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="/css/pure/grids-responsive-min.css">
    <!--<![endif]-->');

addHidden('<a id="'.id('fancylink').'" href="#fancy">&nbsp;</a>');
addHidden('<div id="'.id('fancy').'"></div>');

addHidden('<div id="u-profile"></div>');
addHidden('<ul id="hidden-info"></ul>');
addHidden('<ul id="hidden-error"></ul>');
addHidden('<div id="comment">'.v_form_textarea('Kommentar').'<input type="hidden" id="comment-id" name="comment-id" value="0" /><input type="hidden" id="comment-name" name="comment-name" value="0" /></div>');
addHidden('<div id="dialog-confirm" title="Wirklich l&ouml;schen?"><p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><span id="dialog-confirm-msg"></span><input type="hidden" value="" id="dialog-confirm-url" /></p></div>');
addHidden('<div id="uploadPhoto"><form method="post" enctype="multipart/form-data" target="upload" action="xhr/?f=addPhoto"><input type="file" name="photo" onchange="uploadPhoto();" /> <input type="hidden" id="uploadPhoto-fs_id" name="fs_id" value="" /></form><div id="uploadPhoto-preview"></div><iframe name="upload" width="1" height="1" src=""></iframe></div>');
//addHidden('<audio id="xhr-chat-notify"><source src="img/notify.ogg" type="audio/ogg"><source src="img/notify.mp3" type="audio/mpeg"><source src="img/notify.wav" type="audio/wav"></audio>');

addHidden('<div id="fs-profile"></div>');

$user = '';
$g_body_class = '';
$g_broadcast_message = $db->qOne('SELECT `body` FROM '.PREFIX.'content WHERE `id` = 51');
if(S::may())
{
	if(isset($_GET['uc']))
	{
		if(fsId() != $_GET['uc'])
		{
			$db->logout();
			goLogin();
		}
	}
	
	$g_body_class = ' class="loggedin"';
	$user = 'user = {id:'.(int)fsId().'};';
	
	/*
	 * little check for chat messages
	 */
}


addJs('
	'.$user.'
	$("#mainMenu > li > a").each(function(){
		if(parseInt(this.href.length) > 2 && this.href.indexOf("'.getPage().'") > 0)
		{
			$(this).parent().addClass("active").click(function(ev){
				//ev.preventDefault();
			});
		}
	});
		
	$("#fs-profile-rate-comment").dialog({
		modal: true,
		title: "",
		autoOpen: false,
		buttons: 
		[
			{
				text: "Abbrechen",
				click: function(){
					$("#fs-profile-rate-comment").dialog("close");
				}
			},
			{
				text: "Absenden",
				click: function(){
					ajreq("rate",{app:"profile",type:2,id:$("#profile-rate-id").val(),message:$("#fsprofileratemsg").val()});
				}
			}
		]
	}).siblings(".ui-dialog-titlebar").remove();
');
addHidden('<div id="fs-profile-rate-comment">'.v_form_textarea('fs-profile-rate-msg',array('desc'=>'...')).'</div>');

if(!S::may())
{
	addJs('clearInterval(g_interval_newBasket);');
}
else
{
	addJs('
		sock.connect();
		user.token = "'.S::user('token').'";
		info.init();
	');
}
/*
 * Browser location abfrage nur einmal dann in session speichern
 */
if($pos = S::get('blocation'))
{
	addJsFunc('
		function getBrowserLocation(success)
		{
			success({
				lat:'.floatval($pos['lat']).',
				lon:'.floatval($pos['lon']).'
			});
		}
	');
}
else
{
	addJsFunc('
		function getBrowserLocation(success)
		{
			if(navigator.geolocation)
			{
				navigator.geolocation.getCurrentPosition(function(pos){
					ajreq("savebpos",{app:"map",lat:pos.coords.latitude,lon:pos.coords.longitude});
					success({
						lat: pos.coords.latitude,
						lon: pos.coords.longitude
					});
				});
			}
		}
	');
}

/*
 * temporary quiz stuff
 */
$quizinfo = '';

//echo S::get('hastodoquiz').' => ' . S::get('hastodoquiz-id');die();

if(S::get('hastodoquiz') === true)
{
	addJs('			
		$(window).resize(function(){
			if($(window).width() < 990)
			{
				$("#quizinfobadge").hide();
			}
			else
			{
				$("#quizinfobadge").show();
			}
		});
		if($(window).width() < 990)
		{
			$("#quizinfobadge").hide();
		}
	');
	
	$date = '12/12/2014';
	if(S::get('hastodoquiz-id') > 1)
	{
		$date = '12/01/2015';
	}
	
	$quizinfo = '
	<a onmouseout="$(this).css({opacity:1});" onmouseover="$(this).css({opacity:0.8});" id="quizinfobadge" href="#" onclick="ajreq(\'quizpopup\',{app:\'quiz\'});$(this).css({left:\'-300px\'});return false;" style="padding:8px;display:block;text-align:center;position:fixed;left:0px;top:50%;height:93px;width:100px;margin-top:-50px;background-color:#46891b;" class="ui-shadow corner-right">
		<i style="color:#fff;font-size:30px;" class="fa fa-bullhorn"></i>
		<h3 style="font-family:\'Alfa Slab One\';font-weight:normal;color:#ffffff;font-size:17px;">Quiz schon gemacht?</h3>
		<span style="font-size:11px;color:#fff;">(bis ' . $date . ')</span>
	</a>';
}


/*
addHead('
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push([\'_setAccount\', \'UA-43313114-1\']);
  _gaq.push([\'_setDomainName\', \'lebensmittelretten.de\']);
  _gaq.push([\'_trackPageview\']);

  (function() {
    var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
    ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>		
');
*/
/*
addHead('<script type=\'text/javascript\'>

var _ues = {
host:\'foodsharingev.userecho.com\',
forum:\'22413\',
lang:\'de\',
tab_corner_radius:5,
tab_font_size:20,
tab_image_hash:\'ZmVlZGJhY2s%3D\',
tab_chat_hash:\'Y2hhdA%3D%3D\',
tab_alignment:\'left\',
tab_text_color:\'#FFFFFF\',
tab_text_shadow_color:\'#00000055\',
tab_bg_color:\'#57A957\',
tab_hover_color:\'#F4A631\'
};

(function() {
    var _ue = document.createElement(\'script\'); _ue.type = \'text/javascript\'; _ue.async = true;
    _ue.src = (\'https:\' == document.location.protocol ? \'https://\' : \'http://\') + \'cdn.userecho.com/js/widget-1.4.gz.js\';
    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(_ue, s);
  })();

</script>');
*/
?>
