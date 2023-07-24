<?php

include_once './../src/Algorithm/BubbleSort.php';
include_once './../src/DataStructure/BinarySearch.php';

include_once './Function.php';

use ZX\DataStructure\BinarySearch;
use ZX\Algorithm\BubbleSort;

$arr = [16, 24, 37, 42, 59, 68, 71, 86, 94, 97, 42, 69, 18, 11];

$rr = BubbleSort::BetterBubbleSort($arr);
p($rr);
$rr1 = BinarySearch::BasicBinarySearch($rr, 37);
pp($rr1);
