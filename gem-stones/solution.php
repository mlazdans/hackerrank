<?php
#https://www.hackerrank.com/challenges/gem-stones/problem

error_reporting(E_ALL);

function gemstones($arr) {
	$map = [];
	$minerals = [];
	foreach($arr as $i=>$stone){
		$stone = str_split(trim($stone));
		$minerals[$i] = array_reduce($stone, function($c, $i) use (&$map){
			$c[$i] = isset($c[$i]) ? $c[$i] : 1;
			$map[$i] = isset($map[$i]) ? $map[$i] : 1;
			return $c;
		}, []);
	}

	$a = [];
	foreach($minerals as $m){
		$a = array_merge($a, array_diff_key($map, $m));
	}
	$dif =  array_diff_key($map, $a);
	return count($dif);
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $n);

$arr = array();

for ($i = 0; $i < $n; $i++) {
	$arr_item = '';
	fscanf($stdin, "%[^\n]", $arr_item);
	$arr[] = $arr_item;
}

$result = gemstones($arr);

fwrite($fptr, $result . "\n");

fclose($stdin);
fclose($fptr);
