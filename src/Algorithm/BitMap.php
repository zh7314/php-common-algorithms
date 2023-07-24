<?php

namespace ZX\Algorithm;

/*
 * bitmap算法
 */

final class BitMap {

    //int 位数
    private static $phpIntSize = PHP_INT_SIZE;
    //int最大值  Usually int(2147483647) in 32 bit systems and int(9223372036854775807) in 64 bit systems. Available since PHP 5.0.5
    private static $phpIntMax = PHP_INT_MAX;
    //最大位数64位 1 << 6 32位 1 << 5
    private static $max = (1 << 6 ) - 1;
    //储存数据的变量
    private static $data = [];

    public static function addValue(int $n) {
        //商
        $row = $n >> 6;
        //余数
        $index = $n % self::$max;
        //或运算保证占位不被覆盖
        self::$data[$row] |= 1 << $index;
    }

    // 判断所在的bit为是否为1
    public static function exits(int $n) {
        $row = $n >> 6;
        $index = $n % self::$max;

        $result = self::$data[$row] & (1 << $index);
//        p($result);
        return $result != 0;
    }

    public static function getData() {
        return self::$data;
    }

}
