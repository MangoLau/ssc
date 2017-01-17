<?php

require_once 'GoogleChart.php';
class GooglePieChart extends GoogleChart
{
protected $_compute_data_label = true;
protected $rotation = 0;
protected $c = null;
public function __construct($type,$width,$height)
{
parent::__construct($type,$width,$height);
$this->setScale(0,100);
}
public function setRotation($rotation)
{
$this->rotation = $rotation;
}
public function setRotationDegree($rotation)
{
$this->rotation = deg2rad($rotation);
}
protected function compute(array &$q)
{
if ( $this->rotation ) {
$q['chp'] = $this->rotation;
}
parent::compute($q);
unset($q['chds']);
}
}

?>