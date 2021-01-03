<?php
#https://www.hackerrank.com/challenges/longest-increasing-subsequent/problem

function binsearch($arr, $X){
	$lo = 0;
	$hi = count($arr) - 1;

	while($hi > $lo){
		$mi = (int)floor(($hi + $lo) / 2);
		if($X>$arr[$mi]){
			$lo = $mi + 1;
		} else {
			$hi = $mi;
		}
	}

	return $hi;
}

function longestIncreasingSubsequence($arr) {
	$mem = [$arr[0]];

	for($i=1;$i<count($arr);$i++){
		if($arr[$i]>$mem[count($mem)-1]){
			$mem[] = $arr[$i];
		} else {
			$j = binsearch($mem, $arr[$i]);
			$mem[$j] = $arr[$i];
		}
	}

	return count($mem);

	// DP solution won't work on larger sets
	// $mem = array_fill(0, count($arr), 1);
	// for($i=1;$i<count($arr);$i++){
	// 	for($j=0;$j<$i;$j++){
	// 		if(($arr[$i]>$arr[$j]) && ($mem[$j]>=$mem[$i])){
	// 			$mem[$i] = $mem[$j] + 1;
	// 		}
	// 	}
	// }
	// return max($mem);
}

$fptr = fopen("php://stdout", "w");
$stdin = fopen("php://stdin", "r");
fscanf($stdin, "%d\n", $n);
$arr = array();
for ($i = 0; $i < $n; $i++) {
	fscanf($stdin, "%d\n", $arr_item);
	$arr[] = (int)$arr_item;
}

$result = longestIncreasingSubsequence($arr);

fwrite($fptr, $result . "\n");

fclose($stdin);
fclose($fptr);
