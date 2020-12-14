<?php
#https://www.hackerrank.com/challenges/flipping-bits/problem

error_reporting(E_ALL);

function array_print($arr){
	return "[".join(",", $arr)."]";
}

function flippingBits($n) {
	$b = str_split(str_pad(decbin($n), 32, "0", STR_PAD_LEFT));
	foreach($b as &$i){
		$i = $i == 1 ? 0 : 1;
	}
	return bindec(join("", $b));
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $q);

for ($q_itr = 0; $q_itr < $q; $q_itr++) {
	fscanf($stdin, "%ld\n", $n);

	$result = flippingBits($n);

	fwrite($fptr, $result . "\n");
}

fclose($stdin);
fclose($fptr);
