<?php
/*
*首页显示订单
*/
	$bet=$this->getRow("select * from {$this->prename}bets where id=?", $args[0]);
	
	if(!$bet) throw new Exception('单号不存在');
	
	$modeName=array('2.00'=>'元', '0.20'=>'角', '0.02'=>'分');
	$weiShu=$bet['weiShu'];
	if($weiShu){
		$w=array(16=>'万', 8=>'千', 4=>'百', 2=>'十',1=>'个');
		foreach($w as $p=>$v){
			if($weiShu & $p) $wei.=$v;
		}
		$wei.=':';
	}
	$betCont=$bet['mode'] * $bet['beiShu'] * $bet['actionNum'] * ($bet['fpEnable']+1);
?>
<div class="popupModal">
	<table cellpadding="0" cellspacing="0" width="100%">
		
		<tr>
			<td width="250"><em>投注用户：</em><span class="red"><?=$this->iff($bet['username']==$this->user['username'], $bet['username'], preg_replace('/^(\w).*(\w{2})$/', '\1***\2', $bet['username']))?></span></td>
			<td width="200"><em>彩种：</em><span class="red"><?=$this->types[$bet['type']]['title']?></span></td>
            <td width="300"><em>玩法：</em><span class="red"><?=$this->playeds[$bet['playedId']]['name']?></span></td>
            <td width="250"><em>注单状态：</em><em>
			<?php
				if($bet['isDelete']==1){
					echo '<font color="#999999">已撤单</font>';
				}elseif(!$bet['lotteryNo']){
					echo '<font color="#009900">未开奖</font>';
				}elseif($bet['zjCount']){
					echo '<font color="red">已派奖</font>';
				}else{
					echo '<font color="#00CC00">未中奖</font>';
				}
			?>
            </em>
            </td>
		</tr>
        <tr>
			<td><em>注单编号：</em><span class="red"><?=$bet['wjorderId']?></span></td>
			<td><em>倍数模式：</em><span class="red"><?=$modeName[$bet['mode']]?></span></td>
            <td><em>动态奖金返点：</em><span class="red"><?=number_format($bet['bonusProp'], 2)?>－<?=number_format($bet['fanDian'],1)?>%</span></td>
            <td><em>开奖号码：</em><span class="red"><?=$this->ifs($bet['lotteryNo'], '－')?></span></td>
		</tr>
        <tr>
			<td><em>投注时间：</em><span class="red"><?=date('m-d H:i:s',$bet['actionTime'])?></span></td>
			<td><em>总金额：</em><span class="red"><?=number_format($betCont, 2)?></span></td>
            <td><em>返点：</em><span class="red"><?=$this->iff($bet['lotteryNo'], number_format(($bet['fanDian']/100)*$betCont, 4). '元', '－')?></span></td>
            <td><em>中奖：</em><span class="red"><?=$this->iff($bet['lotteryNo'], number_format($bet['bonus'], 2) .'元', '－')?></span></td>
		</tr>
         <tr>
			<td colspan="4"><em>个人盈亏：</em><em class="green"><?=$this->iff($bet['lotteryNo'], number_format($bet['bonus'] - $betCont + ($bet['fanDian']/100)*$betCont, 4), '－')?></em> 元</td>
		</tr>
        <tr class="nobd">
			<td colspan="4"><em>投注内容：</em><p class="tzdata"><?=$wei.$bet['actionData']?></p></td>
		</tr>
		
        
	</table>
</div>