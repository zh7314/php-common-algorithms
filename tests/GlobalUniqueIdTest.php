<?php

include_once './../src/Algorithm/GlobalUniqueId.php';
include_once './Function.php';

use ZX\Algorithm\GlobalUniqueId;

$r1 = GlobalUniqueId::CreateBasicsUid(1, 1);
$r2 = GlobalUniqueId::CreateBasicsUid(1, 2);

p($r1);
p($r2);
