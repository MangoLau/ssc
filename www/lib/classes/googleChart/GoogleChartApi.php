<?php

class GoogleChartApi
{
const BASE_URL = 'http://chart.apis.google.com/chart';
const GET = 0;
const POST = 1;
protected $parameters = array();
protected $query_method = self::POST;
public function __set($name,$value)
{
$this->parameters[$name] = $value;
}
public function __get($name)
{
return isset($this->parameters[$name]) ?$this->parameters[$name] : null;
}
public function __unset($name)
{
unset($this->parameters[$name]);
}
protected function computeQuery()
{
return $this->parameters;
}
public function setQueryMethod($method)
{
if ( $method !== self::POST &&$method !== self::GET )
throw new Exception(sprintf(
'Query method must be either GoogleChart::POST or GoogleChart::GET, "%s" given.',
$method
));
$this->query_method = $method;
return $this;
}
public function getUrl($escape_amp = true)
{
$q = $this->computeQuery();
$url = self::BASE_URL.'?'.http_build_query($q,'',$escape_amp?'&amp;': '&');
return $url;
}
public function getQuery()
{
return $this->computeQuery();
}
public function toHtml()
{
$str = sprintf(
'<img src="%s" alt="" />',
$this->getUrl()
);
return $str;
}
public function getImage()
{
$image = null;
switch ( $this->query_method ) {
case self::GET:
$url = $this->getUrl(false);
$image = file_get_contents($url);
break;
case self::POST:
$image = self::post($this->computeQuery());
break;
}
return $image;
}
public function getImageGD()
{
return imagecreatefromstring($this->getImage());
}
public function __toString()
{
try {
return (string) $this->getImage();
}catch (Exception $e) {
trigger_error($e->getMessage(),E_USER_ERROR);
}
}
static public function post(array $q = array())
{
$context = stream_context_create(array(
'http'=>array(
'method'=>'POST',
'header'=>'Content-type: application/x-www-form-urlencoded',
'content'=>http_build_query($q,'','&')
)
));
return file_get_contents(self::BASE_URL,false,$context);
}
static public function validColor($color)
{
return preg_match('/^[0-9A-F]{6}$/i',$color);
}
public function getValidationUrl($escape_amp = true)
{
$q = $this->computeQuery();
$q['chof'] = 'validate';
$url = self::BASE_URL.'?'.http_build_query($q,'',$escape_amp?'&amp;':'&');
return $url;
}
public function validate()
{
$q = $this->computeQuery();
$q['chof'] = 'validate';
return self::post($q);
}
}
?>