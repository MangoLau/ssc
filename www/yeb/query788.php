<html>
<head>
<title>������ѯ</title>
</head>
<body>
<div align="center"><h3><b>������ѯ</b></h3></div>
<br>
<?php
include '../ldconfig.php';
header("content-Type: text/html; charset=gb2132");
$conn = mysql_connect($hostname, $username, $password);
mysql_select_db($dbname, $conn);
$sql = "select * from ssc_order order by id desc";
$query = mysql_query($sql,$conn);
?>
<div align="center">
<table width=50%>
<tr height="20"  align="center">
<td width=5%>id</td>
<td width=20%>������</td>
<td width=15%>�û���</td>
<td width=15%>��ֵ���</td>
<td width=15%>����״̬</td>
<td width=30%>����ʱ��</td>
</tr></div>
<?php
while($row=mysql_fetch_assoc($query))
{
?>
<tr align="center">
<td width=5%><?=$row['id']?></td>
<td width=20%><?=$row['order_number']?></td>
<td width=15%><?=$row['username']?></td>
<td width=15%><?=$row['recharge_amount']?></td>
<td width=15%><? if($row['state']==0) echo "δ֧��"; else echo "֧��";?></td>
<td width=30%><?=$row['time']?></td>
</tr>
<?php
}
mysql_close($conn);
?>

</table>
</body>
</html>