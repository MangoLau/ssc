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
$numsArr = array(
	'd' => array(5,6,7,8,9),
	'x' => array(0,1,2,3,4),
	'z' => array(2,3,5,7),//质数
	'h' => array(4,6,8,9),//合数
	'j' => array(1,3,5,7,9),//奇数
	'o' => array(0,2,4,6,8),//偶数
);
$arr = array();
/*$fiveSet = array(
	'daxiao' => array(
		'ddddd',
		'ddddx',
		'dddxd',
		'dddxx',
		'ddxdd',
		'ddxdx',
		'ddxxd',
		'ddxxx',
		'dxddd',
		'dxddx',
		'dxdxd',
		'dxdxx',
		'dxxdd',
		'dxxdx',
		'dxxxd',
		'dxxxx',
		'xdddd',
		'xdddx',
		'xddxd',
		'xddxx',
		'xdxdd',
		'xdxdx',
		'xdxxd',
		'xdxxx',
		'xxddd',
		'xxddx',
		'xxdxd',
		'xxdxx',
		'xxxdd',
		'xxxdx',
		'xxxxd',
		'xxxxx',
	),
	'zhihe' => array(
		'zzzzz',
		'zzzzh',
		'zzzhz',
		'zzzhh',
		'zzhzz',
		'zzhzh',
		'zzhhz',
		'zzhhh',
		'zhzzz',
		'zhzzh',
		'zhzhz',
		'zhzhh',
		'zhhzz',
		'zhhzh',
		'zhhhz',
		'zhhhh',
		'hzzzz',
		'hzzzh',
		'hzzhz',
		'hzzhh',
		'hzhzz',
		'hzhzh',
		'hzhhz',
		'hzhhh',
		'hhzzz',
		'hhzzh',
		'hhzhz',
		'hhzhh',
		'hhhzz',
		'hhhzh',
		'hhhhz',
		'hhhhh',
	),
	'jiou' => array(
		'jjjjj',
		'jjjjo',
		'jjjoj',
		'jjjoo',
		'jjojj',
		'jjojo',
		'jjooj',
		'jjooo',
		'jojjj',
		'jojjo',
		'jojoj',
		'jojoo',
		'joojj',
		'joojo',
		'joooj',
		'joooo',
		'ojjjj',
		'ojjjo',
		'ojjoj',
		'ojjoo',
		'ojojj',
		'ojojo',
		'ojooj',
		'ojooo',
		'oojjj',
		'oojjo',
		'oojoj',
		'oojoo',
		'ooojj',
		'ooojo',
		'ooooj',
		'ooooo',
	),
);
foreach($fiveSet['jiou'] as $set) {
	$arr[$set] = dws(array($numsArr[$set[4]],$numsArr[$set[3]],$numsArr[$set[2]],$numsArr[$set[1]],$numsArr[$set[0]]));
}*/

/*$fourSet = array(
	'daxiao' => array(
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
	),
	'zhihe' => array(
		'zzzz',
		'zzzh',
		'zzhz',
		'zzhh',
		'zhzz',
		'zhzh',
		'zhhz',
		'zhhh',
		'hzzz',
		'hzzh',
		'hzhz',
		'hzhh',
		'hhzz',
		'hhzh',
		'hhhz',
		'hhhh'
	),
	'jiou' => array(
		'jjjj',
		'jjjo',
		'jjoj',
		'jjoo',
		'jojj',
		'jojo',
		'jooj',
		'jooo',
		'ojjj',
		'ojjo',
		'ojoj',
		'ojoo',
		'oojj',
		'oojo',
		'oooj',
		'oooo'
	),
);
foreach($fourSet['jiou'] as $set) {
	$arr[$set] = dws(array($numsArr[$set[3]],$numsArr[$set[2]],$numsArr[$set[1]],$numsArr[$set[0]]));
}*/

/*$threeSet = array(
	'daxiao' => array(
		'ddd',
		'ddx',
		'dxd',
		'xdd',
		'dxx',
		'xdx',
		'xxd',
		'xxx'
	),
	'zhihe' => array(
		'zzz',
		'zzh',
		'zhz',
		'hzz',
		'zhh',
		'hzh',
		'hhz',
		'hhh'
	),
	'jiou' => array(
		'jjj',
		'jjo',
		'joj',
		'ojj',
		'joo',
		'ojo',
		'ooj',
		'ooo'
	),
);
foreach($threeSet['jiou'] as $set) {
	$arr[$set] = dws(array($numsArr[$set[2]],$numsArr[$set[1]],$numsArr[$set[0]]));
}*/

$twoSet = array(
	'daxiao' => array(
		'dd',
		'dx',
		'xd',
		'xx'
	),
	'zhihe' => array(
		'zz',
		'zh',
		'hz',
		'hh'
	),
	'jiou' => array(
		'jj',
		'jo',
		'oj',
		'oo'
	),
);
foreach($twoSet['zhihe'] as $set) {
	$arr[$set] = dws(array($numsArr[$set[1]],$numsArr[$set[0]]));
}
$file = 'config/two.php';
$contents = '<?php'.PHP_EOL;
$contents .= 'return ';
$contents .= var_export($arr, true);
$contents .= ';';
file_put_contents($file,$contents);
//echo $contents;
//var_export($arr);