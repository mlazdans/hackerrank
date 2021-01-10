<?php

# https://www.hackerrank.com/challenges/common-child/problem

// Complete the commonChild function below.
function commonChild($A0, $B0) {
	$table = array_fill(0, strlen($A0) + 1, array_fill(0, strlen($B0) + 1, 0));

	$A = $A0;
	$B = $B0;
	for($ia = 1; $ia <= strlen($A); $ia++){
		$B = $B0;
		for($ib = 1; $ib <= strlen($B); $ib++){
			if(($A[$ia - 1] == $B[$ib - 1])){
				printf("found=[%s] from %d at=%d\n", $A[$ia - 1], $ia, $ib);
				$table[$ia][$ib] = $table[$ia - 1][$ib - 1] + 1;
				$A[$ia - 1] = "_";
				$B[$ib - 1] = "_";
				printf("%s\n%s\n\n", $A, $B);
			} else {
				$table[$ia][$ib] = max($table[$ia - 1][$ib], $table[$ia][$ib - 1]);
			}
		}
	}

	return $table[strlen($A)][strlen($B)];
}

$stdin = fopen("php://stdin", "r");

$s1 = trim(fgets($stdin));
$s2 = trim(fgets($stdin));

print commonChild($s1, $s2, strlen($s1), strlen($s2));

fclose($stdin);
