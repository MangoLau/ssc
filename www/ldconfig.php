<?php
require_once('ldsqlin.php');
$conf['debug']['level']=5;
$conf['db']['dsn']='mysql:host=localhost;dbname=sjk';
$hostname='localhost';    //第三方支付引用
$dbname='sjk'; 
$username='root';
$password=''; //第三方支付引用

$conf['db']['user']='root';
$conf['db']['password']='';
$conf['db']['charset']='utf8';
$conf['db']['prename']='ssc_';
$conf['cache']['expire']=0;
$conf['cache']['dir']='_cache/';
$conf['url_modal']=2;
$conf['action']['template']='ldinc/default/';
$conf['action']['modals']='ldaction/default/';
$conf['member']['sessionTime']=15*60;	// 用户有效时长
error_reporting(E_ERROR & ~E_NOTICE);
ini_set('date.timezone', 'asia/shanghai');
ini_set('display_errors', 'On');
if(strtotime(date('Y-m-d H:i:s',time()))>strtotime(date('Y-m-d',time()).' 03:00:00')){
	
	$GLOBALS['fromTime']=strtotime(date('Y-m-d').' 03:00:00');
	$GLOBALS['toTime']=strtotime(date('Y-m-d',strtotime("+1 day")).' 03:00:00');
}else{
	$GLOBALS['fromTime']=strtotime(date('Y-m-d',strtotime("-1 day")).' 03:00:00');
	$GLOBALS['toTime']=strtotime(date('Y-m-d',time()).' 03:00:00');
}
?>