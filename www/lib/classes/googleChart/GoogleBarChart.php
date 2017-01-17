<?php

require_once 'GoogleChart.php';
class GoogleBarChart extends GoogleChart
{
protected $bar_width = 'a';
protected $bar_spacing = null;
public function setBarWidth($width)
{
$this->bar_width = $width;
return $this;
}
public function setBarSpacing($space)
{
$this->bar_spacing = $space;
return $this;
}
public function setGroupSpacing($space)
{
}
public function computeChbh()
{
$str = $this->bar_width;
if ( $this->bar_spacing ) {
$str .= ','.$this->bar_spacing;
}
return $str;
}
protected function compute(array &$q)
{
$q['chbh'] = $this->computeChbh();
parent::compute($q);
}
}
?>