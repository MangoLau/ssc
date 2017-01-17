<?php

include_once dirname(__FILE__).'/../GoogleChartMarker.php';
class GoogleChartLineMarker extends GoogleChartMarker
{
protected $size = '2';
protected $points = null;
public function setSize($size)
{
$this->size = $size;
return $this;
}
public function setPoints($start = null,$stop = null)
{
if ( $start === null &&$stop === null ) {
$this->points = null;
}
else {
$this->points = array(
'start'=>$start,
'stop'=>$stop
);
}
return $this;
}
public function compute($index,$chart_type = null)
{
if ( $index === null )
throw new LogicException('Line marker requires one data serie.');
$points = 0;
if ( is_array($this->points) ) {
$points = $this->points['start'].':'.$this->points['stop'];
}
$str = sprintf(
'D,%s,%d,%s,%d',
$this->color,
$index,
$points,
$this->size
);
if ( $this->z_order !== null )
$str .= ','.$this->z_order;
return $str;
}
}

?>