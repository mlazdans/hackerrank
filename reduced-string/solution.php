<?php
#https://www.hackerrank.com/challenges/reduced-string/problem

error_reporting(E_ALL);

function superReducedString($s) {
	$s = trim($s);
	while(preg_match_all('/([a-z]{1})\1/', $s, $m)){
		$repl = array_fill(0,count($m[0]), "");
		$s = str_replace($m[0], $repl, $s);
	}
	return ($s?$s:"Empty String");
}

$fptr = fopen("php://stdout", "w");

$s = rtrim(fgets(STDIN), "\r\n");

$result = superReducedString($s);

fwrite($fptr, $result . "\n");

fclose($fptr);
