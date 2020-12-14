<?php
#https://www.hackerrank.com/challenges/strange-code/problem

error_reporting(E_ALL);

function array_print($arr){
	return "[".join(",", $arr)."]";
}

function strangeCounter($t) {
	$x = $i = 0;
	while($x<$t){
		$x += 3 * pow(2, $i);
		$i++;
	}
	return $x - $t + 1;
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%ld\n", $t);

$result = strangeCounter($t);

fwrite($fptr, $result . "\n");

fclose($stdin);
fclose($fptr);
