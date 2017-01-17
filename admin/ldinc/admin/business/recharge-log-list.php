<?php
	$para=$_GET;
	
	// 用户限制
	if($para['username'] && $para['username']!="用户名"){
		$userWhere="and u.username like '%{$para['username']}%'";
	}

	// 充值编号限制
	if($para['rechargeId'] && $para['rechargeId']!="充值编号"){
		$rechargeIdWhere="and c.rechargeId={$para['rechargeId']}";
	}

	//状态类型限制
	if($para['type']){
		if($para['type']==99){
			$typeWhere="and c.state=0";
		}else{
			$typeWhere="and c.state={$para['type']}";
		}
	}
	
	// 时间限制
	if($para['fromTime'] && $para['toTime']){
		$fromTime=strtotime($para['fromTime']);
		$toTime=strtotime($para['toTime'])+24*3600;
		$timeWhere="and c.actionTime between $fromTime and $toTime";
	}elseif($para['fromTime']){
		$fromTime=strtotime($para['fromTime']);
		$timeWhere="and c.actionTime>=$fromTime";
	}elseif($para['toTime']){
		$toTime=strtotime($para['toTime'])+24*3600;
		$timeWhere="and c.actionTime<$fromTime";
	}else{
		$timeWhere=' and c.actionTime>'.strtotime('00:00');
	}

	$sql="select c.*, u.username from {$this->prename}member_recharge c, {$this->prename}members u where c.uid=u.uid and c.isDelete=0  $rechargeIdWhere $timeWhere $userWhere $typeWhere order by c.id desc";
	//echo $sql;
	$data=$this->getPage($sql, $this->page, $this->pageSize);
	
	$sql="select b.home, b.name, u.id, u.account, u.username from {$this->prename}member_bank u, {$this->prename}bank_list b where u.bankId=b.id and b.isDelete=0 and u.admin=1";
	$bank=$this->getObject($sql, 'id');
	//print_r($bank);
?>
<table class="tablesorter" cellspacing="0">
<thead>
    <tr>
        <th>UserID</th>
        <th>用户名</th>
        <th>充值金额</th>
        <th>实际到账</th>
        <th>充值前资金</th>
        
        
        <th>充值编号</th>
        <th>充值银行</th>
        
        <th>状态</th>
        <th>备注</th>
        <th>时间</th>
        <th>操作</th>
    </tr>
</thead>
<tbody>
<?php if($data['data']) foreach($data['data'] as $var){ ?>
    <tr>
        <td><?=$var['uid']?></td>
        <td><?=$var['username']?></td>
        <td><?=$var['amount']?></td>
        <td><?=$this->iff($var['rechargeAmount']!=0,$var['rechargeAmount'], $var['amount'])?></td>
        <td><?=$this->iff($var['state'], $var['coin'], '--')?></td>
        
        
        <td><?=$var['rechargeId']?></td>
        <td><a href="<?=$bank[$var['mBankId']]['home']?>" title="银行帐号：<?=$bank[$var['mBankId']]['account']?>，开户名：<?=$bank[$var['mBankId']]['username']?>" target="_blank"><?=$bank[$var['mBankId']]['name']?></a></td>
        
        <td><?=$this->iff($var['state'], '充值成功', '正在充值')?></td>
        <td><?=$var['info']?></td>
        <td><?=date('Y-m-d H:i:s', $var['actionTime'])?></td>
        <td>
            <?php if(!$var['state']){ ?>
            <a href="/wjadmin.php/business/rechargeActionModal/<?=$var['id']?>" target="modal"  width="420" title="编辑用户" modal="true" button="确定:dataAddCode|取消:defaultCloseModal">到帐处理</a>
            <a href="/wjadmin.php/business/rechargeDelete/<?=$var['id']?>" target="ajax" dataType="json" call="defaultAjaxLink">删除</a>
            <?php }else{ ?>
            <a>--</a>
            <?php }?>
            
        </td>
    </tr>
<?php }else{ ?>
    <tr>
        <td colspan="9" align="center">暂时没有充值记录。</td>
    </tr>
<?php } ?>
</tbody>
</table>
<footer>
    <?php
		$rel=get_class($this).'/rechargeLog-{page}?'.http_build_query($_GET,'','&');
		$this->display('inc/page.php', 0, $data['total'], $rel, 'defaultReplacePageAction');
	?>
</footer>