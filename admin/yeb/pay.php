<?php

include '../ldconfig.php';
header("content-Type: text/html; charset=gb2132");

$p2_Order = $_POST['p2_Order'];    //传递过来的订单号，重要,所有订单号必需唯一,绝不可重复
$p3_Amt = $_POST['p3_Amt'];       //传递过来的充值金额,重要
$pa_MP = $_POST['pa_MP'];        //传递过来的用户名，重要

$time = date("Y-m-d H:i:s",time()+28800-date("Z",time()));

$conn = mysql_connect($hostname,$username,$password);
if (!$conn)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db($dbname,$conn);

$info = "INSERT INTO ssc_order(order_number, username, recharge_amount, state, time)
VALUES('".$p2_Order."', '".$pa_MP."', '".$p3_Amt."', '0', '".$time."')";

mysql_query($info);

mysql_close($conn);

?>
<body style="background:#000 url(bg.jpg) no-repeat center center">
<form action="http://www.h56488.com/yeb/pays.php" method="post" name="a32" target="_top" >
<input name="p2_Order" type="hidden" value="<?php echo $p2_Order;?>" />
<input name="p3_Amt" type="hidden" value="<?php echo $p3_Amt;?>" />
<input name="pa_MP" type="hidden" value="<?php echo $pa_MP;?>" />
<div class="flashlogo" style="margin-top:138px;" align="center"><OBJECT codeBase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" height="100" width="270" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">
<PARAM NAME="movie" VALUE="/logo.swf">
<PARAM NAME="quality" VALUE="high">
<param name="wmode" value="transparent" />
<embed wmode="transparent" src="/logo.swf" value="transparent" quality="high" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="270" height="100" ></embed>
</OBJECT></div>

 <table width="482" border="10" style="margin-top:30" align="center" cellpadding="0" bgcolor="#ffffff" cellspacing="0">
  <tr>
    <td>       <div class="heng heng-w">
            <div class="aq-txt"><font color="#666666">&nbsp;1.充值金额：</font>
            <SPAN style="font-size:20px;color:#ff0000;padding-top:6px"><?php echo $p3_Amt;?>元</SPAN>&nbsp;&nbsp;&nbsp; <font color="#666666">2.请选择银行：</font>&nbsp;&nbsp;&nbsp; <font color="#666666">3.确认返回：</font></div>
            <div  ><table  border="0" cellpadding="5" cellspacing="0" bgcolor="#ffffff">
                            <tbody>
                                <tr>
                                    <td height="35" bgcolor="#ffffff">
                                        <input type="radio" name="issuerId" value="ICBC-NET-B2C" class="banking" id="bank_icbc" 
                                            checked="checked" >
                                  <img src="/yeb/bank/bank_icbc.gif" alt="icbc" width="107" height="20">                                    </td>
                                    <td height="35" bgcolor="#ffffff">
                                        <input type="radio" name="issuerId" value="ABC-NET-B2C" class="banking" id="bank_abc" >
                                  <img src="/yeb/bank/bank_abc.gif" alt="abc" width="107" height="20">                                    </td>
                                    <td height="35" bgcolor="#ffffff">
                                        <input type="radio" name="issuerId" value="BOC-NET-B2C" class="banking" id="bank_boc" >
                                  <img src="/yeb/bank/bank_boc.gif" alt="boc" width="107" height="20">                                    </td>
                                </tr>
                                <tr>
                                    <td height="35" bgcolor="#ffffff">
                                        <input type="radio" name="issuerId" value="BOCO-NET-B2C" class="banking" id="bank_comm" >
                                  <img src="/yeb/bank/bank_comm.gif" alt="comm" width="107" height="20">                                    </td>
                                    <td height="35" bgcolor="#ffffff">
                                        <input type="radio" name="issuerId" value="CMBCHINA-NET-B2C" class="banking" id="bank_cmb" >
                                  <img src="/yeb/bank/bank_cmb.gif" alt="cmb" width="107" height="20">                                    </td>
                                    <td height="35" bgcolor="#ffffff">
                                        <input type="radio" name="issuerId" value="SPDB-NET-B2C" class="banking" id="bank_spdb" >
                                  <img src="/yeb/bank/bank_spdb.gif" alt="spdb" width="107" height="20">                                    </td>
                                </tr>
                                <tr>
                                    <td height="35" bgcolor="#ffffff">
                                        <input type="radio" name="issuerId" value="CIB-NET-B2C" class="banking" id="bank_cib" >
                                  <img src="/yeb/bank/bank_cib.gif" alt="cib" width="107" height="20">                                    </td>
                                    <td height="35" bgcolor="#ffffff">
                                        <input type="radio" name="issuerId" value="CEB-NET-B2C" class="banking" id="bank_ceb" >
                                  <img src="/yeb/bank/bank_ceb.gif" alt="ceb" width="107" height="20">                                    </td>
                                  <td height="35" bgcolor="#ffffff"><input type="radio" name="issuerId" value="GDB-NET-B2C" class="banking" id="bank_cgb">
                                  <img src="/yeb/bank/bank_cgb.gif" alt="cgb" width="107" height="20" /> </td>
                                </tr>
                                <tr>
                                  <td height="35" bgcolor="#ffffff"><input type="radio" name="issuerId" value="ECITIC-NET-B2C" class="banking" id="bank_citic">
                                  <img src="/yeb/bank/bank_citic.gif" alt="citic" width="107" height="20" /> </td>
                                  <td height="35" bgcolor="#ffffff"><input type="radio" name="issuerId" value="SHB-NET-B2C" class="banking" id="bank_psbc" />
                                  <img src="/yeb/bank/bank_bos.gif" alt="psbc" width="107" height="20" /></td>
                                  <td height="35" bgcolor="#ffffff"><input type="radio" name="issuerId" value="PAB-NET-0001" class="banking" id="radio" />
                                  <img src="/yeb/bank/bank_pingan.gif" alt="psbc" width="107" height="20" /></td>
                                </tr>
                                <tr>
                                  <td height="35" bgcolor="#ffffff"><input type="radio" name="issuerId" value="BCCB-NET-B2C" class="banking" id="bank_citic">
                                  <img src="/yeb/bank/beijing.gif" alt="citic" width="107" height="21" /> </td>
                                  <td height="35" bgcolor="#ffffff"><input type="radio" name="issuerId" value="NJCB-NET-B2C" class="banking" id="bank_psbc" />
                                  <img src="/yeb/bank/nanjing.gif" alt="psbc" width="95" height="24" /></td>
                                  <td height="35" bgcolor="#ffffff"><input type="radio" name="issuerId" value="CBHB-NET-B2C" class="banking" id="radio" />
                                  <img src="/yeb/bank/bank_bh.gif" alt="psbc" width="107" height="20" /></td>
                                </tr>
                        
                                <tr>
                                  <td height="35" bgcolor="#ffffff"><input type="radio" name="issuerId" value="SDB-NET-B2C" class="banking" id="bank_hxb" />
                                  <img src="/yeb/bank/bank_sdb.gif" alt="hxb" width="121" height="21" /></td>
                                  <td height="35" bgcolor="#ffffff"><input type="radio" name="issuerId" value="POST-NET-B2C" class="banking" id="radio2" />
                                  <img src="/yeb/bank/bank_psbc.gif" alt="psbc" width="107" height="20" /></td>
                                  <td height="35" bgcolor="#ffffff"><input type="radio" name="issuerId" value="HKBEA-NET-B2C" class="banking" id="radio3" />
                                  <img src="/yeb/bank/bank_dy.gif" alt="psbc" width="107" height="20" /></td>
                                </tr>
                                <tr>
                                  <td height="35" bgcolor="#ffffff"><input type="radio" name="issuerId" value="BJRCB-NET" class="banking" id="bank_psbc" />
                                  <img src="/yeb/bank/BJRCB_OUT.gif" alt="psbc" width="100" height="20" /></td>
                                  <td height="35" bgcolor="#ffffff"><input type="radio" name="issuerId" value="CMBC-NET-B2C" class="banking" id="bank_cmbc">
                                  <img src="/yeb/bank/bank_cmbc.gif" alt="cmbc" width="107" height="20" /></td>
                                  <td height="35" bgcolor="#ffffff"><input type="radio" name="issuerId" value="CCB-NET-B2C" class="banking" id="bank_ccb">
                                  <img src="/yeb/bank/bank_ccb.gif" alt="ccb" width="107" height="20" /></td>

                                </tr>
                                <tr>
                                  <td height="35" bgcolor="#ffffff"><a href="htt;//www.baidu.com/" target="_blank"> </a></td>
								  <td height="35" bgcolor="#ffffff"><input name="Inputaa" type="submit" value="马上提交充值" /></td>
                                  <td height="35" bgcolor="#ffffff">&nbsp;</td>
                                </tr>
                            </tbody>
      </table>
            </div>
            
      </div></td>
  </tr>
</table>
</form>