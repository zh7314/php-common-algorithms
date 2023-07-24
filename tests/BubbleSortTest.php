<?php

include_once './../src/Algorithm/BubbleSort.php';
include_once './Function.php';

use ZX\Algorithm\BubbleSort;

$arr = [6, 4, 7, 2, 9, 8, 1, 6, 4, 7, 2, 9, 8, 1];

$r1 = BubbleSort::BasicBubbleSort($arr);
$r2 = BubbleSort::BetterBubbleSort($arr);
p($r1);
p($r2);
