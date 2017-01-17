<?php
class Team extends WebLoginBase{
	public $pageSize=20;
	
	public function getMyUserCount1(){
		$this->getSystemSettings();
		$minFanDian=$this->user['fanDian'] - 10 * $this->settings['fanDianDiff'];
		$sql="select count(*) registerUserCount, fanDian from {$this->prename}members where parentId={$this->user['uid']} and fanDian>=$minFanDian and fanDian<{$this->user['fanDian']} group by fanDian order by fanDian desc";
		$data=$this->getRows($sql);
		
		$ret=array();
		$fanDian=$this->user['fanDian'];
		$i=0;
		$set=explode(',', $this->settings['fanDianUserCount']);
		
		while(($fanDian-=$this->settings['fanDianDiff']) && ($fanDian>=$minFanDian)){
			$arr=array();
			if($data[0]['fanDian']==$fanDian){
				$arr=array_shift($data);
			}else{
				$arr['fanDian']=$fanDian;
				$arr['registerUserCount']=0;
			}
			
			$arr['setting']=$set[$i];
			//var_dump($fanDian);
			$ret["$fanDian"]=$arr;
			
			$i++;
		}
		
		return ($ret);
	}
	
	public function getMyUserCount(){
		if(!$set=$this->settings['fanDianUserCount']) return array();
		$set=explode(',', $set);
		
		foreach($set as $key=>$var){
			$set[$key]=explode('|', $var);
		}
		
		foreach($set as $var){
			if($this->user['fanDian']>=$var[1]) break;
			array_shift($set);
		}
		
	}
	
	
	
	/*游戏记录*/
	public final function gameRecord(){
		$this->getTypes();
		$this->getPlayeds();
		$this->action='searchGameRecord';
		$this->display('team/record.php');
	}
	
	
	public final function searchGameRecord(){
		
		$this->getTypes();
		$this->getPlayeds();
		$this->display('team/record-list.php');
	}
	/*游戏记录 结束*/
	
	
	/*团队报表*/
	public final function report(){

		$this->action='searchReport';
		$this->display('team/report.php');
	}
	
	
	public final function searchReport(){
		
		$this->display('team/report-list.php');
	}
	/*团队报表 结束*/
	
	/*帐变列表*/
	public final function coin(){
		$this->action='searchCoin';
		$this->display('team/coin.php');
	}
	
	public final function searchCoin(){
		$this->display('team/coin-log.php');
	}
	/*帐变列表 结束*/
	
	public final function coinall(){
		$this->freshSession();
		$this->display('team/coinall.php');
	}
	
	public final function addMember(){
		//print_r($this->getMyUserCount());
		$this->display('team/add-member.php');
	}
	public final function userUpdate($id){
		$this->display('team/update-menber.php', 0, $id);
	}
	public final function memberList(){
		$this->display('team/member-list.php');
	}
	
	public final function cashRecord(){
		$this->display('team/cash-record.php');
	}
	
	public final function searchCashRecord(){
		$this->display('team/cash-record-list.php');
	}
	public final function addLink(){
		$this->display('team/add-link.php');
	}
	public final function linkList(){
		$this->display('team/link-list.php');
	}
	public final function getLinkCode($id){
		$this->display('team/get-linkcode.php', 0, $id, $this->user['uid'], $this->urlPasswordKey);
	}
	public final function advLink(){
		//$this->display('team/adv-link.php', 0, $this->user['uid'], $this->urlPasswordKey);
		$this->display('team/link-list.php');
	}
	public final function insertLink(){
		$this->getSystemSettings();
		$para=$_POST;
		$para['regIP']=$this->ip(true);
		$para['regTime']=$this->time;
		
		if(!is_numeric($para['fanDian']) || !is_numeric($para['fanDianBdw']))throw new Exception('参数错误，返点和不定位返点都不能为空，且必须是数字');
		
		// 查检返点设置
		if($para['fanDian'] % $this->settings['fanDianDiff']) throw new Exception(sprintf('返点只能是%.1f%的倍数', $this->settings['fanDianDiff']));
		if($para['fanDianBdw'] % $this->settings['fanDianDiff']) throw new Exception(sprintf('不定位返点只能是%.1f%的倍数', $this->settings['fanDianDiff']));
		
		if($this->user['fanDian'] < $para['fanDian'])throw new Exception("返点值不能大于{$this->user['fanDian']}");
		if($this->user['fanDianBdw'] < $para['fanDianBdw'])throw new Exception("不定位返点值不能大于{$this->user['fanDianBdw']}");
		
		$this->beginTransaction();
		try{
			$sql="select fanDian from {$this->prename}links where uid={$para['uid']} and fanDian=? ";
			
			if($this->getValue($sql, $para['fanDian'])) throw new Exception('此链接已经存在');
			if($this->insertRow($this->prename .'links', $para)){
				$id=$this->lastInsertId();
				
				$this->commit();
				
				return '添加链接成功';
			}else{
				throw new Exception('添加链接失败');
			}
			
		}catch(Exception $e){
			$this->rollBack();
			throw $e;
		}
	}
	
	/*编辑注册链接*/
	public final function linkUpdate($id){
		$this->display('team/update-link.php', 0, $id);
	}
	
