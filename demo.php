<?php
require('askmona.php');


	$askmona = new Askmona();
	//echo $askmona->res(3442,1)->responses->u_name."\n";
	//echo $askmona->user(1)->u_name."\n";
	$topicslist = $askmona->topics(10);
	for($i=0;$i<10;$i++) printf($topicslist->topics[$i]->title."\n");
	$topicslist = $askmona->res(1,1);
?>
