<?php

include_once './../src/Algorithm/SnowFlake.php';
include_once './Function.php';

use ZX\Algorithm\SnowFlake;

SnowFlake::setMachineId(1);

$r1 = SnowFlake::generateParticle();

p($r1);

