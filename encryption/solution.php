<?php
#https://www.hackerrank.com/challenges/encryption/problem

error_reporting(E_ALL);

function encryption($s) {
	$s = preg_replace("/\s/", "", $s);
	$L = strlen($s);
	$rows = floor(sqrt($L));
	$cols = ceil(sqrt($L));
	while($rows * $cols < $L){
		if($cols<$rows){
			$cols++;
		}else{
			$rows++;
		}
	}

	$a = array_chunk(str_split($s, 1), $cols);

	$b = [];
	for($i = 0; $i < $cols; $i++){
		$b[] = join("", array_column($a, $i));
	}

	return join(" ", $b);
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

$s = '';
fscanf($stdin, "%[^\n]", $s);

$result = encryption($s);

fwrite($fptr, $result . "\n");

fclose($stdin);
fclose($fptr);
