<?php
#https://www.hackerrank.com/challenges/missing-numbers/problem

error_reporting(E_ALL);

function array_print($arr){
	return "[".join(",", $arr)."]";
}

function missingNumbers($arr, $brr) {
	$counter = function($c,$i){
		$c[$i] = ($c[$i]??0)+1;
		return $c;
	};
	$mapa = array_reduce($arr, $counter, []);
	$mapb = array_reduce($brr, $counter, []);

	foreach($mapb as $k=>$v){
		if(isset($mapa[$k])){
			if($mapa[$k] == $v){
				unset($mapa[$k], $mapb[$k]);
			}
		}
	}
	$ret = array_keys($mapb);

	sort($ret);

	return ($ret);
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $n);

fscanf($stdin, "%[^\n]", $arr_temp);

$arr = array_map('intval', preg_split('/ /', $arr_temp, -1, PREG_SPLIT_NO_EMPTY));

fscanf($stdin, "%d\n", $m);

fscanf($stdin, "%[^\n]", $brr_temp);

$brr = array_map('intval', preg_split('/ /', $brr_temp, -1, PREG_SPLIT_NO_EMPTY));

$result = missingNumbers($arr, $brr);

fwrite($fptr, implode(" ", $result) . "\n");

fclose($stdin);
fclose($fptr);
