<?php
#https://www.hackerrank.com/challenges/extra-long-factorials/problem

error_reporting(E_ALL);

function extraLongFactorials($n) {
	$f = 1;
	for($i = 1; $i <= $n; $i++){
		$f = bcmul($f, $i);
	}
	print $f;
}

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $n);

extraLongFactorials($n);

fclose($stdin);
