<?php

namespace ZX\Algorithm;

/*
 * 随机数算法
 * 伪随机数 根据分布概率
 */

final class Random {
    /*
     * 生成一个随机的字符串
     * $codeLength 越大重复概率越低
     * 随机种子使用时间和位运算作为最基础，一微秒做到百万分之一或者千万分之一的重复概率
     * uniqid()函数测试 for php7.2写入10万次往数据库无一重复，函数源码有待研究，目前猜测是根据时间微妙有一部分外加随机一部分数据
     */

//    protected static $last = 0;
    protected static $microsecond = 1;

    //返回长度并不一定   写入10万次往数据库无一重复 也和uniqid()达到同样效果 
    public static function BasicsRandom() {
        $code = '';
        $time = self::getTime();
        //十进制转16进制 base_convert 支持的浮点数有大小限制
        $prefix = base_convert($time['time'], 10, 32);
        //截取后面微秒
        $microsecond = $time['right'];
        self::$microsecond += 10;
        $four = (int) $microsecond + self::$microsecond;

        $suffix = mb_substr((string) $four, 0, 5);
        $code = $prefix . base_convert($suffix, 10, 32);
        return $code;
    }

    public static function getRandomNumber() {
        $code = '';
        $time = self::getTime();
        $prefix = $time['time'];
        //截取后面微秒
        $microsecond = $time['right'];
        self::$microsecond += 10;
        $four = (int) $microsecond + self::$microsecond;

        $suffix = mb_substr((string) $four, 0, 5);
        $code = $prefix . $suffix;
        return $code;
    }

    /*
     * 利用系统的组件实现机器随机，因为是现在很多是虚拟机，模拟真实机器，但是随机程度依然很大
     * 
     * dev/urandom生成的速度比/dev/random快。如果不能立即生成随机串,/dev/random会一直阻塞,有时会非常耗费CPU;
     * /dev/urandom则会根据其他值立即生成一个随机串,不会阻塞。/dev/urandom生成的随机值没有/dev/random随机。大多数情况下,我们选用/dev/urandom
     * 没有时间验证真假，linux采用的是/dev/urandom windows采用是 
     * https://www.cnblogs.com/zx-admin/p/10282021.html  DLL下载 和安装
     * 
     */

    public static function machineRandom($length = 16) {
        /*
         * win 返回字符串长度，根据 $length 变化
         * linux 返回字符串长度，根据 $length 变化
         * 需要自己根据实际情况测试
         */
        try {
            $pr_bits = '';
            //防止大小写问题
            if (mb_substr(strtolower(PHP_OS), 0, 3) == 'win') {
                $CAPI_Util = new COM('CAPICOM.Utilities.1');
                $pr_bits = $CAPI_Util->GetRandom($length, 0);
                //返回是26位的字符串 tOONrQXC1YF7erMcER1jww==
                if (!empty($pr_bits)) {
                    return $pr_bits;
                } else {
                    throw new \Exception('return data is empty');
                }
            } else {
                $fp = @fopen('/dev/urandom', 'rb');
                if ($fp !== FALSE) {
                    $pr_bits = @fread($fp, $length);
                    @fclose($fp);
                }
                //返回是32位的字符串 e717c3ee007e669f84f0a2426d65d368
                if (!empty(bin2hex($pr_bits))) {
                    return bin2hex($pr_bits);
                } else {
                    throw new \Exception('return data is empty');
                }
            }
        } catch (Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public static function getTime() {
        /*
         * 测试 1989年 小数点后是五位数，但是近几年是四位数
         * 统一 乘以 五位数的0 
         */
//        return (double) microtime(true) * 100000;

        $time = microtime(true);
        $array = explode('.', $time);
//        p($array);
        if (empty($array['1'])) {
            $return['right'] = str_pad('', 5, '0', STR_PAD_RIGHT);
        } else {
            $return['right'] = str_pad($array['1'], 5, '0', STR_PAD_RIGHT);
        }
        $return['sec'] = $array['0'];
        $return['time'] = $array['0'] . $return['right'];

        return $return;
    }

    public static function getNumber() {
        $Number = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        return $Number;
    }

    public static function getUperString() {
        $String = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
        return $String;
    }

    public static function getLowerString() {
        $String = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
        return $String;
    }

    public static function getString() {
        $String = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
            'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's',
            't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D',
            'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O',
            'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
            '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '!',
            '@', '#', '$', '%', '^', '&', '*', '(', ')', '-', '_',
            '[', ']', '{', '}', '<', '>', '~', '`', '+', '=', ',',
            '.', ';', ':', '/', '?', '|');
        return $String;
    }

    public static function convert2To16($mybit) {
        $_32hexa = "";
        $index = -4;
        while (abs($index) <= 240) {
            $a = substr($mybit, $index, 4);
            $index = $index - 4;
            $_32hexa = base_convert($a, 2, 16) . $_32hexa;
        }
        return $_32hexa;
    }

    public static function convert2To32($mybit) {
        $_32hexa = "";
        $index = -5;
        while (abs($index) <= 240) { //多少位 ，默认240位
            $a = substr($mybit, $index, 4);
            $index = $index - 5;
            $_32hexa = base_convert($a, 2, 32) . $_32hexa;
        }
        return $_32hexa;
    }

}
