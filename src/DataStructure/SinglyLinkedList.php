<?php

namespace ZX\DataStructure;

/*
 * 单向链表，注意是使用数组模拟单链表到特性，也可以理解为有单向链接到数组
 */

final class SinglyLinkedList {

//    //从链表尾部压入一个节点，节点自动维护，不需要要像main方法那样自己维护
    public function push(Node $head, Node $Node) {
        $current = $head; //让$current指向$head;
        while ($current->next != null) {
            $current = $current->next;
        }
        $current->next = $Node->next;
        $current->next = $Node;
    }

    //从链表尾压出一个节点
    public function pop(Node $head) {
        $current = $head; //让$current指向$head;
        while ($current->next != null) {
            //提前查找链表尾部是否为空，为空就是尾部，吧当前节点的next复制问NULL，就是尾部元素干掉
            if ($current->next->next == null) {
                break;
            }
            $current = $current->next;
        }
        $current->next = null;
    }

    //非自动维护一个链表，只是单纯点组成一个链表
    public static function main() {
        $header = new Node(null);

        $node1 = new Node(['id' => 2, 'name' => '李1']);
        $header->next = $node1;
        $node2 = new Node(['id' => 5, 'name' => '李5']);
        $node1->next = $node2;
        $node3 = new Node(['id' => 7, 'name' => '李7']);
        $node2->next = $node3;
//        pp($header);
        self::getAllNode($header);
    }

    public static function getAllNode($header) {
        $cur = $header;
        while ($cur->next != null) {
            $cur = $cur->next;
            p($cur->data);
        }
    }

}
