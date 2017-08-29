<?php
class BellView extends View
{
	public function bellList($bells)
	{
		$list = '';
	
		if(!empty($bells))
		{
			foreach ($bells as $b)
			{
				/*
				 *  [id] => 1
				    [name] => forum_answer_title
				    [name_var] => a:1:{s:9:"forumname";s:7:"Raphael";}
				    [body] => forum_answer
				    [body_var] => Array
				        (
				            [name] => Orgateam
				        )
				
				    [attr] => Array
				        (
				            [href] => ?page=bezirk&bid=258&sub=forum&tid=707&pid=12835#post12835
				        )
				
				    [icon] => fa fa-comment
				    [identifier] => forum-post-12835
				    [time] => 0000-00-00 00:00:00
				    [seen] => 0
				 */
				$unread = 0;
				
				if($b['seen'] == 0)
				{
					$unread = 1;
				}
				
				$attr = ' href="#" onclick="return false;"';
				if(!empty($b['attr']))
				{
					$attr = '';
					foreach ($b['attr'] as $key => $a)
					{
						$attr .= ' '.$key.'="'.$a.'"';
					}
				}
				
				$icon = '<i class="fa fa-bullhorn"></i>';
				if(!empty($b['icon']))
				{
					if(substr($b['icon'],0,1) == '/')
					{
						$icon = '<span class="pics"><img src="'.$b['icon'].'" /></span>';
					}
					else
					{
						$icon = '<span class="icon"><i class="'.$b['icon'].'"></i></span>';
					}
				}
				
				$close = '';
				if($b['closeable'] == 1)
				{
					$close = '<span onclick="info.delBell('.$b['id'].');return false;" class="button close"><i class="fa fa-close"></i></span>';
				}
				
				$list .= '<li id="belllist-'.$b['id'].'" class="unread-'.$unread.'"><a'.$attr.'>'.$close.$icon.'<span class="names">'.sv($b['name'],$b['vars']).'</span><span class="msg">'.sv($b['body'],$b['vars']).'</span><span class="time">'.niceDate($b['time_ts']).'</span><span class="clear"></span></a></li>';
			}
		}
		else
		{
			$list = '<li class="noconv">'.v_info(s('no_bells')).'</li>';
		}
	
		return $list;
	
	}
}
