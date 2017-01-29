<?php
//				'Content-Type: application/x-www-form-urlencoded',
//			'header' => implode("\r\n",$header),
//		$header = array('Content-Length: '.strlen($post));
/*

 #    #    ##    #####   ######       #####    #   #
 ##  ##   #  #   #    #  #            #    #    # #
 # ## #  #    #  #    #  #####        #####      #
 #    #  ######  #    #  #            #    #     #
 #    #  #    #  #    #  #            #    #     #
 #    #  #    #  #####   ######       #####      #

  ####   #    #   ####   #    #    ##     #####     #     ####
 #    #  ##   #  #    #  #   #    #  #      #       #    #    #
 #    #  # #  #  #    #  ####    #    #     #       #    #    #
 #    #  #  # #  #    #  #  #    ######     #       #    #    #
 #    #  #   ##  #    #  #   #   #    #     #       #    #    #
  ####   #    #   ####   #    #  #    #     #       #     ####

*/
namespace onokatio\AskmonaWrapper;

define('HOSTNAME','https://askmona.org/v1/');
define('DEVKEY','input default developer key here.');
define('DEVID',0);



class Askmona{
	private $token = '';
	private $devkey = DEVKEY;
	private $id = array(
		'u_id' => 0,
		'app_id' => DEVID
	);
	
	public function __construct(string $token, int $u_id, string $devkey = '', int $app_id = 0){
		$this->token = $token;
		$this->id['u_id'] = $u_id;
		empty($devkey) || $this->devkey = $devkey;
		empty($app_id) || $this->id['app_id'] = $app_id;
	}
	
	private function throw_ecp(string $message) {throw new Exception($message);}  //throw ecp as func
	
	public function Auth(){
		$nonce = base64_encode(random_bytes(32));
		$time = time();
		return array(
			'nonce'=>$nonce,
			'time'=>$time,
			'auth_key'=>base64_encode(hash('sha256',$this->devkey.$nonce.$time.$this->token,TRUE))
		);
	}
	
	public function get(string $url, $query){ //send http request
		$query = http_build_query($query);
		$return = file_get_contents(HOSTNAME.$url.'?'.$query);
		$return = json_decode($return);
//		$return->status || self::throw_ecp("error: {$return->error}");
		isset($this) &&  $return->_ = $this;
		return $return;
	}
	
	public function post(string $url, $query){ //send http request
		$query = http_build_query(array_merge($query,$this->Auth(),$this->id));
		$headers = array(
			'Content-Type: application/x-www-form-urlencoded',
		);
		$option = array('http' => array(
			'ignore_errors'=> true,
			'method' => 'POST',
			'header' => 'Content-Length: '.strlen($query),
			'content' => $query,
			'header' => implode("\r\n", $headers),
		));
		$return = file_get_contents(HOSTNAME.$url,false,stream_context_create($option));
		$return = json_decode($return);
//		$return->status || self::throw_ecp("error: {$return->error}");
		isset($this) && $return->_ = $this;
		return $return;
	}
}
?>
