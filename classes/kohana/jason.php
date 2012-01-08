<?php

class Kohana_Jason {

	protected static $_instance;

	protected $_name;

	protected $_url;

	protected $_username = NULL;

	protected $_password = NULL;

	protected $_id;

	protected function __construct($name)
	{
		$this->_name = $name;

		$config = Kohana::$config->load('jason')->get($this->_name);
		
		$this->_url = $config['url'];
		$this->_username = $config['username'];
		$this->_password = $config['password'];
		$this->_id = 1;
	}

	public static function instance($name)
	{
		if ( ! isset(self::$_instance))
		{
			Kohana_Jason::$_instance = new Kohana_Jason($name);
		}

		return Kohana_Jason::$_instance;
	}

	public function __call($method, $params)
	{
		if ( ! is_scalar($method))
			throw new Jason_Exception('Method name must be scalar');

		$request = json_encode(array(
			'method' => $method,
			'params' => $params,
			'id'     => $this->_id,
		));

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
		curl_setopt($ch, CURLOPT_URL, $this->_url);
		curl_setopt($ch, CURLOPT_USERPWD, $this->_username.':'.$this->_password);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
		
		$response = curl_exec($ch);
		
		curl_close($ch);

		if ( ! $response)
			throw new Jason_Exception('Unable to connect to '.$this->_url);

		$response = json_decode($response, TRUE);

		if ($response['id'] != $this->_id)
			throw new Jason_Exception ('Incorrect response ID (request ID: '.$this->_id.', response ID: '.$response['id'].')');

		if ( ! is_null($response['error']))
			throw new Jason_Exception('Request error: '.print_r($response['error']));

		$this->_id++;

		return $response['result'];
	}

}
