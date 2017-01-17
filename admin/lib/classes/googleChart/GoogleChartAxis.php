<?php

class GoogleChartAxis
{
const ALIGN_LEFT = -1;
const ALIGN_CENTER = 0;
const ALIGN_RIGHT = 1;
protected $name = null;
protected $labels = null;
protected $range = null;
protected $tick_marks = null;
protected $style = null;
protected $chxs = 0;
protected $label_color = '666666';
protected $font_size = '11';
protected $label_alignment = null;
protected $draw_line = true;
protected $draw_tick_marks = true;
protected $tick_color = '666666';
protected $label_positions = null;
public function __construct($name)
{
switch ( $name ) {
case 'x':
case 't':
$this->label_alignment = 0;
break;
case 'r':
$this->label_alignment = -1;
break;
case 'y':
$this->label_alignment = 1;
break;
default:
throw new InvalidArgumentException('Axis names must be x, y, t or r.');
}
$this->name = $name;
}
public function getName()
{
return $this->name;
}
public function setLabels(array $labels)
{
$this->labels = $labels;
return $this;
}
public function getLabels($compute = true)
{
if ( !$compute ) {
return $this->labels;
}
if ( $this->labels === null )
return null;
return '%d:|'.implode('|',$this->labels);
}
public function hasCustomLabels()
{
return $this->labels !== null;
}
public function setRange($start_val,$end_val,$step = false)
{
$this->range = array(
'start_val'=>$start_val === null ?0 : $start_val,
'end_val'=>$end_val === null ?100 : $end_val,
'step'=>$step === null ?false : $step
);
return $this;
}
public function getRange($compute = true)
{
if ( !$compute )
return $this->range;
if ( $this->range === null )
return null;
$str = '%d,'.$this->range['start_val'].','.$this->range['end_val'];
if ( $this->range['step'] !== false )
$str .= ','.$this->range['step'];
return $str;
}
public function setTickMarks()
{
$this->tick_marks = func_get_args();
if ( !isset($this->tick_marks[0]) )
$this->tick_marks = null;
return $this;
}
public function getTickMarks($compute = true)
{
if ( !$compute )
return $this->tick_marks;
if ( $this->tick_marks === null )
return null;
return '%d,'.implode(',',$this->tick_marks);
}
public function setLabelPositions()
{
$this->label_positions = func_get_args();
if ( !isset($this->label_positions[0]) )
$this->label_positions = null;
return $this;
}
public function computeChxp($axis_index)
{
if ( !$this->label_positions )
return null;
$str = $axis_index.','.implode(',',$this->label_positions);
return $str;
}
public function hasChxp()
{
return $this->label_positions !== null;
}
public function setLabelFormat()
{
if ( $this->chxs <1 ) {
$this->chxs = 1;
}
return $this;
}
public function setLabelColor($color)
{
if ( $this->chxs <1 ) {
$this->chxs = 1;
}
$this->label_color = $color;
return $this;
}
public function setFontSize($size)
{
if ( $this->chxs <2 ) {
$this->chxs = 2;
}
$this->font_size = $size;
return $this;
}
public function setLabelAlignment($alignment)
{
if ( $this->chxs <3 ) {
$this->chxs = 3;
}
$this->label_alignment = $alignment;
return $this;
}
public function setDrawLine($line)
{
if ( $this->chxs <4 ) {
$this->chxs = 4;
}
$this->draw_line = $line;
return $this;
}
public function setDrawTickMarks($tick_marks)
{
if ( $this->chxs <4 ) {
$this->chxs = 4;
}
$this->draw_tick_marks = $tick_marks;
return $this;
}
public function setTickColor($tick_color)
{
if ( $this->chxs <5 ) {
$this->chxs = 5;
}
$this->tick_color = $tick_color;
return $this;
}
public function computeChxs($axis_index,$chart_type = null)
{
if ( !$this->chxs )
return null;
$str = $axis_index;
$str .= ','.$this->label_color;
if ( $this->chxs >1 ) {
$str .= ','.$this->font_size;
if ( $this->chxs >2 ) {
$str .= ','.$this->label_alignment;
if ( $this->chxs >3 ) {
$str .= ',';
if ( !$this->draw_line &&!$this->draw_tick_marks ) {
$str .= '_';
}
else {
if ( $this->draw_line ) {
$str .= 'l';
}
if ( $this->draw_tick_marks ) {
$str .= 't';
}
}
if ( $this->chxs >4 &&$chart_type != 'gom') {
$str .= ','.$this->tick_color;
}
}
}
}
return $str;
}
public function getLabelFormat($compute = true)
{
}
}

?>