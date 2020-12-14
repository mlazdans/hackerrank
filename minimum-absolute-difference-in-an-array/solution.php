<?php
#https://www.hackerrank.com/challenges/minimum-absolute-difference-in-an-array/problem

error_reporting(E_ALL);

function minimumAbsoluteDifference($arr) {
	sort($arr);
	$ret = INF;
	for($i=0;$i<count($arr)-1;$i++){
		for($j=$i+1;$j<count($arr);$j++){
			if(abs($arr[$i] - $arr[$j]) < $ret){
				$ret = abs($arr[$i] - $arr[$j]);
			} else {
				break;
			}
		}
	}
	return $ret;
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $n);

fscanf($stdin, "%[^\n]", $arr_temp);

$arr = array_map('intval', preg_split('/ /', $arr_temp, -1, PREG_SPLIT_NO_EMPTY));

$result = minimumAbsoluteDifference($arr);

fwrite($fptr, $result . "\n");

fclose($stdin);
fclose($fptr);
