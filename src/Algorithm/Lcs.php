<?php

namespace ZX\Algorithm;

/*
 * Lcs算法 动态规划算法
 * 
 * 这里需要注意是最长
 * 最长公共子串（Longest Common Substirng）和最长公共子序列（Longest Common Subsequence，LCS）
 * 的区别为：子串是串的一个连续的部分，子序列则是从不改变序列的顺序，
 * 而从序列中去掉任意的元素而获得新的序列；
 * 也就是说，子串中字符的位置必须是连续的，子序列则可以不必连续。
 * 
 * 注意：这里是现实的是最长公共子序列
 * 比如：
 * 给定字符1->给定字符1 =>结果字符串
 * a b c e f g
 * a c d g
 * a c g
 * 
 * 匹配上的数据大写
 * A b C e f G
 * A C d G
 * A C G
 * 
 * 字符串1 单个字符开始从字符串2的第一个字符查询有顺序的匹配的字符
 */

final class Lcs {

    /**
     * 生成 LCS 迭代路径图和打印路径图
     * @param string $str1 字符串1
     * @param string $str2 字符串2
     * @param array  $map  迭代路径图
     * @param array  $path 打印路径图
     */
    public static function lcs_map(string $str1, string $str2, array &$map, array &$path) {
        for ($i = 0; $i <= strlen($str1); $i++) {
            for ($j = 0; $j <= strlen($str2); $j++) {
                $path[$i][$j] = 0; // 初始化 path
                if (0 == $i || 0 == $j) {
                    // map 初始行和初始列均为 0
                    $map[$i][$j] = 0;
                } else if ($str1[$i - 1] == $str2[$j - 1]) {
                    // 字符相同，则左上角+1
                    $map[$i][$j] = $path[$i][$j] = $map[$i - 1][$j - 1] + 1;
                } else {
                    // 字符不相同，则选择上和左中最大值
                    $map[$i][$j] = ($map[$i - 1][$j] > $map[$i][$j - 1]) ?
                            $map[$i - 1][$j] : $map[$i][$j - 1];
                }
            }
        }
    }

    /**
     * 返回最长公共子序列
     * @param string $str1 字符串1
     * @param string $str2 字符串2
     * @param array  $path 打印路径
     * @param int    $max  最长路径长度
     * @return string 子序列字符串
     */
    public static function LCS(string $str1, string $str2, array $path, int $max) {
        $str = []; // 存储字符串
        $j = strlen($str2); // 初始化 $j
        for ($i = strlen($str1); $i > 0; $i--) {
            // 每当匹配到一个字符以后，下一个字符必然在该列之前，而非该列之后
            // 因此这里不需要每次循环都初始化 $j
            for (; $j > 0; $j--) {
                if ($path[$i][$j] == $max) {
                    // 因为是从后往前遍历，所以需要前端插入
                    array_unshift($str, $str1[$i - 1]);
                    $max--; // 路径长度 - 1
                    break; // 改行已找到匹配字符，跳过该行
                }
            }
            if (0 == $max)
                break;
// 路径长度为 0，退出循环
// 这里会出现一个问题
            // 如果一行都没有匹配项，那么 $j 就会循环至 0，无法参与下一行匹配
            // 因此这里做一个判断，如果路径长度 > 0 的时候 $j 已经减小到 0
            // 那么就初始化 $j
            if (0 == $j && $max > 0)
                $j = strlen($str2);
        }
        return implode('', $str); // 将字符数组拼接成字符串返回
    }

    //另一个实现方式
    public static function lcs1($str1, $str2) {
        // 存储生成的二维矩阵
        $dp = array();
        // 最大子串长度
        $max = 0;

        for ($i = 0; $i < strlen($str1); $i++) {
            for ($j = 0; $j < strlen($str2); $j++) {
                if ($str1[$i] == $str2[$j]) {
                    $dp[$i][$j] = isset($dp[$i - 1][$j - 1]) ? $dp[$i - 1][$j - 1] + 1 : 1;
                } else {
                    $dp[$i - 1][$j] = isset($dp[$i - 1][$j]) ? $dp[$i - 1][$j] : 0;
                    $dp[$i][$j - 1] = isset($dp[$i][$j - 1]) ? $dp[$i][$j - 1] : 0;

                    $dp[$i][$j] = $dp[$i - 1][$j] > $dp[$i][$j - 1] ? $dp[$i - 1][$j] : $dp[$i][$j - 1];
                }
                $max = $dp[$i][$j] > $max ? $dp[$i][$j] : $max;
            }
        }
        for ($i = 0; $i < strlen($str1); $i++) {
            for ($j = 0; $j < strlen($str2); $j++) {
                echo $dp[$i][$j] . " ";
            }
            echo "<br />";
        }
//        var_dump($max);
        return $max;
    }

}
