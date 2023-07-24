<?php

include_once './../src/MD5/MD5.php';
include_once './../src/MD5/MD5Tool.php';
include_once './Function.php';

use ZX\MD5\MD5;
use ZX\MD5\MD5Tool;

$str = "12";
$md5 = new MD5($str);
p($md5->getDigist());
/**
 * 注意：虽然实现了，但是和php版本的结果不一样
 */
p(md5($str));
