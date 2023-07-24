<?php

namespace ZX\Algorithm;

/*
 * 冒泡排序
 */

class BubbleSort {
    /*
     * 基础排序
     */

    public static function BasicBubbleSort(array $arr) {
        $length = count($arr);
        //外层控制排序轮次
        for ($outer = 0; $outer < $length; $outer++) {
            // 和后面紧跟着的第一个数字开始一直到末尾最后一个数字，比赛大小
            //内层控制每轮比较次数
            for ($inner = $outer + 1; $inner < $length; $inner++) {
                // 如果比后面的数字大，那么二者交换一下座位
                if ($arr[$outer] > $arr[$inner]) {
                    $temp = $arr[$outer];
                    $arr[$outer] = $arr[$inner];
                    $arr[$inner] = $temp;
                }
            }
        }
        return $arr;
    }

    public static function BetterBubbleSort(array $arr) {
        $length = count($arr);
// 外部循环
        $swap = true;
        for ($outer = 0; $outer < $length && $swap; $outer++) {
            $swap = false;
            // 当外部循环开始第一轮的时候，从倒数第一位开始往前对比，一直到与正数第一位比较完后终止
            // 当外部循环开始第一轮的时候，从倒数第一位开始往前对比，一直到与正数第二位比较完后终止
            for ($inner = $length - 1; $inner > $outer; $inner--) {
                if ($arr[$inner] < $arr[$inner - 1]) {
                    $temp = $arr[$inner];
                    $arr[$inner] = $arr[$inner - 1];
                    $arr[$inner - 1] = $temp;
                    $swap = true;
                }
            }
        }
        return $arr;
    }

    /*
     * 还原原有数据，冒泡排序,借助php原生函数做，如果数据里有相同元素也可以,这个才是完整还原最大元素压入队收，就像气泡一个一个往上浮
     * 其实还有更简单的原生方法 sort() - 以升序对数组排序
      rsort() - 以降序对数组排序
      asort() - 根据值，以升序对关联数组进行排序
      ksort() - 根据键，以升序对关联数组进行排序
      arsort() - 根据值，以降序对关联数组进行排序
      krsort()
     */

    public static function BubbleSort1(array $arr) {
        $array = [];
        $length = count($arr);
        for ($i = 0; $i < $length; $i++) {
            //查出最大的元素值,也可以使用min也是一样的
            $max = max($arr);
            $pos = array_search($max, $arr);
            array_unshift($array, $arr[$pos]);
            unset($arr[$pos]);
        }
        return $array;
    }

}
