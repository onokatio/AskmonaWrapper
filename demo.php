<?php
	require('Askmona.php');
	use Askmona\Askmona;

	foreach(Askmona::topics(3)->topics as $topic) echo($topic->title."\n");

	foreach(Askmona::res(1,1,3)->responses as $response) echo($response->response."\n");

	echo(Askmona::user(1)->u_name);
?>
