<?php
#https://www.hackerrank.com/challenges/countingsort1/problem

error_reporting(E_ALL);

function countingSort($arr) {
	for($i=0;$i<100;$i++){
		$c[$i] = 0;
	}
	foreach($arr as $v){
		$c[$v] = ($c[$v]??0)+1;
	}
	foreach($c as $i=>$v){
		for($j=0;$j<$v;$j++){
			$ret[] = $i;
		}
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
