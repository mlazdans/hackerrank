<?php

# https://www.hackerrank.com/challenges/manasa-and-stones/problem

// 58
// 69
// 24
// [24,...] + 24
// [24,...] + 69
// [69,...] + 24
// [69,...] + 69

function stones($n, $a, $b) {
	for($i = 0; $i < $n; $i++){
		$s1 = $a * $i;
		$s2 = $b * ($n - $i - 1);
		$ret[] = $s1 + $s2;
	}

	sort($ret, SORT_NUMERIC);

	return array_unique($ret);
}

$T = (int)fgets(STDIN);
for ($T_itr = 0; $T_itr < $T; $T_itr++) {
	$n = (int)fgets(STDIN);
	$a = (int)fgets(STDIN);
	$b = (int)fgets(STDIN);
	$result = stones($n, $a, $b);
	print implode(" ", $result) . "\n";
}
