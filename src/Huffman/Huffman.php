<?php

namespace ZX\Huffman;

/**
 * 只能在php7.2一下版本运行
 */
class Huffman {
    /*
     * 压缩入口
     * $str:待压缩的字符串
     */

    public function encode($str) {
        $len = strlen($str);
        //计算每个字符权重值(出现的频度)
        //ord()，是php内置ASCII转化函数，将字符转化成ASCII码
        for ($i = 0; $i < $len; $i++)
            $array [ord($str { $i })] = 0; //初始化数组
        for ($i = 0; $i < $len; $i++)
            $array [ord($str { $i })]++;
        $HuffmanArray = array();
        //asort()函数对数组进行排序并保持索引关系。主要用于对那些单元顺序很重要的结合数组进行排序。
        asort($array);
        /**
         * 构造huffman树,时间复杂度O(nlogn)
         * 选择两个使用频率较小<字符在字符串中出现的次数>的结点合并生成出一个树
         */
        //循环创建哈夫曼树数组
//        pp($array);
        while ($item1 = each($array)) {
            $item2 = each($array);
            $this->creat_tree($item1, $item2, $array, $HuffmanArray);
            asort($array);
        }
        while ($item1 = next($array)) {

            //array_shift() 函数删除数组中的第一个元素，并返回被删除元素的值。
            $HuffmanArray = array_shift($HuffmanArray);
            $tab = null;
            $code_tab = $this->creat_tab($HuffmanArray, $tab);
            //压缩&转换整个字符串为二进制表达式
            $binary = null;
            for ($i = 0; $i < $len; $i++)
                $binary .= $tab [ord($str { $i })];
            //转化为压缩后的字符串
            $code = $this->encode_bin($binary);
            //静态huffman编码算法压缩后需保留huffman树
            return array('tree' => $HuffmanArray, 'len' => strlen($binary), 'code' => $code, 'code_tab' => $code_tab);
        }
    }

    /**
     * 解压缩入口
     * $huffman:解压所使用的huffman树
     * $str:被压缩的字符
     * $blen:压缩前的位长度
     */
    public function decode($huffman, $str, $blen) {
        $len = strlen($str);
        $binary = null;
        //将编码解为二进制表达式
        for ($i = 0; $i < $len; $i++)
            $binary .= str_pad(base_convert(ord($str { $i }), 10, 2), 8, '0', STR_PAD_LEFT);
        $binary = substr($binary, 0, $blen);
        return $this->decode_tree($binary, $huffman, $huffman);
    }

    /**
     * 将压缩后的二进制表达式再转为字符串
     * $binary:二进制表达式字串
     */
    private function encode_bin($binary) {
        $len = strlen($binary);
        //二进制转字符需要整8位,不足8位补0
        $blen = $len + 8 - $len % 8;
        $binary = str_pad($binary, $blen, '0');
        $encode = null;
        //每8位转为一个字符
        for ($i = 7; $i < $blen; $i += 8) {
            $frag = substr($binary, $i - 7, 8);
            //base_convert() 函数在任意进制之间转换数字
            $encode .= chr(base_convert($frag, 2, 10));
        }
        return $encode;
    }

    /**
     * 构造huffman树,使用贪婪算法选择最小的两个元素作为树的子节点
     * $item1:权重最小的元素1
     * $item2:权重次小的元素2
     * $array:所有字符出现次数表<权重表>
     * $HuffmanArray:保存生成的huffman树结构
     */
    private function creat_tree($item1, $item2, & $array, & $HuffmanArray) {
        list( $key, $weight ) = $item1;
        list( $key2, $weight2 ) = $item2;
        //假设当前树的左右节点为空节点
        $c1 = $key;
        $c2 = $key2;
        //判断两个元素若为树则直接作为节点并入主树
        if (isset($HuffmanArray [$key2])) {
            $c2 = $HuffmanArray [$key2];
            unset($HuffmanArray [$key2]);
        }
        if (isset($HuffmanArray [$key])) {
            $c1 = $HuffmanArray [$key];
            unset($HuffmanArray [$key]);
        }
        //设置树结点权值
        $array [$key2] = $weight + $weight2;
        //合并节点后删除元素
        unset($array [$key]);
        //合并到huffman树中
        $HuffmanArray [$key2] = array(0 => $c1, 1 => $c2);
    }

    /**
     * 广度优先遍历树,得到所有原字符对应的二进制表达式<01010...>
     * $tree:已经构建好的huffman树
     * $tab:编码表,保存所有字符对应的编码
     * $a0:左遍历树的路径<11010...>
     * $a1:右遍历树的路径
     */
    private function creat_tab($tree, & $tab, $a0 = null, $a1 = null) {

        if ($tree == null)
            return;
        //遍历左右子树

        foreach ($tree as $node => $ctree) {
            if (is_array($ctree)) {
                //判断未到达叶子节点时再向下遍历
                $this->creat_tab($ctree, $tab, $a0 . $node, $a1 . $node);
            } else {
                //遍历到叶子节点<原字符ascii码>时的所有路径,既二进制表达式,下同
                $tab [$ctree] = ${ 'a' . $node } . $node;
            }
        }
    }

    /**
     * 使用进制表达式深度优先遍历树,0为左子树,1为右子树,而到根节点,即为二进制表达式所指向的原字符
     * $binary:二进制表达式字串
     * $huffman:huffman树
     * $tree:当前所遍历的子树
     * $i:指向二进制表达式字串的<指针>
     * $code:解码后的字符串
     */
    private function decode_tree($binary, $huffman, $tree, $i = 0, $code = null) {
        $lr = $binary { $i };
        //遍历完成
        if ($lr == null)
            return $code;
        //判断是否到根节点,根节点既为二进制表达式对应的原字符ascii码
        if (is_array($tree [$lr])) {
            //继续向下遍历子树
            return $this->decode_tree($binary, $huffman, $tree [$lr], $i + 1, $code);
        } else {
            //将二进制表达式解码为原字符
            $code .= chr($tree [$lr]);
            return $this->decode_tree($binary, $huffman, $huffman, $i + 1, $code);
        }
    }

}
