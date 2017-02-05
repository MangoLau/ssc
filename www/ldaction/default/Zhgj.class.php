<?php

class Zhgj extends WebLoginBase{

    //二星做号
    public final function two() {
        $this->display('ssc/two.php');
    }

    //三星做号
    public final function three() {
        $this->display('ssc/three.php');
    }

    //四星做号
    public final function four() {
        $this->display('ssc/fiveStar.php');
    }

    //五星做号
    public final function five() {
        $this->display('ssc/five.php');
    }

    public final function zhgjGenerateNum() {
        $result = array();
        $zhgjType = trim($_POST['zhgjType']);
        $danMaNum = $_POST['danMaNum'];
        $danMaKeepOrDel = $_POST['danMaKeepOrDel'];
        $sumValueKeepOrDel = $_POST['sumValueKeepOrDel'];
        $bigSmallKeepOrDel = $_POST['bigSmallKeepOrDel'];
        $evenOddKeepOrDel = $_POST['evenOddKeepOrDel'];
        $primeCompositeKeepOrDel = $_POST['primeCompositeKeepOrDel'];
        $approachNum = $_POST['approachNum'];
        $approachKeepOrDel = $_POST['approachKeepOrDel'];
        $bigSmallPercent = $_POST['bigSmallPercent'];
        $bigSmallPercentKeepOrDel = $_POST['bigSmallPercentKeepOrDel'];
        $oddEvenPercent = $_POST['oddEvenPercent'];
        $oddEvenPercentKeepOrDel = $_POST['oddEvenPercentKeepOrDel'];
        $primeCompositePercent = $_POST['primeCompositePercent'];
        $primeCompositePercentKeepOrDel = $_POST['primeCompositePercentKeepOrDel'];
        $shangShan = $_POST['shangShan'];
        $shangShanKeepOrDel = $_POST['shangShanKeepOrDel'];
        $xiaShan = $_POST['xiaShan'];
        $xiaShanKeepOrDel = $_POST['xiaShanKeepOrDel'];
        $consecutive = $_POST['consecutive'];
        $abcde = $_POST['abcde'];
        $abcdeKeepOrDel = $_POST['abcdeKeepOrDel'];
        $minNum = $_POST['minNum'];
        $minNumKeepOrDel = $_POST['minNumKeepOrDel'];
        $maxNum = $_POST['maxNum'];
        $maxNumKeepOrDel = $_POST['maxNumKeepOrDel'];
        $acValue = $_POST['acValue'];
        $acValueKeepOrDel = $_POST['acValueKeepOrDel'];
        $convex = $_POST['convex'];
        $convexKeepOrDel = $_POST['convexKeepOrDel'];
        $sunken = $_POST['sunken'];
        $sunkenKeepOrDel = $_POST['sunkenKeepOrDel'];
        $nPattern = $_POST['nPattern'];
        $nPatternKeepOrDel = $_POST['nPatternKeepOrDel'];
        $notNPattern = $_POST['notNPattern'];
        $notNPatternKeepOrDel = $_POST['notNPatternKeepOrDel'];
        $removeBaozi = $_POST['removeBaozi'];
        $removeSanHao = $_POST['removeSanHao'];
        $removeDuizi = $_POST['removeDuizi'];
        $removeSanTonghao = $_POST['removeSanTonghao'];
        $removeTwoDuizi = $_POST['removeTwoDuizi'];
        $removeGroupThree = $_POST['removeGroupThree'];
        $removeGroupSix = $_POST['removeGroupSix'];
        $bigNum = $_POST['bigNum'];
        $bigNumKeepOrDel = $_POST['bigNumKeepOrDel'];
        $primeNum = $_POST['primeNum'];
        $primeNumKeepOrDel = $_POST['primeNumKeepOrDel'];
        $oddNum = $_POST['oddNum'];
        $oddNumKeepOrDel = $_POST['oddNumKeepOrDel'];
        $chuDanNumKeepOrDel = $_POST['chuDanNumKeepOrDel'];
        $chuDanNum = $_POST['chuDanNum'];
        $danZuNum = $_POST['danZuNum'];
        $danZuNumCount = $_POST['danZuNumCount'];
        $groupBasicNum = $_POST['groupBasicNum'];
        $groupNumType = $_POST['groupNumType'];
        $zuXuanType = $_POST['zuXuanType'];
        $specilFirstNum = $_POST['specilFirstNum'];
        $specilSecondNum = $_POST['specilSecondNum'];
		if($zhgjType == 'twoStar')
        $result['success'] = false;
		$numArr = self::_returnDwsNums($zhgjType);
		$resultSet = self::_dws($numArr);//定位杀
		if($_POST['endValueNum'] !=='' && $_POST['endValueKeepOrDel'] == 'keep') {//和尾选
			$endValueArr = explode(',', $_POST['endValueNum']);
			$hwx = self::_hwx($endValueArr, $zhgjType);
			$resultSet = array_intersect($resultSet, $hwx);
		}
		if($_POST['spanNum'] !== '' && $_POST['spanKeepOrDel']) {//跨度选
			$spanNumArr = explode(',', $_POST['spanNum']);
			$kdx = self::_kdx($spanNumArr, $zhgjType);
			$resultSet = array_intersect($resultSet, $kdx);
		}
		if($_POST['danMaNum'] !== '' && $_POST['danMaKeepOrDel'] == 'keep') {//胆码选
			$danMaArr = explode(',', $_POST['danMaNum']);
			$dmx = self::_dmx($danMaArr,$zhgjType,$_POST['chuDanNum']);
			$resultSet = array_intersect($resultSet, $dmx);
		}
		if($_POST['consecutive'] == 1) {//不连

		}
		if($_POST['consecutive'] == 2) {//2连

		}
		if($_POST['sumValueNum'] !== '') {//和值杀
			$sumValueNumArr = explode(',', $_POST['sumValueNum']);
			$hzs = self::_hzx($sumValueNumArr, $zhgjType);
			$resultSet = array_intersect($resultSet, $hzs);
		}
		if(!empty($_POST['bigSmallNum'])) {//杀大小
			$bigSmallNum = explode(',', $_POST['bigSmallNum']);
			$shadaxiao = self::_shadaxiao($bigSmallNum, $zhgjType);
			$resultSet = array_intersect($resultSet, $shadaxiao);
		}
		if(!empty($_POST['evenOddNum'])) {//杀奇偶
			$evenOddNum = explode(',', $_POST['evenOddNum']);
			$shajiou = self::_shajiou($evenOddNum, $zhgjType);
			$resultSet = array_intersect($resultSet, $shajiou);
		}
		if(!empty($_POST['primeCompositeNum'])) {//杀质合
			$primeCompositeNum = explode(',', $_POST['primeCompositeNum']);
			$shazhihe = self::_shazhihe($primeCompositeNum, $zhgjType);
			$resultSet = array_intersect($resultSet, $shazhihe);
		}
		if($resultSet !== false) {
			$result['resultSet'] = $resultSet;
			$result['success'] = true;
		}
        return $result;
    }

