<?php
/**
 * class give you methods to send data to the client for nice outputs
 * 
 * @author raphael
 *
 */
class Xhr
{
	/*
	 * message array to display simple popup messages after the request
	 */
	private $messages;
	
	/*
	 * additional script will be executed if the request success
	 */
	private $script;
	
	/*
	 * status code has to be set default 1 then will be execure the response
	 */
	private $status = 1;
	
	/*
	 * date it will be send to the client and is available under global ajax object (ajax.data)
	 */
	private $data;
	
	public function __construct()
	{
		// set default data
		$this->messages = array();
		$this->script = '';
		$this->status = 1;
		$this->data = array();
	}
	
	/**
	 * MEthod to set the status code returned to the client
	 * @param Integer $code
	 */
	public function setStatus($code)
	{
		$this->status = (int)$code;
	}
	
	/**
	 * Add data accecable by client side js code
	 * example: 
	 * 	$xhr->addData('tree_id',1);
	 * 	is accesable in global Javascript with:
	 * 	alert(ajax.data.tree_id); => output is "1"
	 * 
	 * @param string $key
	 * @param $value
	 */
	public function addData($key,$value)
	{
		$this->data[$key] = $value;
	}
	
	/**
	 * Method to add an simple pop up message to the cloent, there are 3 types of messages info, error and success can be added as 2nd parameter, default is info
	 * 
	 * @param String $msg
	 * @param string $type
	 */
	public function addMessage($msg,$type='info')
	{
		$this->messages[] = array(
			'type' => $type,
			'text' => $msg
		);
	}
	
	/**
	 * Method to add javascript code programmaticly this will be executed on client side
	 * @param String $js
	 */
	public function addScript($js)
	{
		$this->script .= "\n" . $js;
	}
	
	/**
	 * Method to send all the stuff right formattet to the client
	 * 
	 */
	public function send()
  	{
  		header('content-type: application/json; charset=utf-8');
  		$out = array(
  			'status' => $this->status,
  			'data' => $this->data,
  			'script' => $this->script
  		);
  		
  		if(!empty($this->messages))
  		{
  			$out['msg'] = $this->messages;
  		}
  		
  		echo json_encode($out, JSON_PARTIAL_OUTPUT_ON_ERROR);
  		exit();
  	}
  	
  	/**
  	 * Set the time limit for this ajax call
  	 * 
  	 * @param int $seconds
  	 */
  	public function keepAlive($seconds)
  	{
  		ini_set('max_execution_time', $seconds);
  		set_time_limit($seconds);
  	}
}
