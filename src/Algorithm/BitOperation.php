<?php

namespace ZX\Algorithm;

/*
 * 位运算学习笔记
 * 
 * 1，php所有的数都是有符号的，无法指定是否是无符号的 unsign
 * 2.计算机底层运算都是补码运算的
 * 3，0反码，补码都是0
 * 4，正数的反码，补码全都一样
 * 5，二进制的最高位是符号位，0是正数，1是负数
 * 6，负数的反码符号位不变，其他未取反
 * 7，负数的补码等于反码+1
 * 8，负数（取反）=》反码 +1 =》补码
 * 9，补码-1=》反码（取反）=》负数
 * 10，右移 低位溢出，符号位不变 ，并用符号位补溢出的到位
 * 11，符号位不变 低位补0
 * 
 * 32位的1表示是     31个0+1
 * 64位的1表示是    63个0+1
 * 参考 http://php.net/manual/zh/function.decbin.php
 * 测试：  print_r(decbin(-50))  32 位
 * 
  $a & $b	And（按位与）	将把 $a 和 $b 中都为 1 的位设为 1。
  $a | $b	Or（按位或）	将把 $a 和 $b 中任何一个为 1 的位设为 1。
  $a ^ $b	Xor（按位异或）	将把 $a 和 $b 中一个为 1 另一个为 0 的位设为 1。
  ~ $a	Not（按位取反）	将 $a 中为 0 的位设为 1，反之亦然。
  $a << $b	Shift left（左移）	将 $a 中的位向左移动 $b 次（每一次移动都表示“乘以 2”）。
  $a >> $b	Shift right（右移）	将 $a 中的位向右移动 $b 次（每一次移动都表示“除以 2”）。

  ⋅⋅右移 >>：将二进制进行右移，低位丢掉，高位补零 符号位不变 。
  ⋅⋅左移 <<：将二进制进行左移，低位补零，高位丢掉 符号位不变 。
  ----------------------------------------------------------------------------------------------------------------------
  &
  按位与
  如果两个相应的二进制位都为1，则该位的结果值为1，否则为0
  |
  按位或
  两个相应的二进制位中只要有一个为1，该位的结果值为1
  ^
  按位异或
  若参加运算的两个二进制位值相同则为0，否则为1
  ~
  取反
  ~是一元运算符，用来对一个二进制数按位取反，即将0变1，将1变0
  <<
  左移
  用来将一个数的各二进制位全部左移N位，右补0
  >>
  右移
  将一个数的各二进制位右移N位，移到右端的低位被舍弃，对于无符号数， 高位补0

  要使用八进制表达，数字前必须加上 0（零）。要使用十六进制表达，数字前必须加上 0x。要使用二进制表达，数字前必须加上 0b。
  Example #1 整数文字表达
  $a = 1234; // 十进制数
  $a = -123; // 负数
  $a = 0123; // 八进制数 (等于十进制 83)
  $a = 0x1A; // 十六进制数 (等于十进制 26)
  $a = 0b11111111; // 二进制数字 (等于十进制 255)
 *
 * printf() - 输出格式化字符串, using %b, %032b or %064b as the format
 */

final class BitOperation {
    /*
     * 注意：位运算只能支持int类型
     */

    public static $format = true;

    //计算原码 吧数字十进制转换成二进制，并补充字符到系统的位数指定长度的原码
    public static function OriginalCode(int $number) {
        $OriginalCode = self::DecimalToBinary($number);
        return $OriginalCode;
    }

    //计算反码
    public static function InverseCode(int $number) {
        $OriginalCode = self::DecimalToBinary($number);
//        p($OriginalCode);
        $InverseCode = '';
        if ($number >= 0) {
            return $OriginalCode;
        } else {
            $array = str_split($OriginalCode);
            foreach ($array as $k => &$v) {
                //符号位不变
                if ($k == 0) {
                    continue;
                }
                //1变0 0变1
                if ($v == '0') {
                    $v = 1;
                } elseif ($v == '1') {
                    $v = 0;
                }
            }
            foreach ($array as $k1 => $v1) {
                $InverseCode .= $v1;
            }
        }
        return $InverseCode;
    }

