<?php

class CaipiaoNumber extends WebBase{

    public final function queryNextPeriod() {
        $actionNo=$this->getGameNo(3);
        return $actionNo;
    }

    public final function patternStatistics() {

    }
}
?>