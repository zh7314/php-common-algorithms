<?php

include_once './../src/DataStructure/SinglyLinkedList.php';
include_once './../src/DataStructure/Node.php';
include_once './Function.php';

use ZX\DataStructure\SinglyLinkedList;
use ZX\DataStructure\Node;

//单链表
$head = new Node([]);

$SinglyLinkedList = new SinglyLinkedList();
$node1 = new Node(['id' => 2, 'name' => '李1']);
$SinglyLinkedList->push($head, $node1);

//pp($SinglyLinkedList->getList());
$node2 = new Node(['id' => 5, 'name' => '李5']);
$SinglyLinkedList->push($head, $node2);

$node3 = new Node(['id' => 7, 'name' => '李7']);
$SinglyLinkedList->push($head, $node3);

$SinglyLinkedList->pop($head);
p($head);

//SinglyLinkedList::main();

