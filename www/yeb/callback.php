<?php

include '../ldconfig.php';
include 'yeepayCommon.php';

$return = getCallBackValue($r0_Cmd,$r1_Code,$r2_TrxId,$r3_Amt,$r4_Cur,$r5_Pid,$r6_Order,$r7_Uid,$r8_MP,$r9_BType,$hmac);
$bRet = CheckHmac($r0_Cmd,$r1_Code,$r2_TrxId,$r3_Amt,$r4_Cur,$r5_Pid,$r6_Order,$r7_Uid,$r8_MP,$r9_BType,$hmac);

$conn = mysql_connect($hostname,$username,$password);
if (!$conn)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($dbname,$conn);

$chaxun = mysql_query("SELECT state FROM ssc_order WHERE order_number = '".$r6_Order."'");
$update1 = "UPDATE ssc_order SET state = 1 WHERE order_number = '".$r6_Order."'";
$update2 = "UPDATE ssc_members SET coin = coin+'".$r3_Amt."' WHERE username = '".$r8_MP."'";
$update3 = "UPDATE ssc_member_recharge SET state = 9, rechargeAmount = '".$r3_Amt."' rechargeTime = '".$ru_Trxtime."' WHERE rechargeId = '".$r6_Order."'";

$jiancha = mysql_result($chaxun,0);

if($jiancha==0){
    if($bRet){
	   if($r1_Code==1){
                mysql_query($update1,$conn);
                mysql_query($update2,$conn);
                mysql_query($update3,$conn);
                echo "���ѳɹ���ֵ�������µ�½��ˢ�²鿴,лл!";
	    }else{
	       echo "������Ϣ���۸�";
        }
    }
}else{
    echo "���ѳ�ֵ�����𷴸�ˢ��,лл!";
}
mysql_close($conn);
?>
