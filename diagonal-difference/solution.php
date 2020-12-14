<?php
#https://www.hackerrank.com/challenges/diagonal-difference/problem

error_reporting(E_ALL);


function diagonalDifference($arr) {
	$c = count($arr);
	$s1 = $s2 = 0;
	for($i=0; $i<$c;$i++){
		$s1 += $arr[$i][$i];
		$s2 += $arr[$i][$c - $i - 1];
	}
	return abs($s2 - $s1);
}

$fptr = fopen("php://stdout", "w");

$n = intval(trim(fgets(STDIN)));

$arr = array();

for ($i = 0; $i < $n; $i++) {
    $arr_temp = rtrim(fgets(STDIN));

    $arr[] = array_map('intval', preg_split('/ /', $arr_temp, -1, PREG_SPLIT_NO_EMPTY));
}

$result = diagonalDifference($arr);

fwrite($fptr, $result . "\n");

fclose($fptr);
