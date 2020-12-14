<?php
#https://www.hackerrank.com/challenges/lonely-integer/problem

error_reporting(E_ALL);

function array_print($arr){
	return "[".join(",", $arr)."]";
}

function lonelyinteger($a) {
	sort($a);
	for($i=0;$i<count($a);$i+=2){
		if(($i + 1 >= count($a)) || ($a[$i] != $a[$i + 1])){
			return $a[$i];
		}
	}
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $n);

fscanf($stdin, "%[^\n]", $a_temp);

$a = array_map('intval', preg_split('/ /', $a_temp, -1, PREG_SPLIT_NO_EMPTY));

$result = lonelyinteger($a);

fwrite($fptr, $result . "\n");

fclose($stdin);
fclose($fptr);
