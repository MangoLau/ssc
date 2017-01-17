<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php $this->display('inc_skin.php', 0 , '会员中心 - 申请提现'); ?>
<script type="text/javascript">
function beforeToCash(){
	if(!this.amount.value) throw('请填写提现金额');
	if(!this.amount.value.match(/^[0-9]*[1-9][0-9]*$/)) throw('提现金额错误');
	var amount=parseInt(this.amount.value);
	if($('input[name=bankId]').val()==2||$('input[name=bankId]').val()==3){
		if(amount<parseFloat(<?=json_encode($this->settings['cashMin1'])?>)) throw('支付宝/财付通提现最小限额为<?=$this->settings['cashMin1']?>元');
		if(amount>parseFloat(<?=json_encode($this->settings['cashMax1'])?>)) throw('支付宝/财付通提现最大限额为<?=$this->settings['cashMax1']?>元');
	}else{
		if(amount<parseFloat(<?=json_encode($this->settings['cashMin'])?>)) throw('提现最小限额为<?=$this->settings['cashMin']?>元');
		if(amount>parseFloat(<?=json_encode($this->settings['cashMax'])?>)) throw('提现最大限额为<?=$this->settings['cashMax']?>元');
	}
	if(!this.coinpwd.value) throw('请输入资金密码');
	if(this.coinpwd.value<6) throw('资金密码至少6位');
}

function toCash(err, data){
	if(err){
		alert(err)
	}else{
		$(':password').val('');
		$('input[name=amount]').val('');
		window.location.href="/index.php/cash/toCashResult";
		//alert(data);
		//$.messager.lays(200, 100);
	    //$.messager.anim('fade', 1000);
	    //$.messager.show("<strong>系统提示</strong>", "提款成功！<br />将在10分钟内到账！",0);

	}
}
$(function(){
	$('input[name=amount]').keypress(function(event){
		event.keyCode=event.keyCode||event.charCode;
		
		return !!(
			// 数字键
			(event.keyCode>=48 && event.keyCode<=57)
			|| event.keyCode==13
			|| event.keyCode==8
			|| event.keyCode==46
			|| event.keyCode==9
		)
	});
	
	//var form=$('form')[0];
	//form.account.value='';
	//form.username.value='';
});
</script>
 <?php
	$bank=$this->getRow("select m.*,b.logo logo, b.name bankName from {$this->prename}member_bank m, {$this->prename}bank_list b where m.bankId=b.id and b.isDelete=0 and m.uid=? limit 1", $this->user['uid']);
?>
</head> 
<body id="bg">
<?php $this->display('inc_header.php'); ?>
<div class="content3 wjcont">
 <div class="title"><span>提款申请</span></div>
 <div class="body">
 	<?php if($bank['bankId']){?>
<form action="/index.php/cash/ajaxToCash" method="post" target="ajax" datatype="json" onajax="beforeToCash" call="toCash">
  <div class="chongzhi3">
 	<h2>提款申请：</h2>
    <ul>
     <li><span>银行类型：</span><img src="/<?=$bank['logo']?>" title="<?=$bank['bankName']?>" alt="" /><a href="/index.php/safe/info#bank-info" > 修改我的银行信息>></a></li>
     <li><span>银行账号：</span><input type="text" name="account" readonly value="<?=preg_replace('/^.*(\w{4})$/', '***\1', $bank['account'])?>" class="text4" /></li>
     <li><span>账户名：</span><input type="text" name="username" readonly value="<?=preg_replace('/^(\w).*$/', '\1**', $bank['username'])?>" class="text4" /></li>
     <li><span>提款金额：</span><input type="text" name="amount" class="text4" />*提现请输入<?=$this->settings['cashMin']?>至<?=$this->settings['cashMax']?>的整数金额！</li>
     <li><span>资金密码：</span><input type="password" name="coinpwd" class="text4" /></li>
    </ul>
    <h3><input id="" class="an" type="submit" value="提交申请"  ><input type="reset" id="button" class="an" value="重置" /></h3>
 </div>
 </form>
 <div class="chongzhi2">
 	<h3>提现说明：</h3>
    <ul>
     <li>1、每天最多可以申请<span>2</span>次提现，最大提现金额<span>100000</span>元；</li>
     <li>2、提现10分钟内到账。（如遇高峰期，可能需要延迟到三十分钟内到帐）；</li>
     <li>3、每天提现时间在<span>10:00—00:00</span>；</li>
     <li>4、财付通用户,最小提现<span>100</span>元，最大提现<span>100000</span>元。</li>
    </ul>
 </div>
   		<?php }else{?>
		<div class="chongzhi1">
    	<h2>提款申请：</h2>
         <div class="tips">
        	<dl>
            	<dt>温馨提示：</dt>
                <dd>尚未设置您的银行账户！&nbsp;&nbsp;<a href="/index.php/safe/info">马上设置&gt;&gt;</a></dd>
            </dl>
        </div>
		</div> 
	
    <?php }?>
	<div class="bank"></div>
 </div>
<div class="foot"></div>
</div>
<?php $this->display('inc_footer.php'); ?> 
</body>
</html>
  
   
 