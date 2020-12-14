<?php
#https://www.hackerrank.com/challenges/repeated-string/problem

error_reporting(E_ALL);

function repeatedString($s, $n) {
	$s = trim($s);
	$AC = count(array_filter(str_split($s), function($i){
		return $i == 'a';
	}));
	if($fullT = floor($n / strlen($s))){
		$rem = $n % $fullT;
	} else {
		$rem = $n;
	}
	//print "AC=$AC,fullL=$fullT,n=$n\n";

	$repeat = $fullT * $AC;
	for($i=0;$i<$rem;$i++){
		if(substr($s,$i,1) == 'a'){
			$repeat++;
		}
	}
	return $repeat;
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

$s = '';
fscanf($stdin, "%[^\n]", $s);

fscanf($stdin, "%ld\n", $n);

$result = repeatedString($s, $n);

fwrite($fptr, $result . "\n");

fclose($stdin);
fclose($fptr);
