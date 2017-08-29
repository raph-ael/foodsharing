<?php
/**
 * Data structure to store mail data for asynchronous queue
 * 
 * @author ra
 */
class AsyncMail
{
	private $data;
	
	public function __construct()
	{	
		$this->data = array(
			'recipients'=>array(),
	        'attachments'=>array(),
			'from'=>array(DEFAULT_EMAIL,DEFAULT_EMAIL_NAME),
		    'body'=>'',
		    'html'=>false,
		    'subject'=>DEFAULT_EMAIL_NAME,
		    'identifier'=>'');
	}
	
	public function addRecipient($email,$name = null)
	{
		$this->data['recipients'][] = array($email,$name);
	}
	
	public function setFrom($email,$name = null)
	{
		$this->data['from'] = array($email,$name);
	}
	
	public function setBody($body)
	{
		$body = str_replace(array('<br>','<br />','<br/>','<p>','</p>','</ p>'),"\n",$body);
		$body = strip_tags($body);
		$this->data['body'] = $body;
	}
	
	public function setSubject($subject)
	{
		$subject = str_replace(array('\n'), " ", $subject);
		$this->data['subject'] = $subject;
	}
	
	public function setHtmlBody($html)
	{
		$this->data['html'] = $html;
	}
	
	public function addAttachment($file,$name = null)
	{
		if($name == null) 
		{
			$name = explode('/',$file);
			$name = end($name);
		}
		
		if(file_exists($file))
		{
			$this->data['attachments'][] = array($file,$name);
		}
	}
	
	public function clearRecipients()
	{
		return $this->data['recipients'] = array();
	}
	
	public function setIdentifier($identifier)
	{
		$this->data['identifier'] = $identifier;
	}
	
	public function toArray()
	{		
		return $this->data;
	}

	public function send()
	{
		Mem::queueWork('email', $this->toArray());
	}
}
