<?php
/**
 * Data to sockets can only send as one byte-string this class will help to have all time the same data structure sending to socket server
 * 
 * @author ra
 */
class SocketData
{
	private $type;
	private $data;
	private $status;

	/**
	 * constructor
	 * 
	 * @param string serialized $data | array $data
	 * 
	 * @return boolean
	 */
	public function __construct($data = false)
	{
		$this->type = 'email';
		$this->data = array();
		$this->status = 1;

		if($data !== false)
		{
			$this->type = $data['type'];
			$this->data = $data['data'];
			$this->status = $data['status'];
			
			return true;
		}

		return false;
	}

	/**
	 * Get an stored data value by key
	 * 
	 * @param string $key
	 */
	public function get($key)
	{
		return $this->data[$key];
	}

	/**
	 * Add or update an associatet data value
	 * 
	 * @param string $key
	 * @param mixed $value
	 */
	public function set($key,$value)
	{
		$this->data[$key] = $value;
	}
	
	/**
	 * Will append an value to a data-list if the value of specific key is not defined this method will do it for you
	 * 
	 * @param string $key
	 * @param mixed $value
	 */
	public function append($key,$value)
	{
		if(!isset($this->data[$key]))
		{
			$this->data[$key] = array();
		}
		$this->data[$key][] = $value;
	}

	/**
	 * each data socket data handlich request and response will have an status
	 * 
	 * @param integer $status
	 */
	public function setStatus($status)
	{
		$this->status = (int)$status;
	}

	/**
	 * get the status of response
	 * 
	 * @return integer
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * will set the whole data array in one step
	 * 
	 * @param array $data
	 */
	public function setData($data)
	{
		$this->data = $data;
	}
	
	/**
	 * get the whole data array
	 * 
	 * @return array
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * to know how to hande an request each socketData item will have defined an type
	 * here to get the current
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * to know how to hande an request each socketData item will have defined an type
	 * here we can set the type, the server class have to know how to handle the type you specify
	 * @param string
	 */
	public function setType($type)
	{
		$this->type = $type;
	}

	/**
	 * serialize the data object to give it to the server
	 * 
	 * @return string
	 */
	public function toString()
	{
		return serialize(array(
			'type' => $this->type,
			'status' => $this->status,
			'data' => $this->data
		));
	}
	
	/**
	 * convert object to normal php array
	 * 
	 * @return array
	 */
	public function toArray()
	{
		return array(
			'type' => $this->type,
			'status' => $this->status,
			'data' => $this->data
		);
	}

	/**
	 * convert serialized data to socketData object
	 * 
	 * @param string $string
	 * 
	 * @return boolean
	 */
	public function fromString($string)
	{
		$ret = @unserialize($string);
		if($ret !== null)
		{
			$this->setType($ret['type']);
			$this->setData($ret['data']);
			$this->setStatus($ret['status']);
				
			return true;
		}

		return false;
	}
}