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
namespace Askmona;

class Askmona{
	private $zero_flags = 0; // FALSE:make0 TRUE:dont make 0
	const HOST = "https://askmona.org/v1/";
	
	private $addres = '';
	private $passward = '';
	private $token = '';
	
	private function throw_ecp($message) { //throw exception by function
		throw new Exception($message);
	}
	
	private function http($url,$post=''){ //send http request
		$option = array('http' => array(
			'ignore_errors'=> true,
			'method' => 'POST',
			'header' => 'Content-Length: '.strlen($post),
			'content' => $post,
		));
		$return = json_decode(file_get_contents($url,false,stream_context_create($option)));
		!$return->status && self::throw_ecp("error: {$return->error}");
		return $return;
	}


	public function topics($limit=0,$offset=0) {
		!$limit && $limit=25;
		$return = self::http(self::HOST."topics/list?limit={$limit}&offset={$offset}");
		isset($this) && $this->zero_flags && count($return->topics)===1 && $return->topics = $return->topics[0];
		return $return;
	}
	
	public function res($t_id, $from, $to=0) {
		!$to && $to = $from;
		$return = self::http(self::HOST."responses/list?t_id=${t_id}&from={$from}&to={$to}");
		isset($this) && $this->zero_flags && count($return->responses)===1 && $return->responses = $return->responses[0];
		return $return;
	}
	
	public function user($u_id) {
		return self::http(self::HOST."users/profile?u_id={$u_id}");
	}
}
?>
