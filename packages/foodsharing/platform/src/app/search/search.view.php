<?php
class SearchView extends View
{
	public function searchBox($value = '')
	{
		$s_msg = 'Suche nach Namen, Adressen und Betrieben in Deiner Region...';
		if(isOrgateam())
		{
			$s_msg = 'Suche nach Namen, Bezirken oder Betrieben...';
		}
		
		return '
		<form method="get" id="seachForm">
			<input type="hidden" name="page" value="search" />
			<div id="searchBox">
				<input class="search text" type="text" name="q" placeholder="'.$s_msg.'" value="'.$value.'" /><input type="submit" id="seachGo" value="Suche" class="button">
			</div>
			
		</form>';
	}
}