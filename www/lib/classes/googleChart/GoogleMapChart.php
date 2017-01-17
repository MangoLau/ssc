<?php

require_once 'GoogleChart.php';
class GoogleMapChart extends GoogleChart
{
const MAX_WIDTH = 440;
const MAX_HEIGHT = 220;
protected $area = 'world';
protected $colors = null;
public function __construct($width,$height)
{
if ( $width >self::MAX_WIDTH )
throw new InvalidArgumentException(sprintf('Max width for Map Chart is %d.',self::MAX_WIDTH));
if ( $height >self::MAX_HEIGHT )
throw new InvalidArgumentException(sprintf('Max height for Map Chart is %d.',self::MAX_HEIGHT));
parent::__construct('t',$width,$height);
}
public function setArea($area)
{
$area = strtolower($area);
if ( !in_array($area,array('africa','asia','europe','middle_east','south_america','usa','world')) )
throw new InvalidArgumentException('Invalid zoom area');
$this->area = $area;
return $this;
}
public function setColors($default_color,array $color_range = null)
{
if ( $color_range !== null &&!isset($color_range[1]) )
throw new Exception('Map Chart color range needs at least two values');
$this->colors = array(
'default'=>$default_color === null ?'BEBEBE': $default_color,
'range'=>$color_range === null ?array('FFFFFF','FF0000') : $color_range
);
return $this;
}
public function getColors($compute = true)
{
if ( !$compute )
return $this->colors;
if ( $this->colors === null )
return null;
return $this->colors['default'].','.implode(',',$this->colors['range']);
}
protected function compute(array &$q)
{
if ( !isset($this->data[0]) )
throw new RuntimeException('Map Chart needs one data serie.');
$v = $this->data[0]->getValues();
$q['chd'] = 't:'.implode(',',$v);
$q['chld'] = strtoupper(implode('',array_keys($v)));
$q['chtm'] = $this->area;
if ( $this->fills ) {
$q['chf'] = implode('|',$this->fills);
}
if ( $this->colors ) {
$q['chco'] = $this->getColors();
}
$this->computeTitle($q);
}
}
?>