<?php

# https://www.hackerrank.com/challenges/common-child/problem

// Complete the commonChild function below.
function commonChild($A, $B) {
	$len = strlen($A);

	// Some space saving. We actually do not need full len x len array
	// $table = array_fill(0, $len + 1, array_fill(0, $len + 1, 0));
	$table[0] = array_fill(0, $len + 1, 0);
	$table[1] = array_fill(0, $len + 1, 0);

	for($ia = 1; $ia <= $len; $ia++){
		$r1 = ($ia - 1) % 2;
		$r2 = ($ia - 0) % 2;
		for($ib = 1; $ib <= $len; $ib++){
			if(($A[$ia - 1] == $B[$ib - 1])){
				// printf("found=[%s] from %d at=%d\n", $A[$ia - 1], $ia, $ib);
				// $table[$ia][$ib] = $table[$ia - 1][$ib - 1] + 1;
				$table[$r1][$ib] = $table[$r2][$ib - 1] + 1;
			} else {
				// $table[$ia][$ib] = max($table[$ia - 1][$ib], $table[$ia][$ib - 1]);
				$table[$r1][$ib] = max($table[$r2][$ib], $table[$r1][$ib - 1]);
			}
		}
	}

	return $len % 2 ? $table[0][$len] : $table[1][$len];
}

$stdin = fopen("php://stdin", "r");

$s1 = trim(fgets($stdin));
$s2 = trim(fgets($stdin));

print commonChild($s1, $s2, strlen($s1), strlen($s2));

fclose($stdin);
