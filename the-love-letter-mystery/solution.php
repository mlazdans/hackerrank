<?php

# https://www.hackerrank.com/challenges/the-love-letter-mystery/problem

function theLoveLetterMystery($s) {
	$a = array_map("ord", str_split($s));
	$pos = 0;
	$steps = 0;
	$len = strlen($s) - 1;
	while($pos<$len){
		while($a[$pos] != $a[$len]){
			$steps++;
			if($a[$pos] < $a[$len]){
				$a[$len]--;
			} else {
				$a[$pos]--;
			}
		}
		$pos++;
		$len--;
	}

	return $steps;
}

$q = (int)fgets(STDIN);
for ($q_itr = 0; $q_itr < $q; $q_itr++) {
	$s = trim(fgets(STDIN));
	$result = theLoveLetterMystery($s);
	print $result."\n";
}
