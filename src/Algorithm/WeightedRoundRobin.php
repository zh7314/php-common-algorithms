<?php

namespace ZX\Algorithm;

/*
 * 加权轮训算法
 * 
 * 
 * $arr = array(
  array('id' => 'A', 'weight' => 3),
  array('id' => 'B', 'weight' => 3),
  array('id' => 'C', 'weight' => 6),
  array('id' => 'D', 'weight' => 4),
  array('id' => 'E', 'weight' => 1),
  );
 * $arr = array(
  array('id' => '192.168.1.1', 'weight' => 3),
  array('id' => '192.168.1.2', 'weight' => 3),
  array('id' => '192.168.1.3', 'weight' => 6),
  array('id' => '192.168.1.4', 'weight' => 4),
  array('id' => '192.168.1.5', 'weight' => 1),
  );
 */

class WeightedRoundRobin {

    private static $weightArray = array();
    private static $currentIndex = -1; //代表上一次选择的服务器
    private static $gcd; //表示集合S中所有服务器权值的最大公约数
    private static $currentWeight = 0; //当前调度的权值
    private static $maxWeight; //最大元素的值
    private static $count; //总元素个数

    public function __construct(array $weightArray) {
        self::$weightArray = $weightArray;
        self::$gcd = self::getGcd(self::$weightArray);
//        p(self::$gcd);
    }

    /*
     * 
     * 算法的原理是：在服务器数组S中，首先计算所有服务器权重的最大值max(S)，以及所有服务器权重的最大公约数gcd(S)。
      index表示本次请求到来时，选择的服务器的索引，初始值为-1；current_weight表示当前调度的权值，初始值为max(S)。
      当请求到来时，从index+1开始轮询服务器数组S，找到其中权重大于current_weight的第一个服务器，用于处理该请求。记录其索引到结果序列中。
      在轮询服务器数组时，如果到达了数组末尾，则重新从头开始搜索，并且减小current_weight的值：current_weight -= gcd(S)。如果current_weight等于0，则将其重置为max(S)。
     * 参考博客：https://blog.csdn.net/gqtcgq/article/details/52076997
     * https://blog.csdn.net/jjavaboy/article/details/45604569
     */

    public function getWeight() {
        while (true) {
            self::$currentIndex = ((int) self::$currentIndex + 1) % (int) self::$count;
            if (self::$currentIndex == 0) {
                self::$currentWeight = (int) self::$currentWeight - (int) self::$gcd;
                if (self::$currentWeight <= 0) {
                    self::$currentWeight = (int) self::$maxWeight;
                    if (self::$currentWeight == 0) {
                        return null;
                    }
                }
            }
//            p(self::$currentIndex);
            if ((int) (self::$weightArray[self::$currentIndex]['weight']) >= self::$currentWeight) {
                return self::$weightArray[self::$currentIndex];
            }
        }
    }

    //获取最大公约数 Greatest common divisor  最大共同被除数
    private static function getGcd(array $weightArray) {
        if (empty($weightArray) || !is_array($weightArray)) {
            throw new \Exception('数组不能为空');
        }
        $weight = [];
        //权重只能为正整数
        foreach ($weightArray as $k => $v) {
            if (!is_int($v['weight']) || $v['weight'] <= 0) {
                throw new \Exception('权限不合法');
            }
            $weight[] = $v['weight'];
        }
        $min = min($weight);
        self::$maxWeight = max($weight);
        self::$count = count($weight);
        //如果最小值是1，最小公约数就必定是1
        if ($min == 1) {
            return 1;
        }
        //如果不是1，就每个元素，循环查询对最小值往下做整除处理，如果全可以整除，如果有一个不能就中断
        for ($i = $min; $i > 1; $i--) {
            foreach ($weight as $k1 => $v1) {
                if ($v1 % $i == 0) {
                    $status = true;
                } else {
                    $status = false;
                    break;
                }
            }
            if ($status) {
                return $i;
            } else {
                return 1;
            }
        }
    }

    /*
     * 队列方式
     * 
     */

    public function getQueue() {
        
    }

    /*
     * 序列化
     * 例如，上面getWeight需要每次调用的时候都需要计算，如果在由固定配置文件的时候，不是动态加载的情况下，也是一种消耗
     * 如果按照配置文件生产一个1万或者10万的序列数据，会很好，但是使用一大块内存，如果就纯算法来说是可以的，如果是实际应用不建议
     */

    public function sequence() {
        
    }

}
