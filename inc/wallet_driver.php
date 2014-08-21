<?php 
/*
 *  © BitcoinDice 


 
*/

if (!isset($included)) exit();

include 'driver-conf.php';

class jsonRPCClient {
	private $debug;
	private $url;
	private $id;
	private $notification = false;
	public function __construct($url,$debug = false) {
		$this->url = $url;
		empty($proxy) ? $this->proxy = '' : $this->proxy = $proxy;
		empty($debug) ? $this->debug = false : $this->debug = true;
		$this->id = 1;
	}
	public function setRPCNotification($notification) {
		empty($notification) ?
							$this->notification = false
							:
							$this->notification = true;
	}
	public function __call($method,$params) {
		if (!is_scalar($method)) {
			throw new Exception('Method name has no scalar value');
		}
		if (is_array($params)) {
			$params = array_values($params);
		} else {
			throw new Exception('Params must be given as array');
		}
		if ($this->notification) {
			$currentId = NULL;
		} else {
			$currentId = $this->id;
		}
		$request = array(
						'method' => $method,
						'params' => $params,
						'id' => $currentId
						);
		$request = json_encode($request);
		$this->debug && $this->debug.='***** Request *****'."\n".$request."\n".'***** End Of request *****'."\n\n";
		$opts = array ('http' => array (
							'method'  => 'POST',
							'header'  => 'Content-type: application/json',
							'content' => $request
							));
		$context  = stream_context_create($opts);
		if ($fp = fopen($this->url, 'r', false, $context)) {
			$response = '';
			while($row = fgets($fp)) {
				$response.= trim($row)."\n";
			}
			$this->debug && $this->debug.='***** Server response *****'."\n".$response.'***** End of server response *****'."\n";
			$response = json_decode($response,true);
		} else {
			throw new Exception('Unable to connect to '.$this->url);
		}
		if ($this->debug) {
			echo nl2br($debug);
		}
		if (!$this->notification) {
			if ($response['id'] != $currentId) {
				throw new Exception('Incorrect response id (request id: '.$currentId.', response id: '.$response['id'].')');
			}
			if (!is_null($response['error'])) {
				throw new Exception('Request error: '.$response['error']);
			}
			return $response['result'];
		} else {
			return true;
		}
	}
}
?>