	/**
	 * 返回定位杀数组
	 * @param $zhgjType
	 * @return array
	 */
	private function _returnDwsNums($zhgjType) {
		$firstArr = explode(',', $_POST['firstNum']);
		$secondArr = explode(',', $_POST['secondNum']);
		$thirdArr = explode(',', $_POST['thirdNum']);
		$fourthArr = explode(',', $_POST['fourthNum']);
		$fifthArr = explode(',', $_POST['fifthNum']);
		$firstArr = empty($firstArr) ? range(0,9) : $firstArr;
		$secondArr = empty($secondArr) ? range(0,9) : $secondArr;
		$thirdArr = empty($thirdArr) ? range(0,9) : $thirdArr;
		$fourthArr = empty($fourthArr) ? range(0,9) : $fourthArr;
		$fifthArr = empty($fifthArr) ? range(0,9) : $fifthArr;
		$return = array();
		switch($zhgjType) {
			case 'twoStar':
				$return = array($firstArr, $secondArr);
				break;
			case 'threeSatr':
				$return = array($firstArr, $secondArr, $thirdArr);
				break;
			case 'fourStar':
				$return = array($firstArr, $secondArr, $thirdArr, $fourthArr);
				break;
			case 'fiveStar':
				$return = array($firstArr, $secondArr, $thirdArr, $fourthArr, $fifthArr);
				break;
			default:
				break;
		}
		return $return;
	}

    /**
     * 转为组选
     * @return mixed
     */
    public final function turnZuXuan() {
        $numbers = $_POST['numbers'];
        $numbersArr = explode(' ', $numbers);
        $resultSet = array();
        foreach($numbersArr as $number) {
            $len = mb_strlen($number);
            if($len<1) continue;
            $numberArr = array();
            for($i = 0; $i < $len; $i++){
                $numberArr[] = $number[$i];
            }
            sort($numberArr);
            $resultSet[] = implode('',$numberArr);
        }
        $resultSet = array_unique($resultSet);
        sort($resultSet);
        $return['success'] = true;
        $return['data'] = $resultSet;
        return $return;
    }

    /**
     * 反选
     * @return mixed
     */
    public final function reverse() {
        $numbers = $_POST['numbers'];
        $numbersArr = explode(',', $numbers);
        $reverseType = $_POST['reverseType'];
        $return['success'] = false;
        $tempArr = self::_returnStarAll($reverseType);
        if($tempArr !== false) {
            $return['success'] = true;
            $return['data'] = array_diff($tempArr, $numbersArr);
        }
        return $return;
    }

