<?php
set_time_limit(0);
$xiehouyu = trim($_GET['q']);
$id = $_GET['id'];

$r_num = 0; //�������
$lan = 1;
$pf = "";
$pf_l = "";

if($xiehouyu!=""){
	$dreamdb=file("data/myan.dat");//��ȡ�����ļ�
	$count=count($dreamdb);//��������

	for($i=0; $i<$count; $i++) {
		$keyword=explode(" ",$xiehouyu);//��ֹؼ���
		$dreamcount=count($keyword);//�ؼ��ָ���
		$detail=explode("\t",$dreamdb[$i]);
		for ($ai=0; $ai<$dreamcount; $ai++) {
			@eval("\$found = eregi(\"$keyword[$ai]\",\"$detail[0]\");");
			if(($found)){
				if(fmod($r_num,2)==0) $fcolor=' bgcolor="#f6f6f6"'; else $fcolor='';
				$pf_l .= '<tr'.$fcolor.'><td><a href="'.($i+1).'.html">'.substr($detail[1],0,78).'��[��ϸ]</a></td><td width="100"><input type="button" value=" ���ٲ鿴 " onclick="javascript:window.alert(\''.$detail[0].'\n\n���� '.trim($detail[1],"\n\r").'\');" /></td></tr>';
				$r_num++;
				break;
			}
		}
	}
	$pf_l = '<table width="750" cellpadding="2" cellspacing="0" style="border:1px solid #B2D0EA;"><tr><td style="background:#EDF7FF;padding:0 5px;color:#014198;" height="26" valign="middle" colspan="5"><b><font class=s10><a href="./">��������</a>���ҵ� <a href="./?q='.urlencode($xiehouyu).'"><font color="#c60a00">'.$xiehouyu.'</font></a> ���������'.$r_num.'��</font></b></td></tr><tr><td><table id="cont" cellpadding="0" cellspacing="0" width="98%" align="center">'.$pf_l.'</table></td></tr></table>';
}elseif($id>0){
	$dreamdb=file("data/myan.dat");//��ȡ�����ļ�
	$count=count($dreamdb);//��������

	$detail=explode("\t",$dreamdb[$id-1]);
	$pf = '<table width="750" cellpadding=2 cellspacing=0 style="border:1px solid #B2D0EA;"><tr><td style="background:#EDF7FF;padding:0 5px;color:#014198;" height="26" valign="middle"><b><font class=s10><a href="./">��������</a>��'.$detail[0].'</font></b></td><td style="background:#EDF7FF;padding:0 5px;color:#014198;" align="right">';
	if($id>1 && $id<=$count) $pf .= '<a href="'.($id-1).'.html">��һ��</a> ';
	$pf .= '<a href="./">�鿴ȫ��</a>';
	if($id>=1 && $id<$count) $pf .= ' <a href="'.($id+1).'.html">��һ��</a>';
	$pf .= '</td></tr><tr><td colspan="2" align="center"><br><table border="0" width="90%" style="font-size:14px;line-height:150%"><tr><td width="80">�����ˡ�</td><td>'.$detail[0].'</td></tr><tr><td>�����ԡ�</td><td>'.$detail[1].'</td></tr></table><br></td></tr></table><br />';
}
if($xiehouyu=="" || $id){
	$dreamdb=file("data/myan.dat");//��ȡ�����ļ�
	$count=count($dreamdb);//��������
	$pfl = rand(0,intval($count/60));

	for($i=$pfl*60; $i<$pfl*60+60; $i++) {
		if($i>=$count-1) break;
		$detail2=explode("\t",$dreamdb[$i]);
		if(fmod($r_num,2)==0) $fcolor=' bgcolor="#f6f6f6"'; else $fcolor='';
		$pf_l .= '<tr'.$fcolor.'><td>��<a href="'.($i+1).'.html">'.substr($detail2[1],0,78).'��[��ϸ]</a></td><td width="100"><input type="button" value=" ����˭˵�� " onclick="javascript:window.alert(\''.$detail2[0].'\n\n���� '.trim($detail2[1],"\n\r").'\');" /></td></tr>';
		$r_num++;
	}
	$pf_l = '<table width="750" cellpadding="2" cellspacing="0" style="border:1px solid #B2D0EA;"><tr><td style="background:#EDF7FF;padding:0 5px;color:#014198;" height="26" valign="middle" colspan="5"><b><font class=s10>����Ƽ���������'.$r_num.'��</font></b></td></tr><tr><td><br><table id="cont" cellpadding="0" cellspacing="0" width="96%" align="center">'.$pf_l.'</table><br></td></tr></table>';
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<?
if($xiehouyu){
	echo "<title>".$xiehouyu." - ʵ�ù��ߣ��������Դ�ȫ</title>";
	echo '<meta name="keywords" content="'.$xiehouyu.',Ъ����,Ъ�����ȫ,վ������,��ѯ����,ת������,ʵ�ù���" />';
}elseif($id>0 && $id<=$count){
	echo "<title>".$detail[0]." - ʵ�ù��ߣ��������Դ�ȫ</title>";
	echo '<meta name="keywords" content="'.$detail[0].',��������,�������Դ�ȫ,������������,����,����,������,����,����,����,վ������,��ѯ����,ת������,ʵ�ù���" />';
	echo '<meta name="description" content="���ˣ���Դ����'.$detail[0].' -- �������䣺'.trim($detail[1],"\n\r").'����������,�������Դ�ȫ,������������,����,����,������,����,����,����,վ������,��ѯ����,ת������,ʵ�ù���" />';
}else{
	echo "<title>ʵ�ù��ߣ��������Դ�ȫ</title>";
	echo '<meta name="keywords" content="��������,�������Դ�ȫ,������������,����,����,������,����,����,����,վ������,��ѯ����,ת������,ʵ�ù���" />';
	echo '<meta name="description" content="��������ָ������˵�Ļ����㷺����˵�ǱȽ������Ļ���������Ļ���������˵��������Եȶ����Խ��������ԡ�" />';
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
<table width="750" cellpadding="2" cellspacing="0" style="border:1px solid #B2D0EA;" id="top"><tr><td style="background:#EDF7FF;padding:0 5px;color:#014198;" height="26" valign="middle" colspan="5"><b><font class=s10>������������</font></b></td></tr><tr><td align="center" valign="middle" height="60"><form action="./" method="get" name="f1">�����������ԣ�<input name="q" id="q" type="text" size="18" delay="0" value="" style="width:200px;height:22px;font-size:16px;font-family: Geneva, Arial, Helvetica, sans-serif;" /> <input type="submit" value=" ���� " /></form></td></tr></table><br />
<?
if($xiehouyu!=""){
	echo $pf_l;
}elseif($id>0 && $id<=$count){
	echo $pf.$pf_l;
}else{
?>
<table width="750" cellpadding="2" cellspacing="0" style="border:1px solid #B2D0EA;"><tr><td style="background:#EDF7FF;padding:0 5px;color:#014198;" height="26" valign="middle" colspan="5"><b><font class=s10>���������ԡ�˵��</font></b></td></tr><tr><td><p style="line-height:150%;font-size:12px;">������������ָ������˵�Ļ����㷺����˵�ǱȽ������Ļ���������Ļ���������˵��������Եȶ����Խ��������ԡ���ϵͳ���� 25918 �������������䣬֧��ģ����ѯ��<br />�������磺<a href="?q=<? echo urlencode("ë��");  ?>">ë��</a> <a href="?q=<? echo urlencode("���˼");  ?>">���˼</a> <a href="?q=<? echo urlencode("����");  ?>">����</a> <a href="?q=<? echo urlencode("ɯʿ����");  ?>">ɯʿ����</a> <a href="?q=<? echo urlencode("ʥ��");  ?>">ʥ��</a></p></td></tr></table><br>
<?
	echo $pf_l;
}
?>
</div>
<br>

<div id="footer"></div>

</body>
</html>