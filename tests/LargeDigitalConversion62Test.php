<?php

include_once './../src/Algorithm/LargeDigitalConversion62.php';
include_once './Function.php';

use ZX\Algorithm\LargeDigitalConversion62;

//$rt = '123213236472364632912361269246916439647232131232132132132132132132143243252542321321321312687448236874';
$rt = '1232132364723646329123612692469164396472321';
p($rt);
$rr = LargeDigitalConversion62::from10To62($rt);
p($rr);

$re = LargeDigitalConversion62::from62To10($rr);
p($re);
