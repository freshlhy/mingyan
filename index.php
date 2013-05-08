<?php
set_time_limit(0);
$xiehouyu = trim($_GET['q']);
$id = $_GET['id'];

$r_num = 0; //结果个数
$lan = 1;
$pf = "";
$pf_l = "";

if($xiehouyu!=""){
	$dreamdb=file("data/myan.dat");//读取名言文件
	$count=count($dreamdb);//计算行数

	for($i=0; $i<$count; $i++) {
		$keyword=explode(" ",$xiehouyu);//拆分关键字
		$dreamcount=count($keyword);//关键字个数
		$detail=explode("\t",$dreamdb[$i]);
		for ($ai=0; $ai<$dreamcount; $ai++) {
			@eval("\$found = eregi(\"$keyword[$ai]\",\"$detail[0]\");");
			if(($found)){
				if(fmod($r_num,2)==0) $fcolor=' bgcolor="#f6f6f6"'; else $fcolor='';
				$pf_l .= '<tr'.$fcolor.'><td><a href="'.($i+1).'.html">'.substr($detail[1],0,78).'…[详细]</a></td><td width="100"><input type="button" value=" 快速查看 " onclick="javascript:window.alert(\''.$detail[0].'\n\n—— '.trim($detail[1],"\n\r").'\');" /></td></tr>';
				$r_num++;
				break;
			}
		}
	}
	$pf_l = '<table width="750" cellpadding="2" cellspacing="0" style="border:1px solid #B2D0EA;"><tr><td style="background:#EDF7FF;padding:0 5px;color:#014198;" height="26" valign="middle" colspan="5"><b><font class=s10><a href="./">名人名言</a>：找到 <a href="./?q='.urlencode($xiehouyu).'"><font color="#c60a00">'.$xiehouyu.'</font></a> 的相关名言'.$r_num.'条</font></b></td></tr><tr><td><table id="cont" cellpadding="0" cellspacing="0" width="98%" align="center">'.$pf_l.'</table></td></tr></table>';
}elseif($id>0){
	$dreamdb=file("data/myan.dat");//读取名言文件
	$count=count($dreamdb);//计算行数

	$detail=explode("\t",$dreamdb[$id-1]);
	$pf = '<table width="750" cellpadding=2 cellspacing=0 style="border:1px solid #B2D0EA;"><tr><td style="background:#EDF7FF;padding:0 5px;color:#014198;" height="26" valign="middle"><b><font class=s10><a href="./">名人名言</a>：'.$detail[0].'</font></b></td><td style="background:#EDF7FF;padding:0 5px;color:#014198;" align="right">';
	if($id>1 && $id<=$count) $pf .= '<a href="'.($id-1).'.html">上一个</a> ';
	$pf .= '<a href="./">查看全部</a>';
	if($id>=1 && $id<$count) $pf .= ' <a href="'.($id+1).'.html">下一个</a>';
	$pf .= '</td></tr><tr><td colspan="2" align="center"><br><table border="0" width="90%" style="font-size:14px;line-height:150%"><tr><td width="80">【名人】</td><td>'.$detail[0].'</td></tr><tr><td>【名言】</td><td>'.$detail[1].'</td></tr></table><br></td></tr></table><br />';
}
if($xiehouyu=="" || $id){
	$dreamdb=file("data/myan.dat");//读取名言文件
	$count=count($dreamdb);//计算行数
	$pfl = rand(0,intval($count/60));

	for($i=$pfl*60; $i<$pfl*60+60; $i++) {
		if($i>=$count-1) break;
		$detail2=explode("\t",$dreamdb[$i]);
		if(fmod($r_num,2)==0) $fcolor=' bgcolor="#f6f6f6"'; else $fcolor='';
		$pf_l .= '<tr'.$fcolor.'><td>·<a href="'.($i+1).'.html">'.substr($detail2[1],0,78).'…[详细]</a></td><td width="100"><input type="button" value=" 看看谁说的 " onclick="javascript:window.alert(\''.$detail2[0].'\n\n—— '.trim($detail2[1],"\n\r").'\');" /></td></tr>';
		$r_num++;
	}
	$pf_l = '<table width="750" cellpadding="2" cellspacing="0" style="border:1px solid #B2D0EA;"><tr><td style="background:#EDF7FF;padding:0 5px;color:#014198;" height="26" valign="middle" colspan="5"><b><font class=s10>随机推荐名人名言'.$r_num.'条</font></b></td></tr><tr><td><br><table id="cont" cellpadding="0" cellspacing="0" width="96%" align="center">'.$pf_l.'</table><br></td></tr></table>';
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<?
if($xiehouyu){
	echo "<title>".$xiehouyu." - 实用工具：名人名言大全</title>";
	echo '<meta name="keywords" content="'.$xiehouyu.',歇后语,歇后语大全,站长工具,查询工具,转换工具,实用工具" />';
}elseif($id>0 && $id<=$count){
	echo "<title>".$detail[0]." - 实用工具：名人名言大全</title>";
	echo '<meta name="keywords" content="'.$detail[0].',名人名言,名人名言大全,名人名言名句,名人,名言,座右铭,名句,谚语,格言,站长工具,查询工具,转换工具,实用工具" />';
	echo '<meta name="description" content="名人（来源）：'.$detail[0].' -- 名言名句：'.trim($detail[1],"\n\r").'。名人名言,名人名言大全,名人名言名句,名人,名言,座右铭,名句,谚语,格言,站长工具,查询工具,转换工具,实用工具" />';
}else{
	echo "<title>实用工具：名人名言大全</title>";
	echo '<meta name="keywords" content="名人名言,名人名言大全,名人名言名句,名人,名言,座右铭,名句,谚语,格言,站长工具,查询工具,转换工具,实用工具" />';
	echo '<meta name="description" content="名人名言指名人所说的话，广泛上来说是比较有名的话与有意义的话，名人所说的谚语，格言等都可以叫名人名言。" />';
}
?>
<link href="i/common.css" rel="stylesheet" type="text/css" />
</head>

<body topmargin=0 leftmargin=0><center>


<br>
<style type="text/css">
h3{font-size:18px;padding:10px 0 0 10px;color:#014198;}
p{padding: 10px;font-size:18px}
a.lan,a.lan:visited{color:#999;}
#cont td{height:30px;font-size:12px;padding:0 10px}
#cont a,#cont a:visited{text-decoration:none;}
#cont a:hover{text-decoration:underline;}
</style>
<table width="750" cellpadding="2" cellspacing="0" style="border:1px solid #B2D0EA;" id="top"><tr><td style="background:#EDF7FF;padding:0 5px;color:#014198;" height="26" valign="middle" colspan="5"><b><font class=s10>名人名言搜索</font></b></td></tr><tr><td align="center" valign="middle" height="60"><form action="./" method="get" name="f1">搜索名人名言：<input name="q" id="q" type="text" size="18" delay="0" value="" style="width:200px;height:22px;font-size:16px;font-family: Geneva, Arial, Helvetica, sans-serif;" /> <input type="submit" value=" 搜索 " /></form></td></tr></table><br />
<?
if($xiehouyu!=""){
	echo $pf_l;
}elseif($id>0 && $id<=$count){
	echo $pf.$pf_l;
}else{
?>
<table width="750" cellpadding="2" cellspacing="0" style="border:1px solid #B2D0EA;"><tr><td style="background:#EDF7FF;padding:0 5px;color:#014198;" height="26" valign="middle" colspan="5"><b><font class=s10>“名人名言”说明</font></b></td></tr><tr><td><p style="line-height:150%;font-size:12px;">　　名人名言指名人所说的话，广泛上来说是比较有名的话与有意义的话，名人所说的谚语，格言等都可以叫名人名言。本系统包含 25918 条名人名言名句，支持模糊查询。<br />　　比如：<a href="?q=<? echo urlencode("毛泽东");  ?>">毛泽东</a> <a href="?q=<? echo urlencode("马克思");  ?>">马克思</a> <a href="?q=<? echo urlencode("民谚");  ?>">民谚</a> <a href="?q=<? echo urlencode("莎士比亚");  ?>">莎士比亚</a> <a href="?q=<? echo urlencode("圣经");  ?>">圣经</a></p></td></tr></table><br>
<?
	echo $pf_l;
}
?>
</div>
<br>

<div id="footer"></div>

</body>
</html>