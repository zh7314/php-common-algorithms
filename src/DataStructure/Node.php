<?php

namespace ZX\DataStructure;

/*
 * 链表测试到辅助类
 */

final class Node {

    public $data;
    public $next = null;

    public function __construct($data) {
        $this->data = $data;
    }

}

final class BasicNode {

    public $index;
    public $data;
    public $next = null;
    public $pre = null;

    public function __construct($index, $data) {
        $this->index = $index;
        $this->data = $data;
    }

}

final class Kid {

    public $no;
    public $next = null;

    public function __construct($no) {
        $this->no = $no;
    }

}
