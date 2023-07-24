<?php

include_once './../src/Algorithm/Lcs.php';

include_once './Function.php';

use ZX\Algorithm\Lcs;

$str1 = 'advantage';
$str2 = 'didactical';
//$str1 = '13455';
//$str2 = '245576';

if ($argc > 1) {
    $str1 = $argv[1];
    $str2 = $argv[2];
}

$map = []; // 存储 LCS 迭代路径
$path = []; // 存储打印路径

Lcs::lcs_map($str1, $str2, $map, $path);

echo "\nLCS 迭代路径图 MAP：<br />";

for ($i = 0; $i <= strlen($str1); $i++) {
    for ($j = 0; $j <= strlen($str2); $j++) {
        echo $map[$i][$j] . "\t";
    }
    echo "<br />";
}

echo "\nLCS 打印路径图 Path：<br />";

for ($i = 0; $i <= strlen($str1); $i++) {
    for ($j = 0; $j <= strlen($str2); $j++) {
        echo $path[$i][$j] . "\t";
    }
    echo "<br />";
}

echo "\n最长公共子序列：" .
 Lcs::LCS($str1, $str2, $path, $map[strlen($str1)][strlen($str2)]) . "\n\n";

p(Lcs::lcs1("abcbdab", "bdcaba"));
