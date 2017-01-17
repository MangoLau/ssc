<?php

include 'yeepayCommon.php';	

$p2_Order					= $_REQUEST['p2_Order'];

$p3_Amt						= $_REQUEST['p3_Amt'];

$p4_Cur						= "CNY";

$p5_Pid						= '账户充值';

$p6_Pcat					= '订单';

$p7_Pdesc					= '';

$p8_Url						= "http://admin8.blssc.net/yeb/callback.php";	
												
$pa_MP						= $_REQUEST['pa_MP'];
		
$pd_FrpId					= $_REQUEST['issuerId'];

$pr_NeedResponse	= "0";

$hmac = getReqHmacString($p2_Order,$p3_Amt,$p4_Cur,$p5_Pid,$p6_Pcat,$p7_Pdesc,$p8_Url,$pa_MP,$pd_FrpId,$pr_NeedResponse);
     
?> 
<html>
<head>
<title>To YeePay Page</title>
</head>
<body onLoad="document.yeepay.submit();">
<form name='yeepay' action='https://www.yeepay.com/app-merchant-proxy/node' method='post'>
<input type='hidden' name='p0_Cmd'					value='<?php echo $p0_Cmd; ?>'>
<input type='hidden' name='p1_MerId'				        value='<?php echo $p1_MerId; ?>'>
<input type='hidden' name='p2_Order'				        value='<?php echo $p2_Order; ?>'>
<input type='hidden' name='p3_Amt'					value='<?php echo $p3_Amt; ?>'>
<input type='hidden' name='p4_Cur'					value='<?php echo $p4_Cur; ?>'>
<input type='hidden' name='p5_Pid'					value='<?php echo $p5_Pid; ?>'>
<input type='hidden' name='p6_Pcat'					value='<?php echo $p6_Pcat; ?>'>
<input type='hidden' name='p7_Pdesc'				        value='<?php echo $p7_Pdesc; ?>'>
<input type='hidden' name='p8_Url'					value='<?php echo $p8_Url; ?>'>
<input type='hidden' name='p9_SAF'					value='<?php echo $p9_SAF; ?>'>
<input type='hidden' name='pa_MP'				        value='<?php echo $pa_MP; ?>'>
<input type='hidden' name='pd_FrpId'				        value='<?php echo $pd_FrpId; ?>'>
<input type='hidden' name='pr_NeedResponse'	                        value='<?php echo $pr_NeedResponse; ?>'>
<input type='hidden' name='hmac'				        value='<?php echo $hmac; ?>'>
</form>
</body>
</html>