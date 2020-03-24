<?php

function solution($S) {
    $arrayPhoneBill = explode(PHP_EOL, $S);
    $phoneBillByMinute = [];
    $toPay= 0;
    foreach ($arrayPhoneBill as $apb){
        $apb  = trim($apb);
        $timeAndPhone = explode(",", $apb);
        if(isset($phoneBillByMinute[$timeAndPhone[1]])){
            $phoneBillByMinute[$timeAndPhone[1]] += minutesCalled($timeAndPhone[0]);
        }else{
            $phoneBillByMinute[$timeAndPhone[1]] = minutesCalled($timeAndPhone[0]);
        }

    }

    $firstKey=0;
    arsort ($phoneBillByMinute);
    foreach ($phoneBillByMinute as $key => $min){
        $firstKey = $key;
        echo $firstKey.PHP_EOL;
        break;
    }

    foreach ($phoneBillByMinute as $key => $min){
        if($key != $firstKey){
            if($min < 5){
                $toPay += ($min*60)*3;
            }else{
                $toPay += $min*150;
            }
        }
    }

    return $toPay;
}

function minutesCalled($timestamp){
    $time = explode(":",$timestamp);
    $hourToMinute = $time[0]*60;
    $minute = $time[1] + $hourToMinute;
    $second = $time[2];
    if($second > 0){
        $minute += 1;
    }

    return $minute;
}
