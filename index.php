<?php
/**
 * 博客搬家实例
 * @xwl 2014-09-22
 * 使用并发多请求，来模拟多线程
 */
include_once('inc/global.php');
//$blog_home = 'http://blog.sina.com.cn/u/2581004700';	// 测试
$blog_home = 'http://blog.sina.com.cn/blog';	// 新浪官博

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>blogsina</title>
<link href="http://file2.ci123.com/ast/abc/style.css" type="text/css" rel="stylesheet" rev="stylesheet" />
<script type="text/javascript" src="http://file2.ci123.com/ast/js/jquery_172.js"></script>
<script type="text/javascript">
var tr1 = '<tr><td>地址：</td><td><input type="text" size="60" name="$name" value="$value"/></td><td></td></tr>';
var tr2 = '<tr><td>地址：</td><td><a href="list.php?url=$url" target="_blank">$name</a></td><td></td></tr>';
// 获取博文目录
function getIndex(f){
	var url = f.url.value;
	var sub_url = 'sub/index_sub.php?rnd=' + Math.random();
	$.post(sub_url,{url:url},function(data)
	{
		data = eval('('+data+')');
		var result = data.content;
		if(result == null){
			alert('获取博文目录失败');
		}else{
			var html = tr1;
			html = html.replace('$name','url');
			html = html.replace('$value',result);
			$('#step2_frm tbody').html(html);
			$('#step2_frm').css('display','');
		}
	});
	return false;
}
// 获取文章列表页
function getList(f){
	var url = f.url.value;
	var sub_url = 'sub/category_sub.php?rnd=' + Math.random();
	$.post(sub_url,{url:url},function(data)
	{
		data = eval('('+data+')');
		var result = data.content;
		var html = '';
		for(var key in result){
			var row = tr2;
			row = row.replace('$name',result[key]);
			row = row.replace('$url',result[key]);
			var html = html + row;
		}
		$('#step3_frm tbody').html(html);
		$('#step3_frm').css('display','');
	});
	return false;
}
</script>
</head>
<body>
<div class="main">
	<div class="mcontent">

		<form id="step1_frm" action="" method="post" onsubmit="return getIndex(this);">
			<table class="tablist" width="100%" border="0" cellspacing="0" cellpadding="0">
				<thead>
				<tr>
					<td width="100px">新浪博客地址</td>
					<td width="400px"></td>
					<td></td>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td>地址：</td>
					<td><input type="text" size="60" name="url" value="<?php echo $blog_home;?>"/></td>
					<td></td>
				</tr>
				</tbody>
				<tfoot>
				<tr>
					<td colspan="3"><input type="submit" value="获取博文目录"/></td>
				</tr>
				</tfoot>
			</table>
		</form>
		
		<form style="display: none;" id="step2_frm" action="" method="post" onsubmit="return getList(this);">
			<table class="tablist" width="100%" border="0" cellspacing="0" cellpadding="0">
				<thead>
				<tr>
					<td width="100px">文章列表页目录</td>
					<td width="400px"></td>
					<td></td>
				</tr>
				</thead>
				<tbody>

				</tbody>
				<tfoot>
				<tr>
					<td colspan="3"><input type="submit" value="获取博文列表"/></td>
				</tr>
				</tfoot>
			</table>
		</form>

		<form style="display: none;" id="step3_frm" action="" method="post" onsubmit="return false;">
			<table class="tablist" width="100%" border="0" cellspacing="0" cellpadding="0">
				<thead>
				<tr>
					<td width="100px">文章列表页</td>
					<td width="400px"></td>
					<td></td>
				</tr>
				</thead>
				<tbody>

				</tbody>
				<tfoot>
				<tr>
					<td colspan="3"><input type="submit" value="获取博文"/></td>
				</tr>
				</tfoot>
			</table>
		</form>

	</div>
</div>
</body>
</html>