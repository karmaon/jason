# Jason

Jason is a Kohana implementation of the JSON-RPC protocol for SolidCoin, but can be used with other cryptocurrencies as well.

## Usage

Either this

	$jason = new Jason('solidcoin');
	$jason->sc_getinfo();

or this.

	Jason::instance('liecoin')->sendtoaddress('king_colbee_address', 666);

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
