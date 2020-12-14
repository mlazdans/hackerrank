<?php
#https://www.hackerrank.com/challenges/sherlock-and-array/problem

error_reporting(E_ALL);

function array_print($arr){
	return "[".join(",", $arr)."]";
}

function balancedSums($arr) {
	//print array_print($arr)."\n";
	$lSum = $pivot = 0;
	$rSum = array_sum($arr);
	do {
		$rSum -= $arr[$pivot];
		//print "rSum=$rSum,lSum=$lSum,pivot=$pivot\n";
		if($rSum == $lSum){
			return "YES";
		}
		$lSum += $arr[$pivot];
		$pivot++;
	} while($pivot<count($arr));

	return "NO";
}

$fptr = fopen("php://stdout", "w");

$T = intval(trim(fgets(STDIN)));

for ($T_itr = 0; $T_itr < $T; $T_itr++) {
	$n = intval(trim(fgets(STDIN)));

	$arr_temp = rtrim(fgets(STDIN));

	$arr = array_map('intval', preg_split('/ /', $arr_temp, -1, PREG_SPLIT_NO_EMPTY));

	$result = balancedSums($arr);

	fwrite($fptr, $result . "\n");
}

fclose($fptr);
