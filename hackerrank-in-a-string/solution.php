<?php
#https://www.hackerrank.com/challenges/hackerrank-in-a-string/problem

error_reporting(E_ALL);

function hackerrankInString($s) {
	$pos = 0;
	$str = "hackerrank";
	for($i=0;$i<strlen($s);$i++){
		if(substr($str,$pos,1) == substr($s,$i,1)){
			$pos++;
		}
		if($pos == strlen($str)){
			return "YES";
		}
	}
	return "NO";
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $q);

for ($q_itr = 0; $q_itr < $q; $q_itr++) {
	$s = '';
	fscanf($stdin, "%[^\n]", $s);

	$result = hackerrankInString($s);

	fwrite($fptr, $result . "\n");
}

fclose($stdin);
fclose($fptr);
