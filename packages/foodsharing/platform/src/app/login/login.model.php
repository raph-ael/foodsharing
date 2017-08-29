<?php
class LoginModel extends Model
{
	
	public function activate($email,$token)
	{
		if((int)$this->update('UPDATE '.PREFIX.'foodsaver SET `active` = 1 WHERE email = '.$this->strval($email).' AND `token` = '.$this->strval($token)) > 0)
		{
			return true;
		}
		return false;
	}
	
	public function insertNewUser($data,$token)
	{
		/*
			 	[iam] => org
				[name] => Peter
				[email] => peter@pan.de
				[pw] => 12345
				[avatar] => 5427fb55f3a5d.jpg
				[phone] => 02261889971
				[lat] => 48.0649838
				[lon] => 7.885475300000053
				[str] => Bauerngasse
				[nr] => 6
				[plz] => 79211
				[country] => DE
		*/
		$newsletter = 0;
		if($data['newsletter'])
		{
			$newsletter = 1;
		}
		return $this->insert('
			INSERT INTO 	`'.PREFIX.'foodsaver`
			(
				`rolle`,
				`type`,
				`active`,
				`plz`,
				`email`,
				`passwd`,
				`name`,
				`nachname`,
				`anschrift`,
				`telefon`,
				`newsletter`,
				`geschlecht`,
				`anmeldedatum`,
				`stadt`,
				`lat`,
				`lon`,
				`token`,
				`photo`
			)
			VALUES
			(
				0,
				'.(int)$data['type'].',
				0,
				'.$this->strval($data['plz']).',
				'.$this->strval($data['email']).',
				'.$this->strval($this->encryptMd5($data['email'], $data['pw'])).',
				'.$this->strval($data['name']).',
				'.$this->strval($data['surname']).',
				'.$this->strval($data['str'].' '.trim($data['nr'])).',
				'.$this->strval($data['phone']).',
				'.$this->intval($newsletter).',
				'.$this->intval($data['gender']).',
				NOW(),
				'.$this->strval($data['city']).',
				'.$this->strval($data['lat']).',
				'.$this->strval($data['lon']).',
				'.$this->strval($token).',
				'.$this->strval($data['avatar']).'
			)');
	}
	
	public function checkResetKey($key)
	{
		return $this->qOne('SELECT `foodsaver_id` FROM `'.PREFIX.'pass_request` WHERE `name` = '.$this->strval($key));
	}
	
	public function newPassword($data)
	{
		if((int)strlen($data['pass1']) > 4)
		{
			if($fsid = $this->qOne('SELECT `foodsaver_id` FROM `'.PREFIX.'pass_request` WHERE `name` = '.$this->strval($data['k'])))
			{
				if($fs = $this->qRow('SELECT `id`,`email` FROM `'.PREFIX.'foodsaver` WHERE `id` = '.$this->intval($fsid)))
				{
					$this->del('DELETE FROM `'.PREFIX.'pass_request` WHERE `foodsaver_id` = '.(int)$fs['id']);
					return $this->update('UPDATE `'.PREFIX.'foodsaver` SET `passwd` = '.$this->strval($this->encryptMd5($fs['email'], $data['pass1'])).' WHERE `id` = '.(int)$fs['id'] );
				}
			}
		}
	
		return false;
	}
}
