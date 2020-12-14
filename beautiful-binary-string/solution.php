<?php
#https://www.hackerrank.com/challenges/beautiful-binary-string/problem

error_reporting(E_ALL);

function beautifulBinaryString($b) {
	return substr_count(trim($b), "010");
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $n);

$b = '';
fscanf($stdin, "%[^\n]", $b);

$result = beautifulBinaryString($b);

fwrite($fptr, $result . "\n");

fclose($stdin);
fclose($fptr);
