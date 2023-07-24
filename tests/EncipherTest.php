<?php

include_once './../src/Encipher/Decipher.php';
include_once './../src/Encipher/Encipher.php';
include_once './Function.php';

use ZX\Encipher\Encipher;
use ZX\Encipher\Decipher;

$original = './original'; //待加密的文件目录
$encoded = './encoded';  //加密后的文件目录
$encipher = new Encipher($original, $encoded);

/**
 * 设置加密模式 false = 低级模式; true = 高级模式
 * 低级模式不使用eval函数
 * 高级模式使用了eval函数 
 */
$encipher->advancedEncryption = false;

$encipher->encode();
p();
