<?php
require('askmona.php');


	$askmona = new Askmona();
	//echo $askmona->res(3442,1)->responses->u_name."\n";
	//echo $askmona->user(1)->u_name."\n";
	for($i=0;$i<10;$i++) printf($askmona->topics(10)->topics[$i]->title."\n");
?>
