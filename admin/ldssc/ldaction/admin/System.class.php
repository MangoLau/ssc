<?php
class System extends AdminBase{
	public $pageSize=15;
	
	// 系统设置相关方法
	public final function settings(){
		$this->display('system/settings.php');
	}
	
	public final function updateSettings(){
		$sql="insert into {$this->prename}params(name, `value`) values";
		$i=0;
		if(!$para=$_POST) throw new Exception('参数出错');
		
		foreach($para as $key=>$var){
			if($var==$this->settings[$key]) continue;
			$i++;
			$sql.="('$key', '$var'),";
		}
		
		if(!$i) throw new Exception('数据没有改变');
		$sql=rtrim($sql,',');
		$sql.=' on duplicate key update `value`=values(`value`)';
		
		if($this->insert($sql)){
			$this->addLog(10,$this->adminLogType[10]);
			return $this->getSystemSettings(0);
		}else{
			throw new Exception('未知错误');
		}
	}

	// 系统公告相关方法
	public final function notice(){
		$this->display('system/notice.php');
	}
	
	public final function addNotice(){
		$this->display('system/notice-add.php');
	}
	public final function doAddNotice(){
		$para=array_merge($_POST, array(
			'addTime'=>$this->time,
			'nodeId'=>1
		));
		if(!$para['title']) throw new Exception('公告标题不能为空');
		if(!$para['content']) throw new Exception('公告内容不能为空');
		
		if($this->insertRow($this->prename .'content', $para)){
			return '添加公告成功';
		}else{
			throw new Exception('未知出错');
		}
	}
	public final function updateNotice($id){
		$this->display('system/notice-update.php',0,$id);
	}
	public final function doUpdateNotice($id){
		$_POST['addTime']=strtotime($_POST['addTime']);
		//throw new Exception($_POST['addTime']);
		//if(!$_POST['enable']) $_POST['enable']=0;
		if(!$_POST['title']) throw new Exception('公告标题不能为空');
		if(!$_POST['content']) throw new Exception('公告内容不能为空');
		if($this->updateRows($this->prename .'content', $_POST, 'id='.$id)){
			return '修改公告成功';
		}else{
			throw new Exception('未知出错');
		}
		
	}
	
	public final function deleteNotice($id){
		if(!$id=intval($id)) throw new Exception('参数出错');
		$sql="delete from {$this->prename}content where id=?";
		if($this->delete($sql, $id)){
			echo '公告已经删除';
		}else{
			throw new Exception('未知出错');
		}
	}
	// 银行信息相关方法
	
	public final function bank(){
		$this->display('system/bank-list.php');
	}
	
	public final function bankModal($id){
		$this->display('system/bank-modal.php',0,$id);
	}
	
	public final function updateBank(){
		$para=$_POST;
		$para['admin']=1;
		$para['uid']=$this->user['uid'];
		//print_r($para);
		//throw new Exception('参数出错');
		// 处理附件
		
		$sql="insert into {$this->prename}member_bank set";
		foreach($para as $field=>$var){
			$sql.=" `$field`='$var',";
		}
		$sql=rtrim($sql,',');
		$sql.=' on duplicate key update bankId=values(bankId), `username`=values(`username`), `account`=values(`account`), rechargeDemo=values(rechargeDemo)';

		if($this->insert($sql, $para)){
			$addbankId=$this->lastInsertId();
			$this->addLog(11,$this->adminLogType[11].'['.$this->iff($para['id'],'修改','添加').'ID:'.$addbankId.']',$addbankId,$para['username']);
			$fun='success';
			$msg='操作成功';
			//echo $msg;
		}else{
			$fun='error';
			$msg='未知错误';
			//echo $msg;
		}
		
		echo '<script type="text/javascript">top.onUpdateCompile("', $fun, '", ', json_encode($msg), ')</script>';
	}
	
	public final function switchBankStatus($id){
		if(!$id=intval($id)) throw new Exception('参数出错');
		$sql="update {$this->prename}member_bank set enable=not enable where id=$id";
		if($this->update($sql)){
			$chikaren=$this->getValue("select username from {$this->prename}member_bank where uid=?", $uid);
			$this->addLog(11,$this->adminLogType[11].'[开关操作ID:'.$id.']',$id,$chikaren);
			echo '操作成功';
		}else{
			throw new Exception('未知错误');
		}
	}
	
	public final function deleteBank($id){
		if(!$id=intval($id)) throw new Exception('参数出错');
		$sql="delete from {$this->prename}member_bank where id=$id";
		if($this->delete($sql)){
			$this->addLog(11,$this->adminLogType[11].'[删除ID:'.$id.']');
			echo '银行已经删除';
		}else{
			throw new Exception('未知错误');
		}
	}
	
	
	// 彩种相关方法
	
	public final function type(){
		$this->display('system/type-list.php');
	}
	
	public final function updateType($id){
		if(!$_POST['enable']) $_POST['enable']=0;
		if(!$_POST['android']) $_POST['android']=0;
		if($this->updateRows($this->prename .'type', $_POST, 'id='.$id)){
			$shortName=$this->getValue("select shortName from {$this->prename}type where id=?", $id);
			$this->addLog(12,$this->adminLogType[12].'['.$shortName.']',$id,$shortName);
			echo '修改彩种成功';
		}else{
			throw new Exception('未知出错');
		}
	}
	
