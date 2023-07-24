<?php

namespace ZX\DataStructure;

/*
 * 双向链表
 */

final class DoublyLinkedList {

    //从链表尾部压入一个节点，节点自动维护，不需要要像main方法那样自己维护
    public function add(BasicNode $head, BasicNode $Node) {
        $current = $head; //让$current指向$head;
        //顺序联表根据index排序
        while ($current->next != null) {
            //head元素为空，从第一个有数据元素开始检测
            if ($current->next->index > $Node->index) {//如果有相同的index就不能插入
                break;
                //$current没有 next元素
            } elseif ($current->next->index == $Node->index) {
                throw new \Exception('index重复');
            }
            $current = $current->next;
        }
//        p($current);
        //没有元素，和尾部插入元素
        //中间插入情况
        if ($current->next != null) {
            $Node->next = $current->next;
        }
        $Node->pre = $current;
        if ($current->next != null) {
            $current->next->pre = $Node;
        }
        $current->next = $Node;
    }

    //从链表尾压出一个节点
    public function delete(BasicNode $head, $index) {
        $current = $head; //让$current指向$head;
        $has = false;
        while ($current->next != null) {
            //提前查找链表尾部是否为空，为空就是尾部，吧当前节点的next复制问NULL，就是尾部元素干掉
            if ($current->next->index == $index) {
                $has = true;
                break;
            }
            $current = $current->next;
        }
        if (!$has) {
            throw new \Exception('index没有找到');
        }
        if ($current->next != null) {
            $current->next->pre = $current;
        }
        $current->next = $current->next->next;
    }

    //修改数据
    public function update(BasicNode $head, $index, $data) {
        $current = $head; //让$current指向$head;
        $has = false;
        while ($current->next != null) {
            if ($current->next->index == $index) {
                $has = true;
                break;
            }
            $current = $current->next;
        }
        if (!$has) {
            throw new \Exception('index没有找到');
        }
        $current->next->data = $data;
    }

}
