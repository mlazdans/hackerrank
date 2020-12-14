<?php
#https://www.hackerrank.com/challenges/closest-numbers/problem

error_reporting(E_ALL);

function array_print($arr){
	return "[".join(",", $arr)."]";
}

function closestNumbers($arr) {
	sort($arr);
	for($i=0;$i<count($arr)-1;$i++){
		$d[$i] = abs($arr[$i+1]-$arr[$i]);
	}

	$ret = [];
	asort($d, SORT_NUMERIC);
	$oldV = $d[array_key_first($d)];
	foreach($d as $k=>$v){
		if($v != $oldV){
			break;
		}
		$ret[] = $arr[$k];
		$ret[] = $arr[$k+1];
	}

	sort($ret, SORT_NUMERIC);

	return $ret;
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $n);

fscanf($stdin, "%[^\n]", $arr_temp);

$arr = array_map('intval', preg_split('/ /', $arr_temp, -1, PREG_SPLIT_NO_EMPTY));

$result = closestNumbers($arr);

fwrite($fptr, implode(" ", $result) . "\n");

fclose($stdin);
fclose($fptr);
