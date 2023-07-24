<?php

namespace ZX\DataStructure;

/*
 * 二分查找
 * 
 */

class BinarySearch {
    /*
     * 只能支持一维有序数组
     */

    public static function BasicBinarySearch(array $arr, $target = null) {
        //定义开始和结束的下标
        $start = 0;
        $end = count($arr) - 1;

        while ($start <= $end) {

            $mid = floor(($start + $end) / 2);
            if ($arr[$mid] == $target) {
                return $mid;
            }
//查询的数小，往左继续查找
            if ($arr[$mid] > $target) {
                $end = $mid - 1;
            }
//查询的数大，往右继续查找
            if ($arr[$mid] < $target) {
                $start = $mid + 1;
            }
        }
    }

    /*
     * 支持一维无序数组并返回所有相同值的key
     * 
     * 其实二分查找就是建立一个二叉树进行查询，而且是有序的二叉树
     * 
     */

    public static function BinarySearch1(array $param, $search = null, $is_return_all = false) {
        //定义开始和结束的下标
        $start = 0;
        $end = count($arr) - 1;
    }

}
