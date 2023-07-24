<?php 

namespace ZX\DataStructure;

/*
 * 环形链表 解决约瑟夫问题
 */
//
//final class CircularLinkedList {
//
//    public function addKid($n = 0, &$head = null) {
//        for ($i = 0; $i < $n; $i++) {
//            $Kid = new Kid($i + 1);
//            if ($i == 0) { //第一个小孩的情况
//                $head = $Kid; //对象赋值，是引用赋值
//                $head->next = $Kid; //自己指向自己
//                $current = $head; //对象赋值，是引用赋值
//            } else {
//                $current->next = $Kid;
//                $Kid->next = $head;
////                //继续指向下一个
//                $current = $current->next;
//            }
//        }
//    }
//
//    /*
//     * $start 从几开始
//     * $count 数到几就出圈
//     */
//
//    public function play(Kid $head, $start, $count) {
//        $current = $head;
//        //移动指针从$start 移动到
//        while (1) {
//            if ($current->no == $start) {
//                break;
//            }
//            $current = $current->next;
//        }
////        p($current);
////        pp($this->countKids($current));
////        $all = $this->countKids($current);
//
//        while ($current->next != $current->next->next) {
//            //少移动一位，方便一处节点
//            for ($i = 1; $i < $count; $i++) {
//                $current = $current->next;
//            }
//            //去除节点
////            p($current);
////            p('出去的小孩是  --' . $current->next->no);
//            $current->next = $current->next->next;
////            p($current);
//            //移动指针,移到删除节点的下一位就是重新数数的那个节点
//            $current = $current->next;
//        }
////        p($current->no);
//    }
//
//    public function countKids(Kid $head) {
//        $current = $head;
//        $count = 1;
//        while ($head->no != $current->next->no) {
//            $count++;
//            $current = $current->next;
//            p($current->next->no);
//        }
//
//        return $count;
//    }
//
//}