    //计算补码
    public static function ComplementCode(int $number) {
        $InverseCode = self::InverseCode($number);
        $ComplementCode = '';
        if ($number >= 0) {
            return $InverseCode;
        } else {
//            $array = str_split($InverseCode);
//            for ($index = (count($array) - 1); $index >= 0; $index--) {
//                $str .= $return[$index];
//            }
            /*
             * 不好直接计算
             */
            return decbin($number);
        }
        return self::Format($ComplementCode);
    }

    /*
     * 十进制转二进制
     * 或者直接借用 decbin函数直接转换效率更高，这次是学习代码，为了写清楚原理
     * 注意这里的效率慢其实只要 self::PhpDigit()函数造成的，如果定义死计算是64,32效率快很多倍
     */

    public static function DecimalToBinary(int $number) {
        $return = [];
        $abs = abs($number);
        while ($abs > 0) {
            $return[] = $abs % 2;
            $abs = $abs >> 1;
        }
        $str = '';
        for ($index = (count($return) - 1); $index >= 0; $index--) {
            $str .= $return[$index];
        }
        $plus_or_minus = $number >= 0 ? true : false;
        return self::FillingLength($str, $plus_or_minus);
    }

    //优化版 十进制转二进制
    public static function DecimalToBinaryFast(int $number) {
        $return = [];
        $str = decbin(abs($number));
        $plus_or_minus = $number >= 0 ? true : false;
        return self::FillingLength($str, $plus_or_minus);
    }

    /*
     * $plus_or_minus true +  false -
     */

    public static function FillingLength($string = null, $plus_or_minus = true) {
        $length = self::PhpDigit();
        $res = '';
        if ($plus_or_minus) {
            $res = str_pad($string, $length, '0', STR_PAD_LEFT);
        } else {
            $res = str_pad($string, $length - 1, '0', STR_PAD_LEFT);
            $res = '1' . $res;
        }
        return $res;
    }

    public static function Format($string = null, $separation = 4) {
        if (mb_strlen($string) == 32 || mb_strlen($string) == 64) {
            $re = chunk_split($string, $separation, ".");
            $re = trim($re, '.');
            $re = str_replace('.', '&nbsp;', $re);
            return $re;
        } else {
            return $string;
        }
    }

    /*
     * 你的系统是64，但是你运行的php版本不一定是64特别是在windows上
     */

    public static function PhpDigit() {
        $phpinfo = self::PhpInfoArray();
        if (strtolower($phpinfo['General']['Architecture']) == 'x86') {
            return 32;
        } else {
            return 64;
        }
    }

    public static function PhpInfoArray() {
        ob_start();
        phpinfo();
        $info_arr = array();
        $info_lines = explode("\n", strip_tags(ob_get_clean(), "<tr><td><h2>"));
        $cat = "General";
        foreach ($info_lines as $line) {
            // new cat?
            preg_match("~<h2>(.*)</h2>~", $line, $title) ? $cat = $title[1] : null;
            if (preg_match("~<tr><td[^>]+>([^<]*)</td><td[^>]+>([^<]*)</td></tr>~", $line, $val)) {
                $info_arr[trim($cat)][trim($val[1])] = trim($val[2]);
            } elseif (preg_match("~<tr><td[^>]+>([^<]*)</td><td[^>]+>([^<]*)</td><td[^>]+>([^<]*)</td></tr>~", $line, $val)) {
                $info_arr[trim($cat)][trim($val[1])] = array("local" => trim($val[2]), "master" => trim($val[3]));
            }
        }
        return $info_arr;
    }

    public static function CountIntOne_1(int $n) {
        //计算一个十进制数转换为二进制数中‘1’的个数
        //例如十进制11 = 二进制1011，则结果是3个1
        //解题思路：利用 n & (n - 1) 可以将最后一个1变0
        //xxxx1000 & (xxxx1000 - 1) = xxxx1000 & xxxx0111 = xxxx0000
        // 1011 & (1011 - 1) = 1011 & 1010 = 1010
        //直到最后一个1被与为0，得出结果
        $r = 0;
        while ($n != 0) {
            $r++;
            $n &= ($n - 1);
        }
        return $r;
    }

