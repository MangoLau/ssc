<?php
/**
 * �ѿ����˻��㷨
 *
 * @params һ���ɱ������ԭ����ÿ���������飬���������ֻ��һ��ֵ��ֱ�������ֵ
 *
 * useage:
 * console.log(DescartesAlgorithm(2, [4,5], [6,0],[7,8,9]));
 */
function DescartesAlgorithm(){
	$args=func_get_args();
	foreach($args as $i=>$v){
		if(!is_array($v)) $args[$i]=$v;
	}
	if(count($args)==1) return $args[0];
	if(count($args)==2){
	
	}
	
}
?>