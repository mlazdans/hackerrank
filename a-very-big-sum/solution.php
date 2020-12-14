<?php
#https://www.hackerrank.com/challenges/a-very-big-sum/problem

error_reporting(E_ALL);

function aVeryBigSum($ar) {
	return array_reduce($ar, function($i, $c){
		return bcadd($i, $c);
	}, '');
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $ar_count);

fscanf($stdin, "%[^\n]", $ar_temp);

$ar = array_map('intval', preg_split('/ /', $ar_temp, -1, PREG_SPLIT_NO_EMPTY));

$result = aVeryBigSum($ar);

fwrite($fptr, $result . "\n");

fclose($stdin);
fclose($fptr);