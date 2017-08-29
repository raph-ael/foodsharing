<?php
class SocketClient
{
	private $sock;
	private $host;
	private $port;
	
	private $queue;
	private $queue_size;

	public function __construct($port = 6010, $host = '127.0.0.1')
	{
		
		$this->host = $host;
		$this->port = $port;
		$this->queue = array();
		$this->queue_size = 0;
	}

	private function connect()
	{
		$max_try = 5;
		while(!($this->sock = socket_create(AF_INET, SOCK_STREAM, 0)))
		{				
			sleep(1);
				
			$max_try--;
			if($max_try == 0)
			{
				return false;
				break;
			}
		}
			
		//Connect socket to remote server
		$max_try = 5;
		while(!@socket_connect($this->sock , $this->host , $this->port))
		{				
			sleep(5);
			$max_try--;
			if($max_try == 0)
			{
				return false;
				break;
			}
		}
			
		return true;
	}
	
	public function queue($obj)
	{
		/*
		 * prevent memory overflow
		 */
		if(memory_get_usage()> 400000)
		{
			$this->send();
		}
		
		$this->queue[] = $obj->toArray();
	}

	
	private function convert($size)
	{
		$unit=array('b','kb','mb','gb','tb','pb');
		return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
	}
	
	public function serverSignal($signal)
	{
		$this->connect();
		
		$data = new SocketData();
		$data->setType('signal');
		$data->set('term', 'close');
		
		$message = serialize(array($data->toArray()));
		
		//Send the message to the server
		
		$max_try = 5;
		while( ! socket_send ( $this->sock , $message , strlen($message) , 0))
		{
			$max_try--;
			sleep(1);
			if($max_try == 0)
			{
				return false;
				break;
			}
		}
	}
	
	/**
	 * Method to send data to socket server
	 *
	 * @param SocketData $socketData
	 */
	public function send()
	{	
		$this->connect();
		$message = serialize($this->queue);
		//Send the message to the server
		
		$max_try = 5;
		while( ! socket_send ( $this->sock , $message , strlen($message) , 0))
		{				
			$max_try--;
			if($max_try == 0)
			{
				$id = uniqid();
				
				file_put_contents(ROOT_DIR . 'data/lostmessage/' . $id .'.msg',$message );
				
				return false;
				break;
			}
		}
		
		$this->queue = array();

		/*
		 * have a little bit trust that socket message will arrive.. cause waiting for success answer will block the queue and we have the same as before..
		 * 
		if($result = socket_read($this->sock, 1024))
		{
			$data = new SocketData();
			$data->fromString($result);
				
			if ($data->getStatus() == 1)
			{
				return true;
			}
		}
		return false;
		*/
	}
	
	public function close()
	{
		@socket_close($this->sock);
	}
}