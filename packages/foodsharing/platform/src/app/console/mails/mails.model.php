<?php
class MailsModel extends ConsoleModel
{
	public function saveMessage(
			$mailbox_id, // mailbox id
			$folder, // folder
			$from, // sender
			$to, // to
			$subject, // subject
			$body,
			$html,
			$time, // time,
			$attach = '', // attachements
			$read = 0,
			$answer = 0
	)
	{
		return $this->insert('
			INSERT INTO `'.PREFIX.'mailbox_message`
			(
				`mailbox_id`,
				`folder`,
				`sender`,
				`to`,
				`subject`,
				`body`,
				`body_html`,
				`time`,
				`attach`,
				`read`,
				`answer`
			)
			VALUES
			(
				'.$this->intval($mailbox_id).',
				'.$this->intval($folder).',
				'.$this->strval($from).',
				'.$this->strval($to).',
				'.$this->strval($subject).',
				'.$this->strval($body).',
				'.$this->strval($html,true).',
				'.$this->strval($time).',
				'.$this->strval($attach).',
				'.$this->intval($read).',
				'.$this->intval($answer).'
			)
		');
	}
	
	public function getMailboxId($mb_name)
	{
		return $this->qOne('
			SELECT id FROM '.PREFIX.'mailbox WHERE `name` = '.$this->strval($mb_name).'
		');
	}
	
	public function getMailboxIds($mb_names)
	{
		$where = array();
		foreach ($mb_names as $n)
		{
			$where[] = $this->strval($n);
		}
		return $this->qCol('
			SELECT id FROM '.PREFIX.'mailbox WHERE `name` IN('.implode(',', $where).')
		');
	}
}