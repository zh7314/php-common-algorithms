<?php

include_once './../src/Algorithm/Random.php';
include_once './Function.php';

use ZX\Algorithm\Random;

$r1 = Random::BasicsRandom();
$r2 = Random::getRandomNumber();

p($r1);
p($r2);
