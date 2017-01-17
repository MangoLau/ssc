<?php
require_once('ldsqlin.php');
$conf['debug']['level']=5;

/*		数据库配置		*/
$conf['db']['dsn']='mysql:host=localhost;dbname=ssc2014';
$conf['db']['user']='user';
$conf['db']['password']='bhpKh3cwN4FCKVAA';
$conf['db']['charset']='utf8';
$conf['db']['prename']='ssc_';

$conf['cache']['expire']=0;
$conf['cache']['dir']='_cache/';

$conf['url_modal']=2;

$conf['action']['template']='ldinc/admin/';
$conf['action']['modals']='ldaction/admin/';

$conf['member']['sessionTime']=15*60;	// 用户有效时长
$conf['node']['access']='http://localhost:8800';	// node访问基本路径

error_reporting(E_ERROR & ~E_NOTICE);
ini_set('date.timezone', 'asia/shanghai');
//ini_set('session.cookie_domain', '.wanjinyule.com');
ini_set('display_errors', 'Off');
