<?php
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

var_export(returnStarAll('fiveStar'));