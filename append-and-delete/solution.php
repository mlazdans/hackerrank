<?php
#https://www.hackerrank.com/challenges/append-and-delete/problem

error_reporting(E_ALL);

function appendAndDelete($s, $t, $k) {
	$s = trim($s);
	$t = trim($t);
	$start = 0;
	while(($start < strlen($s)) && (strncmp($s, $t, $start + 1) === 0)){
		$start++;
	}
	$min = strlen($s) - 2*$start + strlen($t);
	if(strlen($s) >= strlen($t)){
		return $min<=$k ? "Yes" : "No";
	} else {
		return $k % (strlen($t) - strlen($s)) == 0 ? "Yes" : "No";
	}
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

$s = '';
fscanf($stdin, "%[^\n]", $s);

$t = '';
fscanf($stdin, "%[^\n]", $t);

fscanf($stdin, "%d\n", $k);

$result = appendAndDelete($s, $t, $k);

fwrite($fptr, $result . "\n");

fclose($stdin);
fclose($fptr);
