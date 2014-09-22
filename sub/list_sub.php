<?php
include_once('../inc/global.php');

$url = isset($_POST['url'])?$_POST['url']:'';

$return = array(
	'url'		=>	$url,
	'content'	=>	'',
);

if($url){
	$html = @file_get_contents($url);

	$preg = '/<span class=\"atc_title\">(.*)<\/span>/iUs';
	$arr = matchPreg($html,$preg);
	$hrefs = $arr[1];
	foreach($hrefs as $r){
		$href = trim($r);
		$preg = '/href=\"(.*)\"/iUs';
		$arr = matchPreg($href,$preg);
		$url = $arr[1][0];

		$preg = '/title=\"(.*)\"/iUs';
		$arr = matchPreg($href,$preg);
		$name = $arr[1][0];

		$return['content'][] = array(
			'url'	=>	$url,
			'name'	=>	$name,
		);
	}
}

echo json_encode($return);