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

/**
 * 获取一个中文字符的拼音首字母
 * @param string $str 一个中文字符
 * @return null|string
 */
function getFirstCharter($str=''){
	if(empty($str)){return '';}
	$fchar=ord($str{0});
	if($fchar>=ord('A')&&$fchar<=ord('z')) return strtoupper($str{0});
	$s1=iconv('UTF-8','gb2312',$str);
	$s2=iconv('gb2312','UTF-8',$s1);
	$s=$s2==$str?$s1:$str;
	$asc=ord($s{0})*256+ord($s{1})-65536;
	if($asc>=-20319&&$asc<=-20284) return 'A';
	if($asc>=-20283&&$asc<=-19776) return 'B';
	if($asc>=-19775&&$asc<=-19219) return 'C';
	if($asc>=-19218&&$asc<=-18711) return 'D';
	if($asc>=-18710&&$asc<=-18527) return 'E';
	if($asc>=-18526&&$asc<=-18240) return 'F';
	if($asc>=-18239&&$asc<=-17923) return 'G';
	if($asc>=-17922&&$asc<=-17418) return 'H';
	if($asc>=-17417&&$asc<=-16475) return 'J';
	if($asc>=-16474&&$asc<=-16213) return 'K';
	if($asc>=-16212&&$asc<=-15641) return 'L';
	if($asc>=-15640&&$asc<=-15166) return 'M';
	if($asc>=-15165&&$asc<=-14923) return 'N';
	if($asc>=-14922&&$asc<=-14915) return 'O';
	if($asc>=-14914&&$asc<=-14631) return 'P';
	if($asc>=-14630&&$asc<=-14150) return 'Q';
	if($asc>=-14149&&$asc<=-14091) return 'R';
	if($asc>=-14090&&$asc<=-13319) return 'S';
	if($asc>=-13318&&$asc<=-12839) return 'T';
	if($asc>=-12838&&$asc<=-12557) return 'W';
	if($asc>=-12556&&$asc<=-11848) return 'X';
	if($asc>=-11847&&$asc<=-11056) return 'Y';
	if($asc>=-11055&&$asc<=-10247) return 'Z';
	return null;
}

/** 获取中文字符串的拼音首字母
 * @param string $str 中文字符串
 * @return string
 */
function getChinese2Pinyin($str='') {
	$len = mb_strlen($str);
	$return = '';
	for($i = 0; $i<$len; $i++) {
		$temp = mb_substr($str,$i,1);
		$return .= getFirstCharter($temp);
	}
	return $return;
}

function getArrChinese2Pinyin($arr=array()) {
	if(!is_array($arr) || empty($arr)) return false;
	$return = array();
	foreach($arr as $k=>$v) {
		$return[$k] = getChinese2Pinyin($v);
	}
	return $return;
}
