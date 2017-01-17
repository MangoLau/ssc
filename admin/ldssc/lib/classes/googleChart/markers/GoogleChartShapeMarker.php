<?php

include_once dirname(__FILE__).'/../GoogleChartMarker.php';
class GoogleChartShapeMarker extends GoogleChartMarker
{
const ARROW = 'a';
const CROSS = 'c';
const DIAMOND = 'd';
const CIRCLE = 'o';
const SQUARE = 's';
const X = 'x';
protected $shape = null;
protected $points = null;
protected $position = null;
protected $size = '10';
protected $border = null;
public function __construct($shape = self::CIRCLE)
{
$this->shape = $shape;
}
public function setFixedPosition($x,$y)
{
if ( $x <0 ||$x >1 ||!is_numeric($x) )
throw new InvalidArgumentException('Invalid x position (must be between 0 and 1)');
if ( $y <0 ||$y >1 ||!is_numeric($y) )
throw new InvalidArgumentException('Invalid y position (must be between 0 and 1)');
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
public function setBorder($size = 2,$color = 'ffffff')
{
$this->border = array(
'size'=>$size,
'color'=>$color
);
return $this;
}
public function compute($index,$chart_type = null)
{
if ( $index === null ) {
if ( $this->position === null ) {
throw new LogicException('Shape marker requires one data serie or requires to have a fixed position.');
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
if ( $this->border !== null ) {
$str .= sprintf(
'%s,%s,%d,%s,%s|',
$this->shape,
$this->border['color'],
$index,
$points,
$this->size +$this->border['size']
);
}
$str .= sprintf(
'%s,%s,%d,%s,%s',
$this->shape,
$this->color,
$index,
$points,
$this->size
);
if ( $this->z_order !== null ) {
$str .= ','.$this->z_order;
}
return $str;
}
}
?>