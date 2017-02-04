<?php
require 'lib/functions.php';
function dws($numArr) {
    $count = count($numArr);
    $resultSet = array();
    switch($count) {
        case 5:
            foreach($numArr[0] as $first) {
                foreach($numArr[1] as $second) {
                    foreach($numArr[2] as $third) {
                        foreach($numArr[3] as $fourth) {
                            foreach($numArr[4] as $fifth) {
                                $resultSet[] = $fifth.$fourth.$third.$second.$first;
                            }
                        }
                    }
                }
            }
            break;
        case 4:
            foreach($numArr[0] as $first) {
                foreach($numArr[1] as $second) {
                    foreach($numArr[2] as $third) {
                        foreach($numArr[3] as $fourth) {
                            $resultSet[] = $fourth.$third.$second.$first;
                        }
                    }
                }
            }
            break;
        case 3:
            foreach($numArr[0] as $first) {
                foreach($numArr[1] as $second) {
                    foreach($numArr[2] as $third) {
                        $resultSet[] = $third.$second.$first;
                    }
                }
            }
            break;
        case 2:
            foreach($numArr[0] as $first) {
                foreach($numArr[1] as $second) {
                    $resultSet[] = $second.$first;
                }
            }
            break;
        default:
            $resultSet = false;
            break;
    }
    return $resultSet;
}


function returnStarAll($type) {
    $firstArr = $secondArr = $thirdArr = $fourthArr = $fifthArr = range(0,9);
    switch($type) {
        case 'twoStar':
            $result = dws(array($firstArr, $secondArr));
            break;
        case 'threeStar':
            $result = dws(array($firstArr, $secondArr, $thirdArr));
            break;
        case 'fourStar':
            $result = dws(array($firstArr, $secondArr, $thirdArr, $fourthArr));
            break;
        case 'fiveStar':
            $result = dws(array($firstArr, $secondArr, $thirdArr, $fourthArr, $fifthArr));
            break;
        default:
            $result = false;
            break;
    }
    return $result;
}

function returnNumberSelfSum($number='') {
	$number = strval($number);
	$len = mb_strlen($number);
	if($len<1) return $number;
	$sum = 0;
	for($i = 0; $i < $len; $i++){
		$sum += $number[$i];
	}
	return $sum;
}

function hzs($numArr=array(), $zhgjType='') {
	$numbersArr = CFG('starAll',$zhgjType);
	$return = array();
	foreach($numbersArr as $number) {
		$sumTemp = returnNumberSelfSum($number);
		if(in_array($sumTemp, $numArr)) {
			$return[] = $number;
		}
	}
	return $return;
}

$bigNums = array(5,6,7,8,9);
$smallNums = array(0,1,2,3,4);
$dxNums = array(
	'd' => array(5,6,7,8,9),
	'x' => array(0,1,2,3,4),
);
$fourSet = array(
	'dddd',
	'dddx',
	'ddxd',
	'ddxx',
	'dxdd',
	'dxdx',
	'dxxd',
	'dxxx',
	'xddd',
	'xddx',
	'xdxd',
	'xdxx',
	'xxdd',
	'xxdx',
	'xxxd',
	'xxxx'
);

foreach($fourSet as $num) {

}

$file = 'config/two.php';
$contents = '<?php'.PHP_EOL;
$contents .= 'return array('.PHP_EOL.'\'xxxxx\' => ';
	$arr = dws(array($first,$second,$third,$fourth));
$contents .= var_export($arr, true);
$contents .= ','.PHP_EOL.');';
file_put_contents($file,$contents);
//echo $contents;
//var_export($arr);