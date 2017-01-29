<?php
	require('vendor/autoload.php');
	use onokatio\AskmonaWrapper\Askmona;

	//foreach(Askmona::topics(3)->topics as $topic) echo($topic->title."\n");
	foreach(Askmona::get('topics/list',array('limit'=>3))->topics as $topic) echo($topic->title."\n");
	$array = array(
		't_id'=>1,
		'from'=>3
	);
	foreach(Askmona::get('responses/list',$array)->responses as $response) echo($response->response."\n");

	echo Askmona::get('users/profile',array('u_id'=>1))->u_name;

	$a = new Askmona('UCJn+IU2h2o5JTXfjd5adqgCg8uQHRJOdj9ngfkFOCNc=', 2473, 'A08NRW1v6qTX2zbQnum3EV9EWF0xaexZMJStBskUTmEs=', 2473);
	var_dump($a);
	$array = array(
		't_id'=>3446,
		'text'=>'without id',
		'sage'=>1
	);
	$a->post('responses/post',$array);
?>
