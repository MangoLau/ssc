<?php
	//$no=$this->getGameNo($this->type);
	
	if(!$this->types) $this->getTypes();
	if(!$this->playeds) $this->getPlayeds();
	$modes=array(
		'0.02'=>'分',
		'0.20'=>'角',
		'2.00'=>'元'
	);
	
	//$actionNo=$this->getGameNo($this->type);
	//$fromTime=strtotime(date('Y-m-d',strtotime("-1 day")).' 03:00:00');
	//$toTime=strtotime(date('Y-m-d',time()).' 03:00:00'); and actionTime between {$fromTime} and {$toTime} 
	//$sql="select * from {$this->prename}bets where kjTime>{$this->time} and isDelete=0 and uid={$this->user['uid']} order by actionTime desc";
	$sql="select * from {$this->prename}bets where  isDelete=0 and uid={$this->user['uid']} order by id desc limit 5";
	if($list=$this->getRows($sql, $actionNo['actionNo'])){
	foreach($list as $var){
?>
	<ul data-code="<?=json_encode($var)?>">
		<li class="t1"><a href="/index.php/record/betInfo/<?=$var['id']?>" width="800" title="投注信息" button="关闭:defaultModalCloase" target="modal"><?=$var['wjorderId']?></a></li>
		<li class="t2"><?=date('H:i:s', $var['actionTime'])?></li>
		<li class="t3"><?=$this->types[$var['type']]['shortName']?></li>
		<li class="t4"><?=$this->playeds[$var['playedId']]['name'].$this->iff($var['fpEnable'], ' 飞盘', '')?></li>
		<li class="t5"><?=$var['actionNo']?></li>
		<li class="t6"><?=Object::CsubStr($var['actionData'],0,10)?></li>
		<li class="t7"><?=$var['beiShu']?>倍</li>
		<li class="t8"><?=$var['beiShu']*$var['mode']*$var['actionNum']*(intval($this->iff($var['fpEnable'], '2', '1')))?></li>
        <li class="t9"><?=$modes[$var['mode']]?></li>
		<li class="t10"><?=$this->iff($var['lotteryNo'], number_format($var['bonus'], 2), '0.00')?></li>
		<li class="t11">
		<?php if($var['lotteryNo'] || $var['isDelete']==1 || $var['kjTime']<$this->time || $var['qz_uid']){ ?>
            --
        <?php }else{ ?>
            <a target="ajax" call="gameFreshOrdered"  onajax="confirmCancel" dataType="json" href="/index.php/game/deleteCode/<?=$var['id']?>">撤单</a>
        <?php } ?>
        </li>
	</ul>
<div class="clear"></div>
<?php } }else{ ?>
<li colspan="12" height="10">暂无投注数据</li>
<?php } 

?>