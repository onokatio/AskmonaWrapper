<?php
	//require('vendor/autoload.php');
	require('src/onokatio/AskmonaWrapper/Askmona.php'); //ロード
	use onokatio\AskmonaWrapper\Askmona; //namespaceの設定

	//最新のトピック一覧を1つ取得してみる
	echo(Askmona::get('topics/list',array('limit'=>3))->topics[0]->title);

	//こんどはトピックID1の1番めのレスを取得してみる。
	$array = array(
		't_id'=>1,
		'from'=>1
	);
	echo(Askmona::get('responses/list',$array)->responses[0]->response);

	//ユーザーID2473のプロフィールを取得する
	echo Askmona::get('users/profile',array('u_id'=>2473))->u_name;

	//トピックID3446にsage有効で「てすと」と投稿してみる
	//今はダミーのID・キーが入ってるのでエラーが起こるはずです。
/*	$a = new Askmona('UCJn+IU2h2o5JTXfjd5adqgCg8uQHRJOdj9ngfkFOCNc=', 2473, 'A08NRW1v6qTX2zbQnum3EV9EWF0xaexZMJStBskUTmEs=', 2473);
	$array = array(
		't_id'=>3446,
		'text'=>'てすと',
		'sage'=>1
	);
	$a->post('responses/post',$array);*/
?>
