<?php

include_once './../src/XXTEA/XXTEA.php';
include_once './Function.php';

use ZX\XXTEA\XXTEA;

$str = "Hello World! 你好，中国🇨🇳！";
$key = "1234567890";
$encrypt = XXTEA::encrypt($str, $key);
p($encrypt);

$decrypt = XXTEA::decrypt($encrypt, $key);
p($decrypt);
