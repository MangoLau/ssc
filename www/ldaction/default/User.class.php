<?php
@session_start();
class User extends WebBase{
	public $title='帝豪娱乐平台';
	private $vcodeSessionName='ssc_vcode_session_name';
	
	/**
	 * 用户登录页面
	 */
	public final function login(){
		$this->display('user/login.php');
	}
	
	/**
	 * 用户登出操作
	 */
	public final function logout(){
		$_SESSION=array();
		if($this->user['uid']){
			$this->update("update {$this->prename}member_session set isOnLine=0 where uid={$this->user['uid']}");
		}
		header('location: /index.php/user/login');
	}
	
	private function getBrowser(){
		$flag=$_SERVER['HTTP_USER_AGENT'];
		$para=array();
		
		// 检查操作系统
		if(preg_match('/Windows[\d\. \w]*/',$flag, $match)) $para['os']=$match[0];
		
		if(preg_match('/Chrome\/[\d\.\w]*/',$flag, $match)){
			// 检查Chrome
			$para['browser']=$match[0];
		}elseif(preg_match('/Safari\/[\d\.\w]*/',$flag, $match)){
			// 检查Safari
			$para['browser']=$match[0];
		}elseif(preg_match('/MSIE [\d\.\w]*/',$flag, $match)){
			// IE
			$para['browser']=$match[0];
		}elseif(preg_match('/Opera\/[\d\.\w]*/',$flag, $match)){
			// opera
			$para['browser']=$match[0];
		}elseif(preg_match('/Firefox\/[\d\.\w]*/',$flag, $match)){
			// Firefox
			$para['browser']=$match[0];
		}else{
			$para['browser']='unkown';
		}
		//print_r($para);exit;
		return $para;
	}	
	/**
	 * 用户登录检查
	 */
	public final function logined($username, $password, $vcode){
		$username=wjStrFilter($username);
		$password=wjStrFilter($password);
		$vcode=wjStrFilter($vcode,0,0);
		if(strtolower($vcode)!=$_SESSION[$this->vcodeSessionName]){
			throw new Exception('验证码不正确。');
		}
		//验证码使用完之后要清空
		unset($_SESSION[$this->vcodeSessionName]);
		
				if(!$username){
			throw new Exception('用户名不能为空');
		}
				if(!$password){
			throw new Exception('不允许空密码登录');
		}
		if(!ctype_alnum($username)) throw new Exception('用户名包含非法字符,请重新输入');
		
		$sql="select * from {$this->prename}members where isDelete=0 and admin=0 and wocao!=5 and username=?";
		if(!$user=$this->getRow($sql, $username)){
			throw new Exception('用户名不正确');
		}
			if($user['passWrong'] > 5){
			throw new Exception('您的账号因多次输错密码，已经被冻结.请找客服或联系您的上级解除冻结');
		}
		if(md5($password)!=$user['password']){
		$this->update("update {$this->prename}members set passWrong=passWrong+1 where uid={$user['uid']}");
			throw new Exception('密码不正确');
		}
		if(!$user['enable']){
			throw new Exception('您的帐号被冻结，请联系管理员。');
		}
		//正确登陆，密码错误记录归0
		if($user['passWrong'] != 0) $this->update("update {$this->prename}members set passWrong=0 where uid={$user['uid']}");
		$session=array(
			'uid'=>$user['uid'],
			'username'=>$user['username'],
			'session_key'=>session_id(),
			'loginTime'=>$this->time,
			'accessTime'=>$this->time,
			'loginIP'=>self::ip(true),
			
		);
		$session=array_merge($session, $this->getBrowser());
		if($this->insertRow($this->prename.'member_session', $session)){
			$user['sessionId']=$this->lastInsertId();
		}
		$_SESSION[$this->memberSessionName]=serialize($user);
		
		// 把别人踢下线
		//if($user->user['']) 
		//throw new Exception("update {$this->prename}member_session set isOnLine=0 where uid={$user['uid']} and id > {$user['sessionId']}");
		try {
			$this->update("update {$this->prename}member_session set isOnLine=0 where uid={$user['uid']} and id < {$user['sessionId']}");
		}catch (Exception $e){
			//什么都不用做
		}
		return $user;
		}
		
	/**
	 * 验证码产生器
	 */
	public final function vcode($rmt=null){
		$lib_path=$_SERVER['DOCUMENT_ROOT'].'/lib/';
		include_once $lib_path .'classes/CImage.class';
		$width=72;
		$height=24;
		$img=new CImage($width, $height);
		$img->sessionName=$this->vcodeSessionName;
		$img->printimg('png');
	}
	
	/**
	 * 推广注册
	 */
	public final function r($userxxx){
		if(!$userxxx){
			$this->display('team/register.php');
		}else{
			$lid = $this->myxor($this->hexToStr($userxxx));
			if(!is_numeric($lid)){
				$this->display('team/register.php');
			}else{
				if(!$link=$this->getRow("select * from {$this->prename}links where lid=?",$lid)){
					$this->display('team/register.php');
				}else{
					if(!$link['enable']){
						$this->display('team/register.php');
					}else{
						$this->display('team/register.php',0,$userxxx);
					}
				}
			}
		}
	}
	public final function reg(){
		if(strtolower($_POST['vcode'])!=$_SESSION[$this->vcodeSessionName]){
			throw new Exception('验证码不正确。');
		}
		
		//验证码使用完之后要清空
		unset($_SESSION[$this->vcodeSessionName]);
		
		if(!$_POST['codec']) throw new Exception('链接错误');
		$lid = $this->myxor($this->hexToStr($_POST['codec']));
		if(!$link=$this->getRow("select * from {$this->prename}links where lid=?",$lid)){
			throw new Exception('该链接已失效，请联系您的上级重新索取注册链接！！');
		}else{
			$para=array(
					'username'=>$_POST['username'],
					'type'=>$link['type'],
					'password'=>md5($_POST['password']),
					'parentId'=>$link['uid'],
					'parents'=>$this->getValue("select parents from {$this->prename}members where uid=?",$link['uid']),
					'fanDian'=>$link['fanDian'],
					'fanDianBdw'=>$link['fanDianBdw'],
					'regIP'=>$this->ip(true),
					'regTime'=>$this->time,
					'qq'=>$_POST['qq'],
					'coin'=>0,
					'fcoin'=>0,
					'score'=>0,
					'scoreTotal'=>0,
					'admin'=>0,					
			);
			
			if(!$para['nickname']) $para['nickname']=$para['username'];
			if(!$para['name']) $para['name']=$para['username'];
			
			
			try{
				$this->beginTransaction();
				$sql="select username from {$this->prename}members where username=?";
				if($this->getValue($sql, $para['username'])) throw new Exception('用户"'.$para['username'].'"已经存在');
				if($this->insertRow($this->prename .'members', $para)){
					$id=$this->lastInsertId();
					$sql="update {$this->prename}members set parents=concat(parents, ',', $id) where `uid`=$id";
					$this->update($sql);
					$this->commit();
					return '注册成功';
				}else{
					throw new Exception('注册失败');
				}
					
			}catch(Exception $e){
				$this->rollBack();
				throw $e;
			}
		}
	}
}
?>