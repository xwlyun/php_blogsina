<?php
include_once('inc/global.php');

$url = isset($_GET['url'])?$_GET['url']:'';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>blogsina_list</title>
<link href="http://file2.ci123.com/ast/abc/style.css" type="text/css" rel="stylesheet" rev="stylesheet" />
<script type="text/javascript" src="http://file2.ci123.com/ast/js/jquery_172.js"></script>
<script type="text/javascript">
var tr1 = '<tr id="$id"><td>文章：</td><td>$name</td><td><input type="text" size="60" name="$key" value="$url"/></td><td></td></tr>';
var arts = new Array();
// 获取文章列表
function getList(f){
	var url = f.url.value;
	var sub_url = 'sub/list_sub.php?rnd=' + Math.random();
	$.post(sub_url,{url:url},function(data)
	{
		data = eval('('+data+')');
		var result = data.content;
		if(result == ''){
			alert('抓取文章列表失败');
		}else{
			var html = '';
			for(var key in result){
				var row = tr1;
				row = row.replace('$name',result[key]['name']);
				row = row.replace('$url',result[key]['url']);
				row = row.replace('$key','url[]');
				row = row.replace('$id',key);
				html = html + row;
				// 追加到数据备用
				arts.push(result[key]['url']);
			}
			$('#step2_frm tbody').html(html);
			$('#step2_frm').css('display','');
		}
	});
	return false;
}
// 获取文章
function getArts(f){
	alert(arts[1]);
	return false;
}
</script>
</head>
<body>

<div class="main">

	<div class="mcontent">

		<form id="step1_frm" action="" method="post" onsubmit="return getList(this);">
			<table class="tablist" width="100%" border="0" cellspacing="0" cellpadding="0">
				<thead>
				<tr>
					<td width="100px">文章列表页</td>
					<td width="400px"></td>
					<td></td>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>地址：</td>
					<td><input type="text" size="60" name="url" value="<?php echo $url;?>"/></td>
					<td></td>
				</tr>
				</tbody>
				<tfoot>
				<tr>
					<td colspan="3"><input type="submit" value="获取博文列表"/></td>
				</tr>
				</tfoot>
			</table>
		</form>

		<form style="display: none;" id="step2_frm" action="" method="post" onsubmit="return getArts(this);">
			<table class="tablist" width="100%" border="0" cellspacing="0" cellpadding="0">
				<thead>
				<tr>
					<td width="100px">文章列表</td>
					<td width="400px"></td>
					<td width="440px"></td>
					<td></td>
				</tr>
				</thead>
				<tbody>

				</tbody>
				<tfoot>
				<tr>
					<td colspan="4"><input type="submit" value="获取本页文章"/></td>
				</tr>
				</tfoot>
			</table>
		</form>

	</div>
</div>

</body>
</html>