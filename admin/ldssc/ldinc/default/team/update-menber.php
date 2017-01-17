<?php 
	$sql="select * from {$this->prename}members where uid=?";
	$userData=$this->getRow($sql, $args[0]);
	
	if($userData['parentId']){
		$parentData=$this->getRow("select fanDian, fanDianBdw from {$this->prename}members where uid=?", $userData['parentId']);
	}else{
		$this->getSystemSettings();
		$parentData['fanDian']=$this->settings['fanDianMax'];
		$parentData['fanDianBdw']=$this->settings['fanDianBdwMax'];
	}
	$sonFanDianMax=$this->getRow("select max(fanDian) sonFanDian, max(fanDianBdw) sonFanDianBdw from {$this->prename}members where isDelete=0 and parentId=?",$args[0]);
	//print_r($parentData);
?>
<div>
<form action="/index.php/team/userUpdateed" target="ajax" method="post" call="userDataSubmitCode" onajax="userDataBeforeSubmitCode" dataType="html">
	<input type="hidden" name="type" value="<?=$userData['type']?>"/>
	<input type="hidden" name="uid" value="<?=$args[0]?>"/>

	<table cellpadding="2" cellspacing="2" class="popupModal">
      <?php if($userData['parentId']){ ?>
		<tr>
			<td class="title" width="110">上级关系：</td>
			<td><?=$this->getValue("select username from {$this->prename}members where uid={$userData['parentId']} ")?> > <?=$userData['username']?></td>
		</tr>
        <?php } ?>
		<tr>
			<td class="title">用户名：</td>
			<td><?=$userData['username']?></td>
		</tr>
		
		<tr>
			<td class="title">返点：</td>
			<td><input type="text" name="fanDian" value="<?=$userData['fanDian']?>" max="<?=$parentData['fanDian']?>" min="<?=$sonFanDianMax['sonFanDian']?>" fanDianDiff=<?=$this->settings['fanDianDiff']?> val="<?=$userData['fanDian']?>" >%&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#999"><?=$this->ifs($sonFanDianMax['sonFanDian'],'0')?>—<?=$parentData['fanDian']?>%</span></td>
		</tr>
		<tr>
			<td class="title">不定返点：</td>
			<td><input type="text" name="fanDianBdw" value="<?=$userData['fanDianBdw']?>" max="<?=$parentData['fanDianBdw']?>" min="<?=$sonFanDianMax['sonFanDianBdw']?>" val="<?=$userData['fanDianBdw']?>"/>%&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:#999"><?=$this->ifs($sonFanDianMax['sonFanDianBdw'],'0')?>—<?=$parentData['fanDianBdw']?>%</span></td>
		</tr>
		
      
        <tr>
        	<td class="title">注册时间：</td>
			<td><?=date("Y-m-d",$userData['regTime'])?></td>
        </tr>
        
	</table>
</form>
</div>