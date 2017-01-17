<?php

require_once 'GoogleChartApi.php';
abstract class GoogleChartIcon extends GoogleChartApi
{
protected $data = null;
protected function computeQuery()
{
$q = array();
$q['chld'] = $this->computeChld();
$q['chst'] = $this->computeChst();
$q = array_merge($q,$this->parameters);
return $q;
}
public function setData(GoogleChartData $data)
{
$this->data = $data;
return $this;
}
public function getData()
{
return $this->data;
}
public function compute($index = 0,$chart_type = null)
{
$str = 'y;';
$tmp = $this->computeChst();
if ( $tmp[0] == 'd'&&$tmp[1] == '_')
$tmp = substr($tmp,2);
$str .= 's='.$tmp;
$str .= ';d='.$this->computeChld(',',',','@');
$str .= ';ds='.$index;
return $str;
}
}

?>