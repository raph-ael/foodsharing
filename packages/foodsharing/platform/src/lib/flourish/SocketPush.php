<?php
/**
 * Mail class to retrieve mails to send and hadly it asynchron
 * 
 * @author ra
 */
class SocketPush
{
	private $data;
	
	public function __construct()
	{	
		$this->data = new SocketData();
		
		$this->data->setType('push');
	}
	
	public function setMessage($message)
	{
		$this->data->set('message', $message);
	}
	
	public function setTitle($title)
	{
		$this->data->set('title', $title);
	}
	
	public function setConversationId($id)
	{
		$this->data->set('cid', $id);
	}
	
	public function toArray()
	{		
		return $this->data->toArray();
	}
}
