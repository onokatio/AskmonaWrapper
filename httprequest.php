<?php

class Askmona{
	private function http($url,$post=""){
		if($post){
			$header = array(
				'Content-Type: application/x-www-form-urlencoded',
				'Content-Length: '.strlen($post),
			);
			$option = array('http' => array(
				'ignore_errors'=> true,
				'method' => 'POST',
				'header' => implode("\r\n",$header),
				'content' => $post,
			));
			if( ! ( $json = file_get_contents($url,false,stream_context_create($option)))) return 0;
		}else{
			$option = stream_context_create(array('http'=>array('ignore_errors'=>true)));
			if( ! ( $json = file_get_contents($url,false,$option))) return 0;
		}
		return json_decode($json);
	}
	
	function res($t_id, $from, $to=0) {
		if(!$to) $to=$from;
		try{
			$return = $this->http("https://askmona.org/v1/responses/list?t_id=${t_id}&from={$from}&to={$to}&topic_detail=1");
		}catch(Exception $e){
			echo $e;
		}
		if(!$return->status) throw new Exception("error: {$return->error}");
		return $return;
	}
	
	function topics() {
		return $this->http('https://askmona.org/v1/topics/list');
	}
}
	$askmona = new Askmona();
	$test = $askmona->res(3442,1);
	echo $test->responses[0]->u_name;
	$test = $askmona->res(9999,1);
?>
