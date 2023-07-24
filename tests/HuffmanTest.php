<?php

include_once './../src/Huffman/Huffman.php';
include_once './../src/Algorithm/GlobalUniqueId.php';
include_once './Function.php';

use ZX\Huffman\Huffman;
use ZX\Algorithm\GlobalUniqueId;

//phpinfo();

$r1 = GlobalUniqueId::CreateBasicsUid(1, 1);

p($r1 . $r1);

$Huffman = new Huffman();

$tt = $Huffman->encode($r1 . $r1);
pp($tt);
