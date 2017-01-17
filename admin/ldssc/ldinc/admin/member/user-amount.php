<?php
	$sql="select u.username, u.coin, u.uid, u.parentId, sum(b.mode * b.beiShu * b.actionNum) betAmount, sum(b.bonus) zjAmount, sum(c.amount) cashAmount, sum(r.amount) rechargeAmount from {$this->prename}members u left join {$this->prename}bets b on u.uid=b.uid  left join {$this->prename}member_cash c on u.uid=c.uid  left join {$this->prename}member_recharge r on r.uid=u.uid  where u.uid=?";
	$var=$this->getRow($sql, $args[0]);

	$var['fanDianAmount']=$this->getValue("select sum(coin) from {$this->prename}coin_log where uid=? and liqType between 2 and 3", $args[0]);
	$var['rechargeAmount']=$this->getValue("select sum(coin) from {$this->prename}coin_log where uid=? and liqType=1", $args[0]);
	$var['cashAmount']=$this->getValue("select sum(abs(fcoin)) from {$this->prename}coin_log where uid=? and liqType=107", $args[0]);
	//print_r($parentData);

?>
<div>
	<table cellpadding="2" cellspacing="2" class="popupModal">
		<tr>
			<td class="title" width="180">用户名：</td>
			<td><input type="text" readonly="readonly" value="<?=$var['username']?>"/></td>
		</tr>
        	<td class="title">投注总额</td>
            <td><input type="text" readonly="readonly" value="<?=$this->ifs($var['betAmount'], '--')?>"/></td>
		</tr>
		<tr>
			<td class="title">中奖总额</td>
			<td><input type="text" readonly="readonly" value="<?=$this->ifs($var['zjAmount'], '--')?>"/></td>
		</tr>
		<tr>
			<td class="title">总返点</td>
			<td><input type="text" readonly="readonly" value="<?=$this->ifs($var['fanDianAmount'], '--')?>"/></td>
		</tr>
		<tr>
			<td class="title">充值</td>
			<td><input type="text" readonly="readonly" value="<?=$this->ifs($var['rechargeAmount'], '--')?>"/></td>
		</tr>
		<tr>
			<td class="title">提现</td>
			<td><input type="text" readonly="readonly" value="<?=$this->ifs($var['cashAmount'], '--')?>"/></td>
		</tr>
		<tr>
			<td class="title">余额</td>
			<td><input type="text" readonly="readonly" value="<?=$this->ifs($var['coin'], '--')?>"/></td>
		</tr>
		<tr>
			<td class="title">个人总结算</td>
			<td><input type="text" readonly="readonly" value="<?=$this->ifs($var['zjAmount']-$var['betAmount']+$var['fanDianAmount'], '--')?>"/></td>
		</tr>
	</table>
</div>