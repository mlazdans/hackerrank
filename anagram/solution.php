<?php

# https://www.hackerrank.com/challenges/anagram/problem

function anagram($s) {
	$len = strlen($s);

	if($len % 2){
		return -1;
	}

	$pos = 0;
	$mid = $len / 2;
	do {
		if(($pos2 = strpos($s, $s[$pos], $mid)) !== false){
			$s[$pos2] = '-';
		}
	} while(++$pos<$mid);

	return $mid - substr_count($s, "-", $mid);
}

$q = (int)fgets(STDIN);
for ($q_itr = 0; $q_itr < $q; $q_itr++) {
	$s = trim(fgets(STDIN));
	print anagram($s)."\n";
}
