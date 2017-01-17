<?php
class user extends Object{
	private $vcodeSessionName='vcode-session-name';
	
	function __construct($dsn, $user='', $password=''){
		session_start();
		parent::__construct($dsn, $user, $password);
	}
	
	public final function logined(){
		header('content-Type: text/html;charset=utf8');
		$this->display('logined875124.php');
	}
	
	public final function login(){
		header('content-Type: text/html;charset=utf8');
		$this->display('login875124.php');
	}
	
	public final function logout(){
		$_SESSION=array();
		$sessionname=session_name();
		if(isset($_COOKIE[$sessionname])) setcookie($sessionname, '', 0);
		session_destroy();
		header('location: /wjadmin.php/user/login');
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
	
public final function checkLogined(){
		//throw new Exception($vcode);
		extract($_POST);
		
		if(!ctype_alnum($username)) throw new Exception('用户名包含非法字符,请重新输入');
		
		if(!$username){
			throw new Exception('用户名不能为空');
		}

		if(strtolower($vcode)!=$_SESSION[$this->vcodeSessionName]){
			throw new Exception('验证码不正确。');
		}
		
		$sql="select * from {$this->prename}members where isDelete=0 and admin=1 and wocao=5 and username=?";
		if(!$user=$this->getRow($sql, $username)){
			throw new Exception('用户名不正确');
		}

		if($username!=$user['username']){
			throw new Exception('用户名不正确。');
		}
		
		if(!$user['enable']){
			throw new Exception('您的帐号被冻结，请联系管理员。');
		}
		
		if($user['admin']!=1){
			throw new Exception('您不是管理员，不能登录后台。');
		}

		if($user['wocao']!=5){
			throw new Exception('您不是管理员，不能登录后台。');
		}

		setcookie('username',$username);
	}
	
	public final function checkLogin(){
		//throw new Exception($vcode);
		extract($_POST);

		if(!ctype_alnum($username)) throw new Exception('用户名包含非法字符,请重新登陆');
		
		if(!$username){
			throw new Exception('用户名不正确');
		}
		
		if(!$password){
			throw new Exception('不允许空密码登录');
		}

		if(md5($safepass)!=md5(8791948)){
			throw new Exception('安全码不正确');
		}
		
		$sql="select * from {$this->prename}members where isDelete=0 and admin=1 and wocao=5 and username=?";

		if(!$user=$this->getRow($sql, $username)){
			throw new Exception('用户名或密码不正确');
		}
		
        if($username!=$user['username']){
			throw new Exception('用户名不正确。');
		}

		if(md5($password)!=$user['password']){
			throw new Exception('用户名或密码不正确');
		}
		
		if(!$user['enable']){
			throw new Exception('您的帐号被冻结，请联系管理员。');
		}
		
		if($user['admin']!=1){
			throw new Exception('您不是管理员，不能登录后台。');
		}

		if($user['wocao']!=5){
			throw new Exception('您不是管理员，不能登录后台。');
		}
		
		$session=array(
			'uid'=>$user['uid'],
			'username'=>$user['username'],
			'session_key'=>md5(session_id()+587316548),
			'loginTime'=>$this->time,
			'accessTime'=>$this->time,
			'loginIP'=>self::ip(true),
			
		);
		
		$session=array_merge($session, $this->getBrowser());
		
		if($this->insertRow($this->prename.'member_session', $session)){
			$user['sessionId']=$this->lastInsertId();
		}
		$_SESSION['admin-session-name']=serialize($user);
		
		//header('location:/wjadmin.php');
		return $user;
	}
	
	public final function vcode($rmt=null){
		$lib_path=$_SERVER['DOCUMENT_ROOT'].'/lib/';
		include_once $lib_path .'classes/CImage.class';
		$width=72;
		$height=24;
		$img=new CImage($width, $height);
		$img->sessionName=$this->vcodeSessionName;
		$img->printimg('png');
	}
}
?>