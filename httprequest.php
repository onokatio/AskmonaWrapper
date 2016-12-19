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
class Askmona{
	public $zero_flags = FALSE; // FALSE:make0 TRUE:dont make 0
	
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
		!$return->status && throw_ecp("error: {$return->error}");
		return $return;
	}


	function topics($limit=0,$offset=0) {
		!$limit && $limit=25;
		$return = $this->http("https://askmona.org/v1/topics/list?limit={$limit}&offset={$offset}");
		$this->zero_flags && count($return->topics)===1 && $return->topics = $return->topics[0];
		return $return;
	}
	
	function res($t_id, $from, $to=0) {
		!$to && $to = $from;
		$return = $this->http("https://askmona.org/v1/responses/list?t_id=${t_id}&from={$from}&to={$to}");
		$this->zero_flags && count($return->responses)===1 && $return->responses = $return->responses[0];
		return $return;
	}
	
	function user($u_id) {
		return $this->http("https://askmona.org/v1/users/profile?u_id={$u_id}");
	}
}


	$askmona = new Askmona();
	echo $askmona->res(3442,1)->responses->u_name."\n";
	echo $askmona->user(1)->u_name."\n";
	echo $askmona->topics(1)->topics->title;
?>


