<?php
class SocketServer
{
	private $sock;
	private $client;
	private $host;
	private $port;
	private $allowedClients;
	private $runs;
	private $handler;

	public function __construct($port = 6010,$host = '127.0.0.1')
	{		
		$this->host = $host;
		$this->port = $port;
		$this->runs = false;
		$this->client = false;
		$this->handler = array();

		$this->allowedClients = array(
			$this->host => true
		);
	}
	
	public function addHandler($identifier,$class, $method)
	{
		$this->handler[$identifier] = array(
			'class' => $class,
			'method' => $method
		);
	}

	public function start()
	{
		$this->runs = true;

		$max_try = 5;
		while (!($this->sock = @socket_create(AF_INET, SOCK_STREAM, 0)))
		{
			$errorcode = socket_last_error();
			$errormsg = socket_strerror($errorcode);

			error('Couldn\'t create socket: [' . $errorcode . '] ' . $errormsg);

			sleep(1);
			$max_try--;
			if ($max_try == 0)
			{
				error('cannot start socket server');
				return false;
			}
		}

		success('Socket created');

		// Bind the source address
		$max_try = 15;
		while( !@socket_bind($this->sock, $this->host , $this->port))
		{
			$errorcode = socket_last_error();
			$errormsg = socket_strerror($errorcode);

			error('Could not bind socket: [' . $errorcode . '] ' . $errormsg);
			fs_info('sleeping 30 seconds...');
			
			sleep(30);
			$max_try--;
			if ($max_try == 0)
			{
				error('cannot start socket server');
				return false;
			}
		}

		success('Socket bind OK');

		$max_try = 5;
		while(!@socket_listen ($this->sock , 20))
		{
			$errorcode = socket_last_error();
			$errormsg = socket_strerror($errorcode);

			error('Could not listen on socket: [' . $errorcode . '] ' . $errormsg);

			sleep(1);
			$max_try--;
			if ($max_try == 0)
			{
				error('cannot start socket server');
				return false;
			}
		}

		success('Socket listen OK');

		fs_info('Waiting for connections...');

		//start loop to listen for incoming connections
		while (true && $this->runs)
		{
			//Accept incoming connection - This is a blocking call
			$this->client =  socket_accept($this->sock);

			//display information about the client who is connected
			if(socket_getpeername($this->client , $address , $port))
			{
				fs_info('Client ' . $address . ' : ' . $port . ' is connected.');

				/*
				 * check client IP is OK to connect
				*/
				if(isset($this->allowedClients[$address]))
				{
					//read data from the incoming socket max input 15 MB
						
					if($data = $this->getSocketData())
					{						
						foreach ($data as $d)
						{
							$this->handleRequest($d);
						}
					}

					//sleep(1);
					// Display output  back to client

				}
				else
				{
					error('refuse connection from: '.$address);
				}
				
				@socket_close($this->client);
			}
		}
	}

	private function sendStatus($client,$status = 1)
	{
		$data = new SocketData();
		$data->setStatus(1);

		socket_write($client, $data->toString());
	}

	public function getSocketData()
	{
		// get max 150 MB Data from client
		if($input = socket_read($this->client, 1966080))
		{
			$data = @unserialize($input);
			if($data != null)
			{
				return $data;
			}
		}

		return false;
	}

	/**
	 * Method will handle an arrives request from socket Client
	 *
	 * @param serialized SocketData $data
	 */
	private function handleRequest($data)
	{
		$data = new SocketData($data);
		
		switch ($data->getType())
		{
			case 'signal':
				$this->handleSignal($data);
				break;

			default:
				if(isset($this->handler[$data->getType()]))
				{
					$class = $this->handler[$data->getType()]['class'];
					$method = $this->handler[$data->getType()]['method'];
					
					$class::$method($data);
				}
				break;
		}
	}

	private function handleSignal($data)
	{
		if ($data->get('term') == 'close')
		{
			fs_info('goodbye...');
			@socket_shutdown($this->sock);
			@socket_close($this->client);
			@socket_close($this->sock);
			$this->runs = false;
		}
	}	
}