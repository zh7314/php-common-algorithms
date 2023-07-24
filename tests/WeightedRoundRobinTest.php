<?php

include_once './../src/Algorithm/WeightedRoundRobin.php';
include_once './Function.php';

use ZX\Algorithm\WeightedRoundRobin;

$arr = array(
    array('id' => 'A', 'weight' => 2),
    array('id' => 'B', 'weight' => 3),
    array('id' => 'C', 'weight' => 6),
    array('id' => 'D', 'weight' => 6),
    array('id' => 'E', 'weight' => 4),
);
$weight = new WeightedRoundRobin($arr);

for ($j = 0; $j < 100; $j++) {
    $weightInfo = $weight->getWeight();
//    print_r($weightInfo);
    echo $weightInfo['id'] . '----------------------weight:' . $weightInfo['weight'] . '<br/>';
    if ($weightInfo['id'] == 'A') {
        $a++;
    }
    if ($weightInfo['id'] == 'B') {
        $b++;
    }
    if ($weightInfo['id'] == 'C') {
        $c++;
    }
    if ($weightInfo['id'] == 'D') {
        $d++;
    }
    if ($weightInfo['id'] == 'E') {
        $e++;
    }
}