<?php
#https://www.hackerrank.com/challenges/plus-minus/problem

error_reporting(E_ALL);

function plusMinus($arr) {
	$c = count($arr);
	$a = array_reduce($arr, function($c, $i){
		if($i>0)$c[0]++;
		if($i<0)$c[1]++;
		if($i==0)$c[2]++;
		return $c;
	}, [0,0,0]);
	foreach($a as $v){
		print ($v / $c)."\n";
	}
}

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $n);

fscanf($stdin, "%[^\n]", $arr_temp);

$arr = array_map('intval', preg_split('/ /', $arr_temp, -1, PREG_SPLIT_NO_EMPTY));

plusMinus($arr);

fclose($stdin);
