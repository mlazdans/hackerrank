<?php
#https://www.hackerrank.com/challenges/alternating-characters/problem

error_reporting(E_ALL);

function alternatingCharacters($s) {
	$s = trim($s);
	$del = 0;
	for($i=0;$i<strlen($s);$i++){
		$j = $i;
		$c = substr($s, $i, 1);
		while($c == substr($s, $j + 1, 1)){
			$del++;
			$j++;
		}
		$i = $j;
	}
	return $del;
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $q);

for ($q_itr = 0; $q_itr < $q; $q_itr++) {
	$s = '';
	fscanf($stdin, "%[^\n]", $s);

	$result = alternatingCharacters($s);

	fwrite($fptr, $result . "\n");
}

fclose($stdin);
fclose($fptr);