    /*
     * 
     */

    public static function CountIntOne_2(int $n) {
        /*
         * 十进制转二进制过程计算余数
         * 1%2 = 1 1 2~0
         * 2%2 = 0 10 2~1
         * 3%2 = 1 11 2~0 + 2~1
         * 4%2 = 0 100 2~3
         * 5%2 = 1 101 2~0 + 2~3     5%2 = 1  1%2 =1
         * 
         * 利用的是数学计算过程，因为是对2求余，所有有可能是0 1 两个元素，0就是二进制位数0 1就是二进制位数的1
         */
        $r = 0;
        while ($n > 0) {
            $t = $n % 2;
            $n = $n >> 1;
            if ($t == 1) {
                $r++;
            }
        }
        return $r;
    }

    /**
     * @param int $a
     * @param int $b
     * @return int  $a + $b;
     */
    public static function add(int $a, int $b): int {
        $sum = $a;
        while ($b) {
            $sum = $a ^ $b;       // 不考虑进位
            $b = ($a & $b) << 1;  //  只考虑进位
            $a = $sum;
        }
        return $sum;
    }

    /**
     * 相反数 <= 二进制表达取反+1(补码)
     * @param int $n
     * @return int
     */
    public static function negateNumber(int $n): int {
        return self::add(~$n, 1);
    }

    /**
     * a-b = a + (-b)
     * @param int $a
     * @param int $b
     * @return int
     */
    public static function minus(int $a, int $b): int {
        return self::add($a, self::negateNumber($b));
    }

    /**
     * @param int $a
     * @param int $b
     * @return int  $a * $b
     */
    public static function multiple(int $a, int $b): int {
        $res = 0;
        while ($b) {
            if (($b & 1)) {
                $res = self::add($res, $a);
            }
            $a <<= 1;
            $b >>= 1;
        }
        return $res;
    }

//    public static function isNegative(int $n): bool {
//        return $n < 0;
//    }
    //-1就是负数， 0就是正数 直接右移31位即可看最左边第一个
    public static function isNegative(int $n) {
        return $n >> 31;
    }

    public static function maxInt(int $n) {
        return PHP_INT_MAX;
    }

    //交换两个int数
    public static function swap(int &$x, int &$y) {
        $x ^= $y;
        $y ^= $x;
        $x ^= $y;
    }

    //交换两个int数,注意返回int
    public static function average(int $x, int $y) {
        return ($x & $y) + (($x ^ $y) >> 1);
    }

    //判断奇偶
    public static function isOddEven(int $n) {
        return $n & 1;
    }

    public static function abs($x) {
        $y = $x >> 31;
        return ($x ^ $y) - $y;
    }

    /**
     * a/b  a = MIN_INTEGER, b!=MIN_INTEGER ?
     * @param int $a
     * @param int $b
     * @return int
     */
    public static function p(int $a, int $b): int {

        $x = self::isNegative($a) ? self::negateNumber($a) : $a;
        $y = self::isNegative($b) ? self::negateNumber($b) : $b;
        $res = 0;
        for ($i = 31; $i > -1; $i = self::minus($i, 1)) {
            if (($x >> $i) >= $y) {
                $res |= (1 << $i);
                $x = self::minus($x, $y << $i);
            }
        }
        return self::isNegative($a) ^ self::isNegative($b) ? self::negateNumber($res) : $res;
    }

    /**
     * @return int $a / $b
     */
    public static function pide(int $a, int $b): int {

        if ($b === 0) {
            throw new RuntimeException("pisor is 0");
        }
        if ($a === self::MIN_INTEGER && $b === self::MIN_INTEGER) {
            return 1;
        } else if ($b === self::MIN_INTEGER) {
            return 0;
        } else if ($a === self::MIN_INTEGER) {
            $res = self::p(self::add($a, 1), $b);
            return self::add($res, self::p(self::minus($a, self::multiple($res, $b)), $b));
        } else {
            return self::p($a, $b);
        }
    }

}
