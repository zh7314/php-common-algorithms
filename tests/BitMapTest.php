<?php

include_once './../src/Algorithm/BitMap.php';
include_once './../src/Algorithm/BitOperation.php';

include_once './Function.php';

use ZX\Algorithm\BitMap;

$arr = [0, 1, 3, 16, 42, 69, 18, 11, 99, 32421, 32423, 32525, 9999999999];
foreach ($arr as $v) {
    BitMap::addValue($v);
}
//$tt = BitMap::getData();
$rr = BitMap::exits(16);

if ($rr) {
    p('ok');
} else {
    p('no');
}

////海量数据测试，php8 的jit效果更好
//ini_set('memory_limit', '4096M');
////2000两千万数据
//for ($index = 0; $index < 100000000; $index = $index + 5) {
//    BitMap::addValue($index);
//}
//$rr = BitMap::exits(25);
//if ($rr) {
//    p('ok');
//} else {
//    p('no');
//}
//echo "内存使用峰值:",(((memory_get_peak_usage())/1024/1024).'MB'),PHP_EOL;