    /**
     * 定位杀
     * @param $numArr
     * @return array|bool
     */
    private function _dws($numArr) {
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

    /**
     * 和尾选
     * @param array $numArr
     * @param string $zhgjType
     * @return array
     */
    private function _hwx($numArr=array(), $zhgjType) {
        $numbersArr = self::_returnStarAll($zhgjType);
        $return = array();
        foreach($numbersArr as $number) {
            $sumMod = round(self::_returnNumberSelfSum($number) % 10);
            if(in_array($sumMod, $numArr)) {
                $return[] = $number;
            }
        }
        return $return;
    }

    /**
     * 跨度选
     * @param array $numArr
     * @param $zhgjType
     * @return array
     */
    private function _kdx($numArr=array(), $zhgjType) {
        $numbersArr = self::_returnStarAll($zhgjType);
        $return = array();
        foreach($numbersArr as $number) {
            $span = self::_returnNumberSelfSpan($number);
            if(in_array($span, $numArr)) {
                $return[] = $number;
            }
        }
        return $return;
    }

    private function _dmx($numArr=array(), $zhghType, $chudanNum) {
        $return = array();
        return $return;
    }

    /**
     * 和值杀
     * @param array $numArr
     * @param string $zhgjType
     * @return array
     */
    private function _hzs($numArr=array(), $zhgjType='') {
        $numbersArr = self::_returnStarAll($zhgjType);
        $return = array();
        foreach($numbersArr as $number) {
            $sumTemp = self::_returnNumberSelfSum($number);
            if(in_array($sumTemp, $numArr)) {
                $return[] = $number;
            }
        }
        return $return;
    }

	/**
	 * 和值选
	 * @param array $numArr
	 * @param string $zhgjType
	 * @return array
	 */
	private function _hzx($numArr=array(), $zhgjType='') {
		$return = array();
		foreach($numArr as $num) {
			$return = array_merge($return, CFG($zhgjType,'hzx.'.$num));
		}
		return $return;
	}

	/**
	 * 大小选
	 * @param array $arr
	 * @param string $zhgjType
	 * @return array
	 */
	private function _daxiaoxuan($arr=array(), $zhgjType='') {
		$return = array();
		foreach($arr as $v) {
			$return = array_merge($return, CFG($zhgjType.'dx',$v));
		}
		return $return;
	}

	/**
	 * 杀大小
	 * @param array $arr
	 * @param string $zhgjType
	 * @return array
	 */
	private function _shadaxiao($arr=array(), $zhgjType='') {
		$arr = getArrChinese2Pinyin($arr);
		$all = self::_returnStarAll($zhgjType);
		$daxiaoxuan = self::_daxiaoxuan($arr, $zhgjType);
		$return = array_diff($all, $daxiaoxuan);
		return $return;
	}

	/**
	 * 奇偶选
	 * @param array $arr
	 * @param string $zhgjType
	 * @return array
	 */
	private function _jiouxuan($arr=array(), $zhgjType='') {
		$return = array();
		foreach($arr as $v) {
			$return = array_merge($return, CFG($zhgjType.'jo',$v));
		}
		return $return;
	}

	/**
	 * 杀奇偶
	 * @param array $arr
	 * @param string $zhgjType
	 * @return array
	 */
	private function _shajiou($arr=array(), $zhgjType='') {
		$arr = getArrChinese2Pinyin($arr);
		$all = self::_returnStarAll($zhgjType);
		$jiouxuan = self::_jiouxuan($arr, $zhgjType);
		$return = array_diff($all, $jiouxuan);
		return $return;
	}

	/**
	 * 质合选
	 * @param array $arr
	 * @param string $zhgjType
	 * @return array
	 */
	private function _zhihexuan($arr=array(), $zhgjType='') {
		$return = array();
		foreach($arr as $v) {
			$return = array_merge($return, CFG($zhgjType.'zh',$v));
		}
		return $return;
	}

	/**
	 * 杀质合
	 * @param array $arr
	 * @param string $zhgjType
	 * @return array
	 */
	private function _shazhihe($arr=array(), $zhgjType='') {
		$arr = getArrChinese2Pinyin($arr);
		$all = self::_returnStarAll($zhgjType);
		$zhihexuan = self::_zhihexuan($arr, $zhgjType);
		$return = array_diff($all, $zhihexuan);
		return $return;
	}

    /**
     * 返回星数类型全部的
     * @param $type
     * @return array|bool
     */
    private function _returnStarAll($type) {
        switch($type) {
            case 'twoStar':
            case 'threeStar':
            case 'fourStar':
            case 'fiveStar':
			$result = CFG('starAll',$type);
				break;
            default:
                $result = false;
                break;
        }
        return $result;
    }

    /**
     * 返回数字所有位数之和
     * @param $number
     * @return int
     */
    private function _returnNumberSelfSum($number='') {
        $number = strval($number);
        $len = mb_strlen($number);
        if($len<1) return $number;
        $sum = 0;
        for($i = 0; $i < $len; $i++){
            $sum += $number[$i];
        }
        return $sum;
    }

    /**
     * 返回数字位数间最大差值
     * @param string $number
     * @return int|string
     */
    private function _returnNumberSelfSpan($number='') {
        $number = strval($number);
        $len = mb_strlen($number);
        if($len<1) return $number;
        $nums = array();
        for($i = 0; $i < $len; $i++){
            $nums[] = $number[$i];
        }
        $span = (int)abs(max($nums) - min($nums));
        return $span;
    }
}
?>