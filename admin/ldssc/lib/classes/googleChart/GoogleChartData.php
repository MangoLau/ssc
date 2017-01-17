<?php

class GoogleChartData
{
protected $values = null;
protected $legend = null;
protected $labels = null;
protected $chco = false;
protected $color = 'ffcc33';
protected $chls = false;
protected $thickness = 2;
protected $dash_length = null;
protected $space_length = null;
protected $fill = null;
protected $fill_slices = array();
protected $autoscale = true;
protected $scale = null;
protected $index = null;
public function __construct($values)
{
if ( $values !== null &&!is_array($values) )
throw new InvalidArgumentException('Invalid values (must be an array or null)');
$this->values = $values;
}
public function getValues()
{
return $this->values;
}
public function hasValues()
{
return $this->values !== null &&!empty($this->values);
}
public function computeChd($encoding = GoogleChart::TEXT,$scale = null)
{
if ( $scale === null ) {
$scale = $this->getScale();
}
switch ( $encoding ) {
case GoogleChart::TEXT :
return self::encodeText($this->values,$scale['min'],$scale['max']);
case GoogleChart::SIMPLE_ENCODING :
return self::encodeSimple($this->values,$scale['min'],$scale['max']);
case GoogleChart::EXTENDED_ENCODING :
return self::encodeExtended($this->values,$scale['min'],$scale['max']);
default:
throw new InvalidArgumentException('Invalid encoding format');
}
}
public function setLabelsAuto()
{
return $this->setLabels(array_keys($this->values));
}
public function setLabels($labels)
{
$n = sizeof($labels);
$v = sizeof($this->values);
if ( $n >$v ) {
throw new InvalidArgumentException('Invalid labels, to many labels');
}
elseif ( $n <$v ) {
$labels += array_fill(0,$v-$n,'');
}
$this->labels = $labels;
return $this;
}
public function getLabels()
{
return $this->labels;
}
public function computeChl()
{
if ( !$this->values )
return '';
if ( $this->labels === null ) {
return str_repeat('|',sizeof($this->values)-1);
}
return implode('|',$this->labels);
}
public function setIndex($index)
{
if ( !is_int($index) )
throw new InvalidArgumentException('Invalid index (must be an integer)');
$this->index = (int) $index;
return $this;
}
public function getIndex()
{
return $this->index;
}
public function hasIndex()
{
return $this->index !== null;
}
public function setAutoscale($autoscale)
{
$this->autoscale = $autoscale;
return $this;
}
public function setScale($min,$max)
{
$this->setAutoscale(false);
$this->scale = array(
'min'=>$min,
'max'=>$max
);
return $this;
}
public function getScale()
{
if ( $this->autoscale == true ) {
if ( !empty($this->values) ) {
$n = min($this->values);
if ( $n >0 )
$n = 0;
return array('min'=>$n,'max'=>max($this->values));
}
}
if ( $this->scale === null ) {
return array('min'=>0,'max'=>100);
}
return $this->scale;
}
public function computeChds()
{
$scale = $this->getScale();
return $scale['min'].','.$scale['max'];
}
public function hasCustomScale()
{
return $this->scale !== null ||$this->autoscale;
}
public function setLegend($legend)
{
$this->legend = $legend;
return $this;
}
public function getLegend()
{
return $this->legend;
}
public function hasCustomLegend()
{
return $this->legend !== null;
}
public function setColor($color)
{
$this->chco = true;
$this->color = $color;
return $this;
}
public function getColor()
{
return $this->color;
}
public function computeChco()
{
if ( is_array($this->color) )
return implode('|',$this->color);
return $this->color;
}
public function hasChco()
{
return $this->chco;
}
public function setFill($color,$end_line = null)
{
$this->fill = array(
'color'=>$color,
'end_line'=>$end_line
);
}
public function addFillSlice($color,$start = null,$stop = null)
{
if ( $start !== null &&!is_numeric($start) ) {
throw new InvalidArgumentException('Invalid start index (must be NULL or numeric)');
}
if ( $stop !== null &&!is_numeric($stop) ) {
throw new InvalidArgumentException('Invalid stop index (must be NULL or numeric)');
}
$this->fill_slices[] = array(
'color'=>$color,
'start'=>$start === null ?null : intval($start),
'stop'=>$stop === null ?null : intval($stop)
);
}
public function computeChm($index)
{
if ( $this->fill === null &&!isset($this->fill_slices[0]) )
return null;
$fill = array();
if ( $this->fill !== null ) {
$fill[] = sprintf(
'%s,%s,%d,%d,0',
$this->fill['end_line'] === null ?'B': 'b',
$this->fill['color'],
$index,
$this->fill['end_line']
);
}
if ( isset($this->fill_slices[0]) ) {
foreach ( $this->fill_slices as $f ) {
$fill[] = sprintf(
'B,%s,%d,%s:%s,0',
$f['color'],
$index,
$f['start'],
$f['stop']
);
}
}
return implode('|',$fill);
}
public function setThickness($thickness)
{
$this->chls = true;
$this->thickness = $thickness;
return $this;
}
public function getThickness()
{
return $this->thickness;
}
public function setDash($dash_length,$space_length = null)
{
$this->chls = true;
$this->dash_length = $dash_length;
$this->space_length = $space_length;
return $this;
}
public function computeChls()
{
$str = $this->thickness;
if ( $this->dash_length !== null ) {
$str .= ','.$this->dash_length;
if  ( $this->space_length !== null ) {
$str .= ','.$this->space_length;
}
}
return $str;
}
public function hasChls()
{
return $this->chls;
}
static public function encodeText(array $values)
{
foreach ( $values as &$v ) {
if ( $v === null ) {
$v = '_';
}
else {
$v = number_format($v,2,'.','');
}
}
return implode(',',$values);
}
static public function encodeSimple(array $values,$min = null,$max = null)
{
if ( $min === null ) {
$min = min($values);
if ( $min >0 ) {
$min = 0;
}
}
if ( $max === null ) {
$max = max($values);
}
$max = $max +abs($min);
$map = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
$str = '';
foreach ( $values as $v ) {
if ( $v === null ) {
$str .= '_';
continue;
}
$n = round(61 * (($v -$min) / $max));
if ( $n >61 ) {
$str .= '9';
}
elseif ( $n <0 ) {
$str .= '_';
}
else {
$str .= $map[$n];
}
}
return $str;
}
static public function encodeExtended(array $values,$min = null,$max = null)
{
if ( $min === null ) {
$min = min($values);
if ( $min >0 ) {
$min = 0;
}
}
if ( $max === null ) {
$max = max($values);
}
$max = $max +abs($min);
if ( $max == 0 )
return '';
$map = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-.';
$str = '';
foreach ( $values as $v ) {
if ( $v === null ) {
$str .= '__';
continue;
}
$n = floor(64 * 64 * (($v -$min) / $max));
if ( $n >(64*64 -1) ) {
$str .= '..';
}
elseif ( $n <0 ) {
$str .= '__';
}
else {
$q = floor($n / 64);
$r = $n -64 * $q;
$str .= $map[$q].$map[$r];
}
}
return $str;
}
static public function calculateLinearRegression($data)
{
$n = count($data);
$x = array_keys($data);
$y = array_values($data);
$x_sum = array_sum($x);
$y_sum = array_sum($y);
$xx_sum = 0;
$xy_sum = 0;
for($i = 0;$i <$n;$i++) {
$xy_sum+=($x[$i]*$y[$i]);
$xx_sum+=($x[$i]*$x[$i]);
}
$m = (($n * $xy_sum) -($x_sum * $y_sum)) / (($n * $xx_sum) -($x_sum * $x_sum));
$b = ($y_sum -($m * $x_sum)) / $n;
return array($m,$b);
}
public function createTrendData()
{
if(!$this->hasValues())
return null;
list($slope,$intercept) = self::calculateLinearRegression(array_values($this->values));
$n = sizeof($this->values);
$array = array();
$v = $intercept;
for ( $i = 1;$i <= $n;$i++) {
$v += $slope;
$array[] = round($v,2);
}
return new self($array);
}
public function createTrendMarker()
{
if(!$this->hasValues())
return null;
$marker = new GoogleChartLineMarker();
$marker->setData($this->createTrendData());
return $marker;
}
}

?>