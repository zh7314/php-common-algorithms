<?php

include_once './../src/Algorithm/BitMap.php';
include_once './../src/Algorithm/Hash.php';


include_once './Function.php';

use ZX\Algorithm\BitMap;
use ZX\Algorithm\Hash;

$data = [];
for ($index = 0; $index < 1000; $index++) {
//    $data[] = uniqid(microtime(true), true);
    $data[] = $index;
}
//注意：64位使用crc32算法,32位可能出现负整数
foreach ($data as $k => $v) {
    $v = crc32($v);
//    $v= Hash::BKDRHash($v);
    BitMap::addValue($v);
}

$rr = BitMap::exits(crc32(16));

if ($rr) {
    p('ok');
} else {
    p('no');
}
