<?php
#https://www.hackerrank.com/challenges/maxsubarray/problem

error_reporting(E_ALL);

function array_print($arr){
	return "[".join(",", $arr)."]";
}

function maxSubarray($arr){
	$cache[-1] = -INF;
	for($i=0;$i<count($arr);$i++){
		$cache[$i] = max($cache[$i - 1] + $arr[$i], $arr[$i]);
	}
	$max = max($cache);

	rsort($arr);
	$sum = $arr[0];
	for($i=1;$i<count($arr);$i++){
		if($sum+$arr[$i]<=$sum){
			break;
		}
		$sum+=$arr[$i];
	}

	return [$max,$sum];
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $t);

for ($t_itr = 0; $t_itr < $t; $t_itr++) {
	fscanf($stdin, "%d\n", $n);

	fscanf($stdin, "%[^\n]", $arr_temp);

	$arr = array_map('intval', preg_split('/ /', $arr_temp, -1, PREG_SPLIT_NO_EMPTY));

	$result = maxSubarray($arr);

	fwrite($fptr, implode(" ", $result) . "\n");
}

fclose($stdin);
fclose($fptr);
