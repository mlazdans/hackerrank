<?php
#https://www.hackerrank.com/challenges/between-two-sets/problem

error_reporting(E_ALL);

function getTotalX($a, $b) {
	$maxa = max($a);
	$minb = min($b);

	$c = 0;
	for($n=$maxa; $n<=$minb; $n++){
		$isFactA = array_reduce($a, function($c, $i) use ($n){
			return $c && ($n % $i == 0);
		}, true);
		$isFactB = array_reduce($b, function($c, $i) use ($n){
			return $c && ($i % $n == 0);
		}, true);
		$c += ($isFactA && $isFactB ? 1 : 0);
	}
	return $c;
}

$fptr = fopen("php://stdout", "w");

$first_multiple_input = explode(' ', rtrim(fgets(STDIN)));

$n = intval($first_multiple_input[0]);

$m = intval($first_multiple_input[1]);

$arr_temp = rtrim(fgets(STDIN));

$arr = array_map('intval', preg_split('/ /', $arr_temp, -1, PREG_SPLIT_NO_EMPTY));

$brr_temp = rtrim(fgets(STDIN));

$brr = array_map('intval', preg_split('/ /', $brr_temp, -1, PREG_SPLIT_NO_EMPTY));

$total = getTotalX($arr, $brr);

fwrite($fptr, $total . "\n");

fclose($fptr);
