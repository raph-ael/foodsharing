<?php 
class MainXhr extends Control
{
	
	public function __construct()
	{
		$this->model = new MainModel();
		$this->view = new MainView();

		parent::__construct();
	}
	
	public function picupload()
	{
		$function = '';
		$newname = '';
		
		$check = false;
		
		if(isset($_FILES['picture']) && (int)$_FILES['picture']['size'] > 0)
		{
			$id = strip_tags($_POST['id']);
			$inid = strip_tags($_POST['inid']);
			$upload = new fUpload();
			$upload->setMIMETypes(
			    array(
			        'image/gif',
			        'image/jpeg',
			        'image/pjpeg',
			        'image/png'
			    ),
			    s('no_image')
			);
			try 
			{
				$file = $upload->move(PUBLIC_TMP_DIR, 'picture');
				$newname = uniqid() . '.' . strtolower($file->getExtension());
				rename($file->getPath(), PUBLIC_TMP_DIR . '/' . $newname);
				copy(PUBLIC_TMP_DIR . '/' . $newname, PUBLIC_TMP_DIR . '/thumb-' . $newname);
				$thumb = new fImage(PUBLIC_TMP_DIR . '/thumb-' . $newname);
				$thumb->cropToRatio(1, 1);
				$thumb->resize(250, 250);
				
				$function = 'placeThumb();';
				$check = true;
				
			}
			catch (Exception $e)
			{
			    throw $e;
				$check = false;
			}
		}
		
		if(!$check)
		{
			$function = 'window.parent.pulseError(\'Sorry, Dieses Foto konnte nicht verarbeitet werden.\');window.parent.$(\'.attach-preview\').hide();';
		}
		
		echo '<html><head><title>upload</title>
		<script type="text/javascript">
			function placeThumb()
			{
				window.parent.$(".ui-dialog-buttonpane .ui-button").button( "option", "disabled", false );
				window.parent.$(\'#'.$inid.'-filename\').val(\''.$newname.'\');
				window.parent.$(\'.attach-preview\').html(\'<a href="#" onclick="return false;" class="preview-thumb" rel="wallpost-gallery"><img height="60" src="/tmp/thumb-' . $newname . '">&nbsp;</a><div style="clear:both"></div>\');
			}
		</script>
		</head><body onload="'.$function.'"></body></html>';
		exit();
	}
}
