<?php
#https://www.hackerrank.com/challenges/circular-array-rotation/problem

error_reporting(E_ALL);

function circularArrayRotation($a, $k, $queries) {
	$k = $k % count($a);
	$a2 = array_splice($a, -$k);
	$a = array_merge($a2, $a);
	/*
	while($k){
		array_unshift($a, array_pop($a));
		$k--;
		print "$k\n";
	}
	*/
	$ret = [];
	foreach($queries as $q){
		$ret[] = $a[$q];
	}
	return $ret;
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%[^\n]", $nkq_temp);
$nkq = explode(' ', $nkq_temp);

$n = intval($nkq[0]);

$k = intval($nkq[1]);

$q = intval($nkq[2]);

fscanf($stdin, "%[^\n]", $a_temp);

$a = array_map('intval', preg_split('/ /', $a_temp, -1, PREG_SPLIT_NO_EMPTY));

$queries = array();

for ($i = 0; $i < $q; $i++) {
	fscanf($stdin, "%d\n", $queries_item);
	$queries[] = $queries_item;
}

$result = circularArrayRotation($a, $k, $queries);

fwrite($fptr, implode("\n", $result) . "\n");

fclose($stdin);
fclose($fptr);
