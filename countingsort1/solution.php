<?php
#https://www.hackerrank.com/challenges/countingsort1/problem

error_reporting(E_ALL);

function countingSort($arr) {
	$c = array_reduce($arr, function($c, $i){
		$c[$i] = ($c[$i]??0) + 1;
		return $c;
	}, []);

	$ret = [];
	for($i=0;$i<100;$i++){
		$ret[] = $c[$i]??0;
	}
	return $ret;
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $n);

fscanf($stdin, "%[^\n]", $arr_temp);

$arr = array_map('intval', preg_split('/ /', $arr_temp, -1, PREG_SPLIT_NO_EMPTY));

$result = countingSort($arr);

fwrite($fptr, implode(" ", $result) . "\n");

fclose($stdin);
fclose($fptr);
