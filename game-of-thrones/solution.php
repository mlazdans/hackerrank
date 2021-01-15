<?php

# https://www.hackerrank.com/challenges/game-of-thrones/problem

function gameOfThrones($s) {
	$stats = array_count_values(str_split($s));

	// Reverse sort
	arsort($stats);

	// Pop smallest letter count because it does not matter odd or even
	$last = array_pop($stats);

	foreach($stats as $v){
		// Can't build polindrome if any letter count is odd
		if($v % 2){
			return "NO";
		}
	}

	return "YES";
}

$s = trim(fgets(STDIN));

print gameOfThrones($s)."\n";
