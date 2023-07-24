<?php

include_once './../src/DataStructure/DoublyLinkedList.php';
include_once './../src/DataStructure/Node.php';
include_once './Function.php';

use ZX\DataStructure\DoublyLinkedList;
use ZX\DataStructure\BasicNode;


$head = new BasicNode(null, []);
$a = new BasicNode(1, ['a']);
$b = new BasicNode(5, ['b']);
$c = new BasicNode(8, ['c']);
$d = new BasicNode(99, ['d']);
$e = new BasicNode(66, ['e']);

//if ($head->next->index > 1) {
//    pp('大于');
//} else {
//    pp('小于');
//}

$DoublyLinkedList = new DoublyLinkedList();
$DoublyLinkedList->add($head, $b);
//pp($head);
$DoublyLinkedList->add($head, $a);
//pp($head);
$DoublyLinkedList->add($head, $d);
$DoublyLinkedList->add($head, $e);

$DoublyLinkedList->add($head, $c);

$DoublyLinkedList->update($head, 5, ['2312321']);
$DoublyLinkedList->delete($head, 99);
pp($head);