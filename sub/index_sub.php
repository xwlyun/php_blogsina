<?php
include_once('../inc/global.php');

$url = isset($_POST['url'])?$_POST['url']:'';

$return = array(
	'url'		=>	$url,
	'content'	=>	'',
);

if($url){
	$html = @file_get_contents($url);
	$preg = '/<span><a  href=\"(.*)\">博文目录<\/a><\/span>/iUs';
	$arr = matchPreg($html,$preg);
	$return['content'] = $arr[1][0];
}

echo json_encode($return);