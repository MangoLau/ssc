<?php
/**
 * User: MangoLau
 * Date: 2017/2/4
 * Time: 10:53
 */
/**
 * 配置获取函数
 * @param string $section 配置段名 '@文件':表示该文件区分项目环境
 * @param string $key 配置键名
 * @return mix 配置值
 */
function CFG($section, $key='') {
	global $_CONFIG;
	$val		= null;
	$fields		= $key ? explode('.', $key) : array();
	if(empty($_CONFIG) || !array_key_exists($section, $_CONFIG)) {
		loadConfig($section);
	}
	$val = $_CONFIG[$section];
	foreach($fields as $field){
		if(isset($val[$field])){
			$val = $val[$field];
		}else{
			return null;
		}
	}
	return $val;
}

/**
 * 加载配置文件
 * @param string $name 配置文件名(无后缀)
 * @param bool $env 是否区分项目运行环境
 */
function loadConfig($name) {
	global $_CONFIG;
	$_CONFIG[$name] = array();
	$file = 'config/'.$name.'.php';
	if(file_exists($file)) {
		$overwrites = (array)@include($file);
		foreach($overwrites as $k => $v) {
			$_CONFIG[$name][$k] = $v;
		}
		unset($overwrites);
	}
}

function pre($var) {
	echo "<pre>";
	print_r($var);
	echo "</pre>";
}