<?php

namespace ZX\MD5;

class MD5Tool {

    /** S11-S44原本是一个 4 * 4 的矩阵，在C实现中是用#define 实现的，
     * 这里作为类的常量表示，在各种对象间共享 
     */
    const S11 = 7;
    const S12 = 12;
    const S13 = 17;
    const S14 = 22;
    const S21 = 5;
    const S22 = 9;
    const S23 = 14;
    const S24 = 20;
    const S31 = 4;
    const S32 = 11;
    const S33 = 16;
    const S34 = 23;
    const S41 = 6;
    const S42 = 10;
    const S43 = 15;
    const S44 = 21;

    /** F, G, H ,I 是4个基本的MD5函数，
     * 在C实现中，一般是用宏实现，这里我们以类方法的形式给出 
     */
    public static function F($x, $y, $z) {
        return ($x & $y) | ((~$x) & $z);
    }

    public static function G($x, $y, $z) {
        return ($x & $z) | ($y & (~$z));
    }

    public static function H($x, $y, $z) {
        return $x ^ $y ^ $z;
    }

    public static function I($x, $y, $z) {
        return $y ^ ($x | (~$z));
    }

    /**
     * 左移N位
     * @param type $x
     * @param type $n
     * @return type 
     */
    public static function ROTATE_LEFT($x, $n) {
        return ($x << $n) | self::URShift($x, (32 - $n));
    }

    /**
     * PHP无符号右移
     * @param type $x
     * @param type $bits
     * @return type 
     */
    public static function URShift($x, $bits) {
        /** 转换成代表二进制数字的字符串 */
        $bin = decbin($x);
        $len = strlen($bin);

        /** 字符串长度超出则截取底32位，长度不够，则填充高位为0到32位  */
        if ($len > 32) {
            $bin = substr($bin, $len - 32, 32);
        } elseif ($len < 32) {
            $bin = str_pad($bin, 32, '0', STR_PAD_LEFT);
        }

        /** 取出要移动的位数，并在左边填充0  */
        return bindec(str_pad(substr($bin, 0, 32 - $bits), 32, '0', STR_PAD_LEFT));
    }

    /**
     * FF,GG,HH和II将调用F,G,H,I进行近一步变换
     * 其中FF,GG,HH和II分别为四轮转移调用
     * 
     * 注意: 在PHP中，这里使用了引用返回，第一个元素
     * 并且所有的返回值必须执行intval强制转换为整形，否则最终可能会被PHP自动转换
     */
    public static function FF(&$a, $b, $c, $d, $x, $s, $ac) {
        $a += self::F($b, $c, $d) + ($x) + $ac;
        $a = self::ROTATE_LEFT($a, $s);
        $a = intval($a + $b);
    }

    public static function GG(&$a, $b, $c, $d, $x, $s, $ac) {
        $a += self::G($b, $c, $d) + ($x) + $ac;
        $a = self::ROTATE_LEFT($a, $s);
        $a = intval($a + $b);
    }

    public static function HH(&$a, $b, $c, $d, $x, $s, $ac) {
        $a += self::H($b, $c, $d) + ($x) + $ac;
        $a = self::ROTATE_LEFT($a, $s);
        $a = intval($a + $b);
    }

    public static function II(&$a, $b, $c, $d, $x, $s, $ac) {
        $a += self::I($b, $c, $d) + ($x) + $ac;
        $a = self::ROTATE_LEFT($a, $s);
        $a = intval($a + $b);
    }

}
