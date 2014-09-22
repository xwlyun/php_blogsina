<?php
include_once('../inc/global.php');

$url = isset($_POST['url'])?$_POST['url']:'';

$return = array(
	'url'		=>	$url,
	'content'	=>	'',
);

if($url){
	$html = @file_get_contents($url);
	$preg = '/共(.*)页/iUs';
	$arr = matchPreg($html,$preg);
	$total_page = intval($arr[1][0]);
	if($total_page){
		$url_str = str_replace('1.html','{0}.html',$url);
		for($i=1;$i<=$total_page;$i++){
			$return['content'][] = strFormat($url_str,$i);
		}
	}else{
		$return['content'][] = $url;
	}
}

echo json_encode($return);