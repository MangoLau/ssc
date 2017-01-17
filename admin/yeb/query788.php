<html>
<head>
<title>订单查询</title>
</head>
<body>
<div align="center"><h3><b>订单查询</b></h3></div>
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
<td width=20%>订单号</td>
<td width=15%>用户名</td>
<td width=15%>充值金额</td>
<td width=15%>订单状态</td>
<td width=30%>订单时间</td>
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
<td width=15%><? if($row['state']==0) echo "未支付"; else echo "支付";?></td>
<td width=30%><?=$row['time']?></td>
</tr>
<?php
}
mysql_close($conn);
?>

</table>
</body>
</html>