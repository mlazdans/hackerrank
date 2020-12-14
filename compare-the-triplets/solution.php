<?php
#https://www.hackerrank.com/challenges/compare-the-triplets/problem

error_reporting(E_ALL);

function compareTriplets($a, $b) {
	$a = array_map(function($i, $j){
		return [($i > $j ? 1 : 0), ($i < $j ? 1 : 0)];
	}, $a, $b);

	return array_reduce($a, function($c ,$i){
		$c[0] += $i[0];
		$c[1] += $i[1];
		return $c;
	}, [0,0]);
}

$fptr = fopen("php://stdout", "w");

$a_temp = rtrim(fgets(STDIN));

$a = array_map('intval', preg_split('/ /', $a_temp, -1, PREG_SPLIT_NO_EMPTY));

$b_temp = rtrim(fgets(STDIN));

$b = array_map('intval', preg_split('/ /', $b_temp, -1, PREG_SPLIT_NO_EMPTY));

$result = compareTriplets($a, $b);

fwrite($fptr, implode(" ", $result) . "\n");

fclose($fptr);
