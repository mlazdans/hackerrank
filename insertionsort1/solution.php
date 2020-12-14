<?php
#https://www.hackerrank.com/challenges/insertionsort1/problem

error_reporting(E_ALL);

//2 4 6 8 3
function insertionSort1($n, $arr) {
	$i = count($arr) - 1;
	$v = $arr[$i];
	while($i && ($arr[$i - 1]>=$v)){
		$arr[$i] = $arr[$i-1];
		print join(" ", $arr)."\n";
		$i--;
	}
	$arr[$i] = $v;
	print join(" ", $arr)."\n";
}

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $n);

fscanf($stdin, "%[^\n]", $arr_temp);

$arr = array_map('intval', preg_split('/ /', $arr_temp, -1, PREG_SPLIT_NO_EMPTY));

insertionSort1($n, $arr);

fclose($stdin);
