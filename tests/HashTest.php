<?php

include_once './../src/Algorithm/Hash.php';

include_once './Function.php';

use ZX\Algorithm\Hash;

$string = 'laravalmfa111';
$len = 32;

p(Hash::JSHash($string, $len));
//有问题
//p(Hash::PJWHash($string,$len));

p(Hash::ELFHash($string, $len));

p(Hash::BKDRHash($string, $len));

p(Hash::SDBMHash($string, $len));

p(Hash::DJBHash($string, $len));

p(Hash::DEKHash($string, $len));

p(Hash::FNVHash($string, $len));



