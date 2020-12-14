<?php
# https://www.hackerrank.com/challenges/coin-change/problem

error_reporting(E_ALL);

$Mem = [];
function getWays($n, $c, $j = 0) {
	global $Mem;

	if(isset($Mem[$n][$j])){
		return $Mem[$n][$j];
	} elseif($n == 0){
		return 1;
	} elseif($n < 0){
		return 0;
	}

	$s = 0;
	for($i = $j; $i < count($c); $i++){
		$s += getWays($n - $c[$i], $c, $i);
	}

	return $Mem[$n][$j] = $s;
}

list($n, $m) = fscanf(STDIN, "%d %d");
$c = fscanf(STDIN, str_repeat("%d", $m));
sort($c);

print "getWays($n,[".join(",", $c)."]);\n";
print getWays($n, $c);
//print_r($Mem);