	public final function linkUpdateed(){
		$para['fanDian']=$_POST['fanDian'];
		$para['fanDianBdw']=$_POST['fanDianBdw'];
		$para['updateTime']=date("Y-m-d H:i:s", $this->time);
		$lid=$_POST['lid'];
		
		if(!is_numeric($para['fanDian']) || !is_numeric($para['fanDianBdw']))throw new Exception('参数错误，返点和不定位返点都不能为空，且必须是数字');
		
		// 查检返点设置
		if($para['fanDian'] % $this->settings['fanDianDiff']) throw new Exception(sprintf('返点只能是%.1f%的倍数', $this->settings['fanDianDiff']));
		if($para['fanDianBdw'] % $this->settings['fanDianDiff']) throw new Exception(sprintf('不定位返点只能是%.1f%的倍数', $this->settings['fanDianDiff']));
		
		if($this->user['fanDian'] < $para['fanDian'])throw new Exception("返点值不能大于{$this->user['fanDian']}");
		if($this->user['fanDianBdw'] < $para['fanDianBdw'])throw new Exception("不定位返点值不能大于{$this->user['fanDianBdw']}");
		
		if(!$para['fanDian']) unset($para['fanDian']);
		if(!$para['fanDianBdw']) unset($para['fanDianBdw']);

		if($this->updateRows($this->prename .'links', $para, "lid=$lid and uid={$this->user['uid']}")){
			echo '修改成功';
		}else{
			throw new Exception('未知出错');
		}
		
	}
	
	/*删除注册链接*/
	public final function linkDelete($lid){
		$sql="delete from {$this->prename}links where uid={$this->user['uid']} and lid=?";
		if($this->delete($sql, $lid)){
			echo '删除成功';
		}else{
			throw new Exception('请确认这是您的注册链接！');
		}
	}

	
	public final function searchMember(){
		$this->display('team/member-search-list.php');
	}
	
	
	public final function insertMember(){
		$para=$_POST;
		$para['parentId']=$this->user['uid'];
		$para['parents']=$this->user['parents'];
		$para['password']=md5($para['password']);
		
		$para['regIP']=$this->ip(true);
		$para['regTime']=$this->time;
		
		$para['coin']=0;
		$para['fcoin']=0;
		$para['score']=0;
		$para['admin']=0;
		
		if(!$para['nickname']) $para['nickname']=$para['username'];
		if(!$para['name']) $para['name']=$para['username'];
		
		//$subCount=$this->getValue("select count(*) from {$this->prename}members where parentId=?", $this->user['uid']);
		//throw new Exception($subCount);
		//if($subCount>=$this->user['subCount']) throw new Exception('您的会员人数已经达到上限');
		
		// 查检返点设置
		if($para['fanDian']=floatval($para['fanDian'])){
			$this->getSystemSettings();
			if($para['fanDian'] % $this->settings['fanDianDiff']) throw new Exception(sprintf('返点只能是%.1f%的倍数', $this->settings['fanDianDiff']));
			
			$count=$this->getMyUserCount();
			$sql="select userCount, (select count(*) from {$this->prename}members m where m.parentId={$this->user['uid']} and m.fanDian=s.fanDian) registerCount from {$this->prename}params_fandianset s where s.fanDian={$para['fanDian']}";
			$count=$this->getRow($sql);
			//throw new Exception($sql);
			//throw new Exception(sprintf('注册人数：%d，总人数：%d', $count['registerCount'], $count['userCount']));
			
			if($count && $count['registerCount']>=$count['userCount']) throw new Exception(sprintf('对不起返点为%.1f的下级人数已经达到上限', $para['fanDian']));
		}else{
			$para['fanDian']=0;
		}
		
		$this->beginTransaction();
		try{
			$sql="select username from {$this->prename}members where username=?";
			if($this->getValue($sql, $para['username'])) throw new Exception('用户“'.$para['username'].'”已经存在');
			if($this->insertRow($this->prename .'members', $para)){
				$id=$this->lastInsertId();
				$sql="update {$this->prename}members set parents=concat(parents, ',', $id) where `uid`=$id";
				$this->update($sql);
				
				$this->commit();
				
				return '添加会员成功';
			}else{
				throw new Exception('添加会员失败');
			}
			
		}catch(Exception $e){
			$this->rollBack();
			throw $e;
		}
	}
	
	public final function userUpdateed(){
		$uid=$_POST['uid'];
		$para = array('qq'=>$_POST['qq'], 'fanDian'=>$_POST['fanDian'], 'fanDianBdw'=>$_POST['fanDianBdw']);
		if(!is_numeric($para['fanDian']) || !is_numeric($para['fanDianBdw']))throw new Exception('输入有误！请从新输入。');
		$cur = $this->getRow("select fanDian,fanDianBdw from {$this->prename}members where uid=? and parentId=".$this->user['uid'], $uid);
		if(!$cur){
			throw new Exception('找不到该用户，确认是你的下级吗？');
		}
		if(!$para['fanDian']) unset($para['fanDian']);
		if($cur['fanDian'] > $para['fanDian'])throw new Exception('返点只能调高，不能调低，要调低请联系客服处理！');
		if($para['fanDian'] > $this->user['fanDian'])throw new Exception('返点设置过高！');
		if(!$para['fanDianBdw']) unset($para['fanDianBdw']);
		if($cur['fanDianBdw'] > $para['fanDianBdw'])throw new Exception('不定位返点只能调高，不能调低，要调低请联系客服处理！');
		if($para['fanDianBdw'] > $this->user['fanDianBdw'])throw new Exception('不定位返点设置过高！');
		if($this->updateRows($this->prename .'members',$para,"uid=$uid")){
			//$this->addLog(5,$this->adminLogType[5].'['.$para['username'].']',$para['uid'],$para['username']);
			return '修改成功';
		}else{
			throw new Exception('未知出错');
		}		
	}
	
}
?>