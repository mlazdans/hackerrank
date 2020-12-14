<?php
#https://www.hackerrank.com/challenges/fibonacci-modified/problem

function fibonacciModified($t1, $t2, $n) {
	for($r = 3; $r<=$n; $r++){
		$t = bcadd($t1, bcmul($t2,$t2));
		$t1 = $t2;
		$t2 = $t;
	}
	return $t2;
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%[^\n]", $t1T2n_temp);
$t1T2n = explode(' ', $t1T2n_temp);

$t1 = intval($t1T2n[0]);

$t2 = intval($t1T2n[1]);

$n = intval($t1T2n[2]);

$result = fibonacciModified($t1, $t2, $n);

fwrite($fptr, $result . "\n");

fclose($stdin);
fclose($fptr);
