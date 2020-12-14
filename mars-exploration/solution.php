<?php
#https://www.hackerrank.com/challenges/mars-exploration/problem

error_reporting(E_ALL);

function marsExploration($s) {
	$ret = 0;
	$s = str_split(trim($s));
	$expect = str_split("SOS");
	for($i=0;$i<count($s);$i++){
		$ret += $s[$i] == $expect[$i % 3] ? 0 : 1;
	}
	return $ret;
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

$s = '';
fscanf($stdin, "%[^\n]", $s);

$result = marsExploration($s);

fwrite($fptr, $result . "\n");

fclose($stdin);
fclose($fptr);
