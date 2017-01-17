<?php
	$this->getTypes();
	$this->getPlayeds();

	
	// 帐号限制
	if($_REQUEST['username']){
		$userWhere="and b.username like '%{$_REQUEST['username']}%'";
	}
	
	//期号
	if($_REQUEST['actionNo']){
		$actionNoWhere=" and b.actionNo='{$_REQUEST['actionNo']}'";
	}

	// 彩种限制
	if($_REQUEST['type']){
		$typeWhere=" and b.type={$_REQUEST['type']}";
	}
	// 下注来源限制
	if($_REQUEST['betType']!=''){
		$betTypeWhere=" and b.betType={$_REQUEST['betType']}";
	}

	// 时间限制
	if($_REQUEST['fromTime'] && $_REQUEST['toTime']){
		$fromTime=strtotime($_REQUEST['fromTime']);
		$toTime=strtotime($_REQUEST['toTime'])+24*3600;
		$timeWhere="and b.actionTime between $fromTime and $toTime";
	}elseif($_REQUEST['fromTime']){
		$fromTime=strtotime($_REQUEST['fromTime']);
		$timeWhere="and b.actionTime>=$fromTime";
	}elseif($_REQUEST['toTime']){
		$toTime=strtotime($_REQUEST['toTime'])+24*3600;
		$timeWhere="and b.actionTime<$fromTime";
	}else{
		$timeWhere=' and b.actionTime>'.strtotime('00:00');;
	}

	
	$sql="select * from {$this->prename}bets b where 1 $timeWhere $actionNoWhere $typeWhere $betTypeWhere $userWhere order by b.id desc";
	if($_REQUEST['id']) $sql="select * from {$this->prename}bets b where b.id={$_REQUEST['id']}";
	$data=$this->getPage($sql, $this->page, $this->pageSize);
	
	$mname=array(
		'2.00'=>'元',
		'0.20'=>'角',
		'0.02'=>'分'
	);
?>
<article class="module width_full">
	<header>
		<h3 class="tabs_involved">普通投注
			<div class="submit_link wz">
			<form action="/wjadmin.php/business/betLog" target="ajax" call="defaultSearch" dataType="html">
				期号<input type="text" class="alt_btn" name="actionNo" style="width:70px;" value="<?=$_REQUEST['actionNo']?>"/>
				单号<input type="text" class="alt_btn" name="id" style="width:70px;"/>&nbsp;&nbsp;
				会员<input type="text" class="alt_btn" name="username" style="width:70px;"/>&nbsp;&nbsp;
				时间从 <input type="date" class="alt_btn" name="fromTime"/> 到 <input type="date" name="toTime" class="alt_btn"/>&nbsp;&nbsp;
				<select style="width:90px;" name="type">
					<option value="">全部彩种</option>
				<?php if($this->types) foreach($this->types as $var){
					if($var['enable'] && !$var['isDelete']){
				?>
					<option value="<?=$var['id']?>" title="<?=$var['title']?>"><?=$this->ifs($var['shortName'], $var['title'])?></option>
				<?php }} ?>
				</select>&nbsp;&nbsp;
                <select style="width:74px;" name="betType">
					<option value="">全部来源</option>
					<option value="0" title="web">web</option>
					<option value="1" title="web">手机</option>
				</select>&nbsp;&nbsp;
				<input type="submit" value="查找" class="alt_btn">
				<input type="reset" value="重置条件">
			</form>
			</div>
		</h3>
	</header>
	<table class="tablesorter" cellspacing="0">
		<thead>
			<tr>
				<th>单号</th>
				<th>用户名</th>
				<th>投注时间</th>
				<th>彩种</th>
				<th>玩法</th>
				<th>期号</th>
				<th>倍数</th>
				<th>模式</th>
				<th>投注号码</th>
				<th>投注金额</th>
				<th>中奖金额</th>
				<th>返点</th>
				<th>抽水</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
		<?php if($data['data']) foreach($data['data'] as $var){ ?>
			<tr>
				<td><a href="/wjadmin.php/business/betInfo/<?=$var['id']?>" button="取消:defaultCloseModal" title="投注信息" width="510" target="modal"><?=$var['wjorderId']?></a></td>
				<td><?=$var['username']?></td>
				<td><?=date('m-d H:i:s', $var['actionTime'])?></td>
				<td><?=$this->ifs($this->types[$var['type']]['shortName'],$this->types[$var['type']]['title'])?></td>
				<td><?=$this->playeds[$var['playedId']]['name']?></td>
				<td><?=$var['actionNo']?></td>
				<td><?=$var['beiShu']?></td>
				<td><?=$mname[$var['mode']]?></td>
				<td data-code="<?=$var['actionData']?>"><?=$this->CsubStr($var['actionData'],0,10)?></td>
				<td><?=number_format($var['mode'] * $var['beiShu'] * $var['actionNum'], 2)?></td>
				<td>
				<?php 
				if($var['isDelete']==1){
					echo '已撤单';
				}else{
					if($var['lotteryNo']){
						echo number_format($var['zjCount'] * $var['bonusProp'] * $var['beiShu'] * $var['mode']/2, 2);
					}else{
						echo '未开奖';
					}
				}
				?>
                </td>
				<td><?=number_format($var['mode'] * $var['beiShu'] * $var['actionNum'] * $var['fanDian']/100, 2)?></td>
				<td><?=$var['fanDianAmount']?></td>
				<td id="dltcd"><?/*php if($var['betType']==0){echo 'web';}else if($var['betType']==1){echo '手机';}else if($var['betType']==2){echo 'PC';}*/?>
				<?php if($var['isDelete']==0 && !$var['lotteryNo']){ ?>
				<a href="/wjadmin.php/business/betInfoUpdate/<?=$var['id']?>" button="修改:dataAddCode|取消:defaultCloseModal" title="投注信息" width="510" target="modal">修改</a>
				<a href="/wjadmin.php/Business/deleteCode/<?=$var['id']?>" target="ajax" dataType="json"  call="deleteCode">撤单</a>
				 <?php }else{ ?>
				<a>--</a>
				<?php }?>
				</td>
				<tr>	
		<?php } ?>
		</tbody>
	</table>
	<footer>
	<?php
		$rel=get_class($this).'/betLog-{page}?'.http_build_query($_GET,'','&');
		$this->display('inc/page.php', 0, $data['total'], $rel, 'betLogSearchPageAction'); 
	?>
	</footer>
</article>