<?php
	$para=$_GET;
	//print_r($para);
	
	// 用户限制
	if($para['username'] && $para['username']!="管理员"){
		$userWhere="and u.username like '%{$para['username']}%'";
	}

	// 日志类型限制
	if($para['type']){
		$typeWhere="and l.type={$para['type']}";
	}

	// 时间限制
	if($_REQUEST['fromTime'] && $_REQUEST['toTime']){
		$fromTime=strtotime($_REQUEST['fromTime']);
		$toTime=strtotime($_REQUEST['toTime'])+24*3600;
		$timeWhere="and l.actionTime between $fromTime and $toTime";
	}elseif($_REQUEST['fromTime']){
		$fromTime=strtotime($_REQUEST['fromTime']);
		$timeWhere="and l.actionTime>=$fromTime";
	}elseif($_REQUEST['toTime']){
		$toTime=strtotime($_REQUEST['toTime'])+24*3600;
		$timeWhere="and l.actionTime<$fromTime";
	}else{
		$timeWhere=' and l.actionTime>'.strtotime('00:00');
	}

	$sql="select l.*, u.username from {$this->prename}admin_log l, {$this->prename}members u where l.uid=u.uid $timeWhere $typeWhere $userWhere order by l.id desc";
	$data=$this->getPage($sql, $this->page, $this->pageSize);
?>
	<table class="tablesorter" cellspacing="0">
	<thead>
		<tr>
			<th>时间</th>
			<th>管理员</th>
			<th>操作类型</th>
			<th>登录IP</th>
			<th>操作描述</th>
			<th>对应ID</th>
			<th>操作对象</th>
		</tr>
	</thead>
	<tbody>
	<?php if($data['data']) foreach($data['data'] as $var){	?>
		<tr>
			<td><?=date('m-d H:i:s', $var['actionTime'])?></td>
			<td><?=$var['username']?></td>
			<td><?=$this->adminLogType[$var['type']]?></td>
			<td><?=long2ip($var['actionIP'])?></td>
			<td><?=$this->ifs($var['action'], '--')?></td>
			<td><?=$this->ifs($var['extfield0'], '--')?></td>			
			<td><?=$this->ifs($var['extfield1'], '--')?></td>			
		</tr>
	<?php }else{ ?>
		<tr>
			<td colspan="10">暂时没有Log</td>
		</tr>
	<?php } ?>
	</tbody>
	</table>
	<footer>
	<?php
		$rel=get_class($this).'/controlLog-{page}?'.http_build_query($_GET,'','&');
		$this->display('inc/page.php', 0, $data['total'], $rel, 'betLogSearchPageAction');
	?>
	</footer>