	// 玩法设置
	public final function played($cai=1){
		$this->display('system/played-list.php',0,$cai);
	}
	
	/*修改玩法信息*/
	public final function betPlayedInfoUpdate($id){
		$this->display('system/update-play-info.php', 0, $id);
	}
	
	public final function playedInfoUpdateed(){
		$para=$_POST;
		$playedid=$para['playedid'];
		unset($para['playedid']);
		
		$played=$this->getRow("select * from {$this->prename}played where id={$playedid}");
	    if(!$played) throw new Exception('玩法不存在');

		if($this->updateRows($this->prename .'played', $para, 'id='.$playedid)){
			echo '修改成功';
		}else{
			throw new Exception('未知出错');
		}
		
		
	}
	
	public final function switchPlayedGroupStatus($id){
		$sql="update {$this->prename}played_group set enable=not enable where id=?";
		if($this->update($sql, $id)){
			$groupName=$this->getValue("select groupName from {$this->prename}played_group where id=?", $id);
			$this->addLog(13,$this->adminLogType[13].'[玩法组开关:'.$groupName.']',$id,$groupName);
			echo '操作成功';
		}else{
			throw new Exception('未知出错');
		}
	}
	
	public final function switchPlayedGroupMStatus($id){
		$sql="update {$this->prename}played_group set android=not android where id=?";
		if($this->update($sql, $id)){
			$groupName=$this->getValue("select groupName from {$this->prename}played_group where id=?", $id);
			$this->addLog(13,$this->adminLogType[13].'[玩法组手机开关:'.$groupName.']',$id,$groupName);
			echo '操作成功';
		}else{
			throw new Exception('未知出错');
		}
	}
	
	public final function switchPlayedStatus($id){
		$sql="update {$this->prename}played set enable=not enable where id=?";
		if($this->update($sql, $id)){
			$groupName=$this->getValue("select groupName from {$this->prename}played_group where id=?", $id);
			$this->addLog(13,$this->adminLogType[13].'[玩法开关:'.$groupName.']',$id,$groupName);
			echo '操作成功';
		}else{
			throw new Exception('未知出错');
		}
	}
	
	public final function switchPlayedMStatus($id){
		$sql="update {$this->prename}played set android=not android where id=?";
		if($this->update($sql, $id)){
			$playName=$this->getValue("select name from {$this->prename}played where id=?", $id);
			$this->addLog(13,$this->adminLogType[13].'[玩法手机开关:'.$playName.']',$id,$playName);
			echo '操作成功';
		}else{
			throw new Exception('未知出错');
		}
	}
	
	public final function updatePlayed($id){
		if($this->updateRows($this->prename .'played', $_POST, 'id='.$id)){
			$groupName=$this->getValue("select groupName from {$this->prename}played_group where id=?", $id);
			$this->addLog(13,$this->adminLogType[13].'[修改:'.$groupName.']',$id,$groupName);
			echo '修改成功';
		}else{
			throw new Exception('未知出错');
		}
	}
	
	
	public final function service(){
		$this->display('system/system-service.php');
	}
	
	public final function serviceadd(){
		$this->display('system/service-add.php');
	}
	
	
	/*清除数据库*/
	public final function clearData(){
		$date=strtotime($_POST['date']." 00:00:00")+24*3600;
		$sql="call clearData('$date')";
		//throw new Exception(date("Y-m-d H:i:s",$date));
		$this->update($sql); 
	}
	
	/*清除空闲用户*/
	public final function clearUser(){
		$clearMemberCoin=$_POST['coin_del'];
		$clearMemberDate=$this->time-$_POST['date_del']*24*3600;
		
		//检查是否有下级，有就过滤掉
		/*//$sql="select distinct u.uid from ssc_members u, ssc_member_session s where u.uid=s.uid and (u.coin+u.fcoin)<$clearMemberCoin and s.accessTime<$clearMemberDate and not exists(select u1.`uid` from ssc_members u1 where u1.parentId=u.`uid`)";
		$sql="select distinct u2.uid from ssc_members u2 where u2.regTime<$clearMemberDate and (u2.coin+u2.fcoin)<$clearMemberCoin and not exists (select s1.uid from ssc_member_session s1 where s1.uid=u2.uid)";
		throw new Exception($sql);
		$userArr=$this->getRows($sql);
		$userIDall='';
		if($userArr) foreach($userArr as $var){
			$userIDall=$userIDall.','.$var['uid'];
		}
		$userIDall=substr($userIDall,1);
		throw new Exception("确认删除用户:".$userIDall);*/
		$sql="call delUsers($clearMemberCoin,$clearMemberDate)";
		//throw new Exception($sql);
		$this->update($sql);
	}
	
	///用户配额
	public final function delUserCount($id){
		
		if(!$id=intval($id)) throw new Exception('参数出错');
		$sql="delete from {$this->prename}params_fandianset  where id=$id";
		
		if($this->delete($sql, $id)){
			
			echo '已经删除';
		}else{

			throw new Exception('未知出错');
		}
	}/////
}
?>