<?php
#https://www.hackerrank.com/challenges/permutation-equation/problem

error_reporting(E_ALL);

function array_print($arr){
	return "[".join(",", $arr)."]";
}

function permutationEquation($p) {
	$values = $keys = [];
	foreach($p as $i=>$v){
		$keys[$v] = $i + 1;
		$values[$i + 1] = $v;
	}

	$ret = [];
	foreach($values as $k=>$v){
		$k2 = $keys[$k];
		$k3 = $keys[$k2];
		$ret[] = $keys[$values[$k3]];
	}
	return $ret;
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $n);

fscanf($stdin, "%[^\n]", $p_temp);

$p = array_map('intval', preg_split('/ /', $p_temp, -1, PREG_SPLIT_NO_EMPTY));

$result = permutationEquation($p);

fwrite($fptr, implode("\n", $result) . "\n");

fclose($stdin);
fclose($fptr);
