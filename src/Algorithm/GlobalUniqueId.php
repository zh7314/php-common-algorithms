<?php

namespace ZX\Algorithm;

/*
 * 全局唯一ID，提供多种算法
 */

final class GlobalUniqueId {
    /*
     * 最基本的创建唯一ID，根据时间 月计算 也可以作为订单order key 为string 根据type返回
     * 
     * $id  支持1-9999 可以做机器ID和店铺shop_id，$key_length - 10 - 6 =5位数
     * $now 可以根据时间变更的 生成对应的月份的
     * $type = 1 是订单号， 2是唯一机器码 32位
     * 如果需要真机器随机唯一ID参考 Random machineRandom方法
     */

    public static function CreateBasicsUid($id = 1, $type = 1) {

        //此方法没有完全测试，不完全一定是生产10位
        $rand = decbin(microtime(true)) . base_convert(uniqid(), 16, 2);

        $new_rand = base_convert($rand, 2, 10);
        if ($type == 1) {
            return $new_rand;
        }
        return md5($new_rand);
    }

    public static function ReverseBasicsUid($uid = null) {
        
    }

    public static function microtime_format($tag, $time) {
        list($usec, $sec) = explode(".", $time);
        $date = date($tag, $usec);
        return str_replace('x', $sec, $date);
    }

    public static function CharacterToNumber($character) {
        $character = str_split($character);
        foreach ($character as $k => &$v) {
            $v = ord($v);
        }
        return $character;
    }

}
