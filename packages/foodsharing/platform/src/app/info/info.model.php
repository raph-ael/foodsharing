<?php
class InfoModel extends Model
{
	/**
	 * check if there are unread messages in conversation give back the conversation ids
	 *
	 * @return Ambigous <boolean, array >
	 */
	public function checkConversationUpdates()
	{
		return $this->qCol('SELECT conversation_id FROM '.PREFIX.'foodsaver_has_conversation WHERE foodsaver_id = '.(int)fsId().' AND unread = 1');
	}
	
	/**
	 * check if there are unread Bell messages
	 *
	 * @return Ambigous <boolean, array >
	 */
	public function checkBellUpdates()
	{
		return $this->qCol('SELECT bell_id FROM '.PREFIX.'foodsaver_has_bell WHERE foodsaver_id = '.(int)fsId().' AND seen = 0');
	}
	
	/**
	 * returns the count of new fairteiler
	 */
	public function getFairteilerBadgdeCount()
	{
		if($ids = $this->getBotBezirkIds())
		{
			return $this->qOne('SELECT COUNT(id) FROM '.PREFIX.'fairteiler WHERE bezirk_id IN('.implode(',',$ids).') AND `status` = 0');
		}
	}
}