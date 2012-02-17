# Jason

Jason is a Kohana implementation of the JSON-RPC protocol for SolidCoin, but can be used with other cryptocurrencies as well.

## Usage

	Jason::instance('liecoin')->sendtoaddress('king_colbee_address', 666);

Like so.

	$jason = Jason::instance('solidcoin');
	
	try
	{
		$info = $jason->sc_getinfo();
		print_r($info);
	}
	catch (Jason_Exception $e)
	{
		echo $e;
	}

## Configuration

Create a configuration file `config/jason.php`. Below is an example configuration file.

	return array(
		'solidcoin' => array(
			'url'      => 'http://127.0.0.1:8555',
			'username' => 'herp',
			'password' => 'derp',
		),
		'liecoin' => array(
			'url'      => 'http://127.0.0.1:9333',
			'username' => 'lieCoinIsAScam',
			'password' => 'scammy',
		),
	);
