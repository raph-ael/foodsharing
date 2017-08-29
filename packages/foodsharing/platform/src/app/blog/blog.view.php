<?php
class BlogView extends View
{
	public function listArticle($data)
	{
		$rows = array();
		foreach ($data as $d)
		{
			$row_tmp = array();
			
			if(isOrgateam() || isBotFor($d['bezirk_id']))
			{
				$row_tmp[] = array('cnt' => v_activeSwitcher('blog_entry',$d['id'],$d['active']));
			}
			else
			{
				$row_tmp[] = array('cnt' => s('status_'.$d['active']));
			}
			$row_tmp[] = array('cnt' => '<span style="display:none;">a'.$d['time_ts'].'</span><a class="linkrow ui-corner-all" href="/?page=blog&sub=edit&id='.$d['id'].'">'.format_d($d['time_ts']).'</a>');
			$row_tmp[] = array('cnt' => '<a class="linkrow ui-corner-all" href="/?page=blog&sub=edit&id='.$d['id'].'">'.$d['name'].'</a>');
			$row_tmp[] = array('cnt' => v_toolbar(array('id'=>$d['id'],'types' => array('edit','delete'),'confirmMsg'=>sv('delete_sure',$d['name']))));
				
				
			$rows[] = $row_tmp;
		}
		
		$theads = array();
		
		$theads[] = array('name'=>s('status'),'sort' => false,'width' => 140);
		$theads[] = array('name' => s('date'),'width' => 80);
		$theads[] = array('name' => s('name'));
		$theads[] = array('name' => s('actions'),'sort' => false,'width' => 50);
		
		$table = v_tablesorter($theads,$rows);
		
		
		return (v_field($table,s('article')));
	}
	
	public function newsPost($news)
	{
		return v_field('<div class="news-post full"><h2><a href="/?page=blog&sub=read&id='.$news['id'].'">'.$news['name'].'</a></h2><p class="small"><span class="time">'.niceDate($news['time_ts']).'</span><span class="name"> von '.$news['fs_name'].'</span></p>'.$this->getImage($news,'crop_0_528_') . '<p>'.autolink($news['body']).'</p><div style="clear:both;"></div></div>');
	}
	
	public function newsListItem($news)
	{
		return '<div class="news-post"><h2><a href="/?page=blog&sub=read&id='.$news['id'].'">'.$news['name'].'</a></h2><p class="small"><span class="time">'.niceDate($news['time_ts']).'</span><span class="name"> von '.$news['fs_name'].'</span></p>'.$this->getImage($news) . '<p>'.autolink($news['teaser']).'</p><p><a class="button" href="/?page=blog&sub=read&id='.$news['id'].'">weiterlesen</a></p><div style="clear:both;"></div></div>';
	}
	
	private function getImage($news,$prefix = 'crop_1_528_')
	{
		if(!empty($news['picture']))
		{
			return '<a href="/?page=blog&sub=read&id='.$news['id'].'"><img class="corner-all" src="/images/' . str_replace('/','/'.$prefix,$news['picture']).'" /></a>';
		}
		else
		{
			return '';
		}
	}
	
	public function pager($page)
	{
		$links = '';
		if($page > 1)
		{
			$links .= '<a class="button" href="/?page=blog&p='.($page-1).'"><i class="fa fa-arrow-circle-left"></i></a>';
		}
		
		$links .= '<a class="button" href="/?page=blog&p='.($page+1).'"><i class="fa fa-arrow-circle-right"></i></a>';
		
		return '<p class="pager">'.$links.'</p>';
	}
	
	public function blog_entry_form($bezirke,$add = false)
	{		
		$bezirkchoose = '';
		if($add)
		{
			$title = s('neu_blog_entry');
		}
		else
		{
			$title = s('edit_article');
			global $g_data;
			addContent(v_field(
				v_activeSwitcher('blog_entry', $_GET['id'], $g_data['active']),
				'Status',
				array('class'=>'ui-padding')
			),CNT_LEFT);
		}
		if(is_array($bezirke) && count($bezirke) > 1)
		{
			$bezirkchoose = v_form_select('bezirk_id',array('values'=>$bezirke));
		}
		elseif (is_array($bezirke))
		{
			$bezirk = end($bezirke);
			$title = 'Neuer Artikel für '.$bezirk['name'];
			$bezirkchoose = v_form_hidden('bezirk_id', $bezirk['id']);
		}
		return v_form('test', array(
			v_field(
				$bezirkchoose.
				v_form_text('name').v_form_textarea('teaser',array('style'=>'height:75px;')).
				v_form_picture('picture',array('resize'=>array(250,528),'crop'=>array((250/135),(528/170)))),
	
				$title ,
				array('class'=>'ui-padding')
			
			),
			v_field(v_form_tinymce('body',array('nowrapper'=>true,'public_content'=>true)), 'Inhalt')
		));
	}
}
