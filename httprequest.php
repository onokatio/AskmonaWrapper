<?php
//				'Content-Type: application/x-www-form-urlencoded',
class Askmona{
	var $arraynum = 0; // 0:make0 1:dont make 0
	
	private function http($url,$post=""){
//		$header = array('Content-Length: '.strlen($post));
		$option = array('http' => array(
			'ignore_errors'=> true,
			'method' => 'POST',
//			'header' => implode("\r\n",$header),
			'header' => 'Content-Length: '.strlen($post),
			'content' => $post,
		));
		$json = file_get_contents($url,false,stream_context_create($option));
		$return = json_decode($json);
		if(!$return->status) throw new Exception("error: {$return->error}");
		return $return;
	}



	function topics($limit=0,$offset=0) {
		if(!$limit) $limit=25;
		$return = $this->http("https://askmona.org/v1/topics/list?limit={$limit}&offset={$offset}");
		if(count($return->topics)===1) $return->topics = $return->topics[0];
		return $return;
	}
	
	function res($t_id, $from, $to=0) {
		if(!$to) $to=$from;
		$return = $this->http("https://askmona.org/v1/responses/list?t_id=${t_id}&from={$from}&to={$to}");
		if(count($return->responses)===1) $return->responses = $return->responses[0];
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


