<?php
#https://www.hackerrank.com/challenges/kaprekar-numbers/problem

error_reporting(E_ALL);

function kaprekarNumbers($p, $q) {
	$ret = [];
	for($n=$p;$n<=$q;$n++){
		$sq = $n*$n;
		$d = strlen($n);
		$r = (int)substr($sq,-$d);
		$l = (int)substr($sq,0,-$d);
		if($l+$r==$n){
			$ret[] = $n;
		}
	}
	print ($ret ? join(" ", $ret) : "INVALID RANGE");
}

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $p);

fscanf($stdin, "%d\n", $q);

kaprekarNumbers($p, $q);

fclose($stdin);
