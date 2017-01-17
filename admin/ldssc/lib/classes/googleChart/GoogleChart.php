<?php

require_once 'GoogleChartApi.php';
require_once 'GoogleChartData.php';
require_once 'GoogleChartAxis.php';
require_once 'GoogleChartMarker.php';
class GoogleChart extends GoogleChartApi
{
const AUTOSCALE_OFF = false;
const AUTOSCALE_VALUES = true;
const BACKGROUND = 'bg';
const CHART_AREA = 'c';
const TEXT = 't';
const SIMPLE_ENCODING = 's';
const EXTENDED_ENCODING = 'e';
protected $type = '';
protected $width = '';
protected $height = '';
protected $data = array();
protected $data_format = self::TEXT;
protected $data_separator = array(
self::TEXT =>'|',
self::SIMPLE_ENCODING =>',',
self::EXTENDED_ENCODING =>','
);
protected $axes = array();
protected $markers = array();
protected $dynamic_markers = array();
protected $grid_lines = null;
protected $chts = false;
protected $title = null;
protected $title_color = '000000';
protected $title_size = '12';
protected $autoscale = true;
protected $scale = null;
protected $legend_position = null;
protected $legend_label_order = null;
protected $legend_skip_empty = true;
protected $fills = null;
protected $_compute_data_label = false;
protected $margin = null;
protected $legend_size = null;
public function __construct($type,$width,$height)
{
$this->type = $type;
$this->width = $width;
$this->height = $height;
}
public function setDataFormat($format)
{
if ( $format !== self::TEXT &&$format !== self::SIMPLE_ENCODING &&$format !== self::EXTENDED_ENCODING ) {
throw new InvalidArgumentException('Invalid data format');
}
$this->data_format = $format;
}
public function addData(GoogleChartData $data)
{
if ( $data->hasIndex() )
throw new LogicException('Invalid data serie. This data serie has already been added.');
$index = array_push($this->data,$data);
$data->setIndex($index -1);
return $this;
}
public function addAxis(GoogleChartAxis $axis)
{
$this->axes[] = $axis;
return $this;
}
public function addMarker(GoogleChartMarker $marker)
{
$this->markers[] = $marker;
return $this;
}
public function addDynamicMarker(GoogleChartIcon $marker)
{
$this->dynamic_markers[] = $marker;
return $this;
}
public function setAutoscale($autoscale)
{
if ( $autoscale !== true &&$autoscale !== false ) {
throw new InvalidArgumentException('Invalid autoscale mode.');
}
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
return $this->scale;
}
public function computeChds()
{
if ( $this->scale === null ) {
throw new LogicException('Cannot compute scale that has not been set');
}
return $this->scale['min'].','.$this->scale['max'];
}
public function setTitle($title)
{
$this->title = $title;
return $this;
}
public function getTitle()
{
return $this->title;
}
public function computeChtt()
{
if ( $this->title === null )
return null;
return str_replace(array("\r","\n"),array('','|'),$this->title);
}
public function setTitleColor($color)
{
$this->chts = true;
$this->title_color = $color;
return $this;
}
public function getTitleColor()
{
return $this->title_color;
}
public function setTitleSize($size)
{
$this->chts = true;
$this->title_size = $size;
return $this;
}
public function getTitleSize()
{
return $this->title_size;
}
public function computeChts()
{
return $this->title_color.','.$this->title_size;
}
public function hasChts()
{
return $this->chts;
}
public function setLegendPosition($position)
{
$this->legend_position = $position;
return $this;
}
public function setLegendLabelOrder($label_order)
{
$this->legend_label_order = $label_order;
return $this;
}
public function setLegendSkipEmpty($skip_empty)
{
$this->legend_skip_empty = (bool) $skip_empty;
return $this;
}
public function setLegendSize($width,$height)
{
$this->legend_size = array(
'width'=>$width,
'heigh'=>$height
);
return $this;
}
public function computeChdlp()
{
$str = '';
if ( $this->legend_position !== null ) {
$str .= $this->legend_position;
}
if ( $this->legend_skip_empty === true ) {
$str .= 's';
}
if ( $this->legend_label_order !== null ) {
$str .= '|'.$this->legend_label_order;
}
return $str;
}
public function hasChdlp()
{
return $this->legend_skip_empty === true ||$this->legend_position !== null ||$this->legend_label_order !== null;
}
public function setGridLines($x_axis_step_size,$y_axis_step_size,$dash_length = false,
$space_length = false,$x_offset = false,$y_offset = false)
{
$this->grid_lines = $x_axis_step_size.','.$y_axis_step_size;
if ( $dash_length !== false ) {
$this->grid_lines .= ','.$dash_length;
if ( $space_length !== false ) {
$this->grid_lines .= ','.$space_length;
if ( $x_offset !== false ) {
$this->grid_lines .= ','.$x_offset;
if ( $y_offset !== false ) {
$this->grid_lines .= ','.$y_offset;
}
}
}
}
return $this;
}
public function setFill($color,$area = self::BACKGROUND)
{
if ( $area != self::BACKGROUND &&$area != self::CHART_AREA ) {
throw new InvalidArgumentException('Invalid fill area.');
}
$this->fills[$area] = $area.',s,'.$color;
return $this;
}
public function setOpacity($opacity)
{
if ( $opacity <0 ||$opacity >100 ) {
throw new InvalidArgumentException('Invalid opacity (must be between 0 and 100).');
}
$opacity = str_pad(dechex(round($opacity * 255 / 100)),8,0,STR_PAD_LEFT);
$this->fills[self::BACKGROUND] = 'a,s,'.$opacity;
return $this;
}
public function setGradientFill($angle,array $colors,$area = self::BACKGROUND)
{
if ( $angle <0 ||$angle >90 ) {
throw new InvalidArgumentException('Invalid angle (must be between 0 and 90).');
}
if ( !isset($colors[1]) ) {
throw new InvalidArgumentException('You must specify at least 2 colors to create a gradient fill.');
}
if ( $area != self::BACKGROUND &&$area != self::CHART_AREA ) {
throw new InvalidArgumentException('Invalid area.');
}
$tmp = array();
$i = 0;
$n = sizeof($colors);
for ( $i = 0;$i <$n;$i++) {
$centerpoint = null;
$color = null;
if ( is_array($colors[$i]) ) {
$c = $colors[$i];
if ( !isset($c[0]) ) {
throw new InvalidArgumentException('Each color must be an array of the color code in RRGGBB and the color centerpoint.');
}
$color = $c[0];
if ( isset($c[1]) ) {
$centerpoint = $c[1];
}
}
else {
$color = $colors[$i];
}
if ( !$centerpoint ) {
$centerpoint = $i / ($n-1);
}
$tmp[] = $color.','.round($centerpoint,2);
}
$this->fills[$area] = $area.',lg,'.$angle.','.implode(',',$tmp);
}
public function setStripedFill($angle,array $colors,$area = self::BACKGROUND)
{
}
public function setMargin($top,$right = null,$bottom = null,$left = null)
{
if ( $left === null &&$right === null &&$bottom === null ) {
$this->margin = array(
'left'=>(float) $top,
'right'=>(float) $top,
'top'=>(float) $top,
'bottom'=>(float) $top
);
}
elseif ( $left === null &&$bottom === null ) {
$this->margin = array(
'left'=>(float) $right,
'right'=>(float) $right,
'top'=>(float) $top,
'bottom'=>(float) $top
);
}
else {
$this->margin = array(
'left'=>(float) $left,
'right'=>(float) $right,
'top'=>(float) $top,
'bottom'=>(float) $bottom
);
}
return $this;
}
public function computeChma()
{
$str = '';
if ( $this->margin ) {
$str = implode(',',$this->margin);
}
if ( $this->legend_size ) {
$str .= '|'.implode(',',$this->legend_size);
}
return $str;
}
public function hasChma()
{
return $this->margin !== null ||$this->legend_size !== null;
}
protected function computeQuery()
{
$q = array(
'cht'=>$this->type,
'chs'=>$this->width.'x'.$this->height
);
$this->compute($q);
$q = array_merge($q,$this->parameters);
return $q;
}
protected function compute(array &$q)
{
if ( $this->grid_lines ) {
$q['chg'] = $this->grid_lines;
}
if ( $this->fills ) {
$q['chf'] = implode('|',$this->fills);
}
if ( $this->hasChma() ) {
$q['chma'] = $this->computeChma();
}
$this->computeTitle($q);
$this->computeScale($q);
$this->computeData($q);
$this->computeMarkers($q);
$this->computeAxes($q);
}
protected function computeTitle(array &$q)
{
if ( $this->title ) {
$q['chtt'] = $this->computeChtt();
if ( $this->hasChts() ) {
$q['chts'] = $this->computeChts();
}
}
}
protected function computeScale(array &$q)
{
if ( !$this->autoscale )
return $this;
$value_min = 0;
$value_max = 0;
foreach ( $this->data as $i =>$d ) {
$values = $d->getValues();
if ( $values === null ||empty($values) )
continue;
$max = max($values);
$min = min($values);
if ( $max >$value_max ) {
$value_max = $max;
}
if ( $min <$value_min ) {
$value_min = $min;
}
}
if ( $value_min >0 )
$value_min = 0;
$this->scale = array('min'=>$value_min,'max'=>$value_max);
return $this;
}
protected function computeData(array &$q)
{
$data = array();
$colors = array();
$colors_needed = false;
$styles = array();
$styles_needed = false;
$fills = array();
$scales = array();
$scale_needed = false;
$legends = array();
$legends_needed = false;
if ( $this->_compute_data_label ) {
$labels = array();
}
foreach ( $this->data as $i =>$d ) {
if ( $d->hasValues() ) {
$data[] = $d->computeChd($this->data_format,$this->scale);
if ( !$this->autoscale &&!$this->scale ) {
$scales[] = $d->computeChds();
if ( $d->hasCustomScale() ) {
$scale_needed = true;
}
}
}
$colors[] = $d->computeChco();
if ( $colors_needed == false &&$d->hasChco() ) {
$colors_needed = true;
}
$styles[] = $d->computeChls();
if ( $styles_needed == false &&$d->hasChls() ) {
$styles_needed = true;
}
$tmp = $d->computeChm($i);
if ( $tmp ) {
$fills[] = $tmp;
}
$legends[] = $d->getLegend();
if ( $legends_needed == false &&$d->hasCustomLegend() ) {
$legends_needed = true;
}
if ( $this->_compute_data_label ) {
$labels[] = $d->computeChl();
}
}
if ( !isset($data[0]) )
return;
$q['chd'] = $this->data_format.':'.implode($this->data_separator[$this->data_format],$data);
if ( $colors_needed ) {
$q['chco'] = implode(',',$colors);
}
if ( $styles_needed ) {
$q['chls'] = implode('|',$styles);
}
if ( $this->_compute_data_label ) {
$tmp = rtrim(implode('|',$labels),'|');
if ( $tmp ) {
$q['chl'] = $tmp;
}
}
if ( $this->scale ) {
$q['chds'] = $this->computeChds();
}
elseif ( $scale_needed &&isset($scales[0]) ) {
$q['chds'] = implode(',',$scales);
}
if ( $legends_needed ) {
$q['chdl'] = implode('|',$legends);
if ( $this->hasChdlp() ) {
$q['chdlp'] = $this->computeChdlp();
}
}
if ( isset($fills[0]) )
$q['chm'] = implode('|',$fills);
return $this;
}
protected function computeMarkers(array &$q)
{
$markers = array();
$dynamic_markers = array();
$additional_data = array();
$nb_data_series = sizeof($this->data);
$current_index = $nb_data_series;
$array = $this->markers +$this->dynamic_markers;
foreach ( $array as $m ) {
$data = $m->getData();
$index = null;
if ( $data ) {
$index = $data->getIndex();
if ( $index === null ) {
$additional_data[] = $data->computeChd($this->data_format);
$index = $current_index;
$current_index += 1;
}
}
$tmp = $m->compute($index,$this->type);
if ( $tmp === null )
continue;
if ( $m instanceof GoogleChartMarker ) {
$markers[] = $tmp;
}
else {
$dynamic_markers[] = $tmp;
}
}
if ( isset($markers[0]) ) {
$q['chm'] = (isset($q['chm']) ?$q['chm'].'|': '').implode('|',$markers);
}
if ( isset($dynamic_markers[0]) ) {
$q['chem'] = implode('|',$dynamic_markers);
}
if ( isset($additional_data[0]) ) {
$q['chd'] = $this->data_format.$nb_data_series.substr($q['chd'],1).$this->data_separator[$this->data_format].implode($this->data_separator[$this->data_format],$additional_data);
}
}
protected function computeAxes(array &$q)
{
$axes = array();
$labels = array();
$ranges = array();
$tick_marks = array();
$styles = array();
$label_positions = array();
foreach ( $this->axes as $i =>$a ) {
$axes[] = $a->getName();
if ( $a->hasCustomLabels() ) {
$labels[] = sprintf($a->getLabels(),$i);
}
$tmp = $a->getRange();
if ( $tmp !== null ) {
$ranges[] = sprintf($tmp,$i);
}
$tmp = $a->getTickMarks();
if ( $tmp !== null ) {
$tick_marks[] = sprintf($tmp,$i);
}
$tmp = $a->computeChxs($i,$this->type);
if ( $tmp !== null ) {
$styles[] = $tmp;
}
if ( $a->hasChxp() ) {
$label_positions[] = $a->computeChxp($i);
}
}
if ( isset($axes[0]) ) {
$q['chxt'] = implode(',',$axes);
if ( isset($labels[0]) ) {
$q['chxl'] = implode('|',$labels);
}
if ( isset($ranges[0]) ) {
$q['chxr'] = implode('|',$ranges);
}
if ( isset($tick_marks[0]) ) {
$q['chxtc'] = implode('|',$tick_marks);
}
if ( isset($styles[0]) ) {
$q['chxs'] = implode('|',$styles);
}
if ( isset($label_positions[0]) ) {
$q['chxp'] = implode('|',$label_positions);
}
}
return $this;
}
}

?>