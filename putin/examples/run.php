<?php
include "../putin.php";
include "unit-tests.php";

$testCases = array();
$testCases[] = new PutinTestExample();

Putin\Putin::run($testCases);
