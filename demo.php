<?php
	require('askmona.php');

	use Askmona\askmona;

	$topicslist = Askmona::topics(10);
	for($i=0;$i<10;$i++) printf($topicslist->topics[$i]->title."\n");

	$reslist = Askmona::res(1,1,10);
	for($i=0;$i<10;$i++) printf($reslist->responses[$i]->response."\n");

	echo Askmona::user(1)->u_name;
?>
