<?php

include_once dirname(__FILE__).'/../GoogleChartMarker.php';
class GoogleChartTextMarker extends GoogleChartMarker
{
const FLAG = 'f';
const TEXT = 't';
const ANNOTATION = 'A';
const VALUE = 'N';
const LEFT = 'r';
const CENTER = 'h';
const RIGHT = 'l';
const TOP = 'b';
const MIDDLE = 'v';
const BOTTOM = 't';
const BAR_BASE = 's';
const BAR_CENTER = 'c';
const BAR_TOP = 'e';
protected $marker_type = null;
protected $points = null;
protected $position = null;
protected $size = 10;
protected $placement = null;
protected $text = null;
protected $bar_sum = false;
public function __construct($marker_type = self::VALUE,$text = null)
{
$this->marker_type = $marker_type;
$this->text = $text;
}
public function setText($text)
{
$this->text = $text;
return $this;
}
public function setFixedPosition($x,$y)
{
if ( $x <0 ||$x >1 ||!is_numeric($x) )
throw new InvalidArgumentException('Invalid x position (must be between 0 and 1)');
if ( $y <0 ||$y >1 ||!is_numeric($y) )
throw new InvalidArgumentException('Invalid y position (must be between 0 and 1)');
if ( $this->marker_type === self::VALUE )
throw new LogicException('Fixed position is not supported for VALUE marker.');
$this->position = array(
'x'=>$x,
'y'=>$y
);
return $this;
}
public function setPoint($point)
{
$this->points = $point;
return $this;
}
public function setPoints($start = null,$end = null,$step = null)
{
if ( $this->points['start'] === null &&$this->points['end'] === null &&$this->points['step'] === null ) {
$this->points = null;
}
$this->points = array(
'start'=>$start,
'end'=>$end,
'step'=>$step
);
return $this;
}
public function setStep($step)
{
$this->points = array(
'start'=>null,
'end'=>null,
'step'=>$step
);
return $this;
}
public function setSize($size)
{
$this->size = $size;
return $this;
}
public function setPlacement($horizontal_placement = null,$vertical_placement = null,
$horizontal_offset = null,$vertical_offset = null,$bar_relative_placement = null)
{
$this->placement = array(
'horizontal_placement'=>$horizontal_placement,
'vertical_placement'=>$vertical_placement,
'horizontal_offset'=>$horizontal_offset,
'vertical_offset'=>$vertical_offset,
'bar_relative_placement'=>$bar_relative_placement
);
return $this;
}
public function getPlacement($bar_chart = false)
{
$str = '';
$str .= $this->placement['horizontal_placement'].$this->placement['vertical_placement'];
if ( $bar_chart ) {
$str .= $this->placement['bar_relative_placement'];
}
$str .= ':'.$this->placement['horizontal_offset'].':'.$this->placement['vertical_offset'];
$str = trim($str,':');
return $str;
}
public function setBarSum($sum)
{
$this->bar_sum = (bool) $sum;
return $this;
}
public function compute($index,$chart_type = null)
{
if ( $chart_type[0] == 'b'&&$this->bar_sum ) {
$index = -1;
}
if ( $index === null ) {
if ( $this->position === null ) {
throw new LogicException('Text marker requires one data serie or requires to have a fixed position.');
}
$str = '@';
$points = $this->position['x'].':'.$this->position['y'];
}
else {
$str = '';
if ( $this->points === null ) {
$points = '-1';
}
elseif ( !is_array($this->points) ) {
$points = number_format($this->points,1);
}
elseif ( $this->points['start'] === null &&$this->points['end'] === null ) {
$points = '-'.$this->points['step'];
}
else {
$points = $this->points['start'].':'.$this->points['end'].':'.$this->points['step'];
}
}
$str .= $this->marker_type;
if ( $this->marker_type === self::VALUE ) {
}
else {
$str .= str_replace(',','\,',$this->text);
}
$str .= sprintf(
',%s,%d,%s,%s',
$this->color,
$index,
$points,
$this->size
);
if ( $this->z_order !== null ) {
$str .= ','.$this->z_order;
}
if ( $this->placement !== null ) {
$tmp = $this->getPlacement($chart_type !== null &&$chart_type[0] === 'b');
if ( $tmp ) {
if ( $this->z_order === null ) {
$str .= ',';
}
$str .= ','.$tmp;
}
}
return $str;
}
}

?>