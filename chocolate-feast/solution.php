<?php
#https://www.hackerrank.com/challenges/chocolate-feast/problem

error_reporting(E_ALL);

function array_print($arr){
	return "[".join(",", $arr)."]";
}

function chocolateFeast($n, $c, $m) {
	//print "Test[n=$n,c=$c,m=$m]\n";
	$wraps = 0;
	$total = 0;
	do{
		$chock = floor($n / $c);
		$n = $n % $c;
		$wraps += $chock;
		$extraN = floor($wraps / $m) * $c;
		$wraps = $wraps % $m;
		//print "n=$n+$extraN,chock=$chock,wraps=$wraps\n";
		$total += ($chock);
		$n+=$extraN;
	} while($chock);

	return $total;
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $t);

for ($t_itr = 0; $t_itr < $t; $t_itr++) {
	fscanf($stdin, "%[^\n]", $ncm_temp);
	$ncm = explode(' ', $ncm_temp);

	$n = intval($ncm[0]);

	$c = intval($ncm[1]);

	$m = intval($ncm[2]);

	$result = chocolateFeast($n, $c, $m);

	fwrite($fptr, $result . "\n");
}

fclose($stdin);
fclose($fptr);
