<?php

# https://www.hackerrank.com/challenges/quicksort1/problem

function quickSort($arr) {
	$l = $r = $e = [];
	foreach($arr as $i){
		if($i<$arr[0])
			$l[] = $i;
		elseif($i>$arr[0])
			$r[] = $i;
		else
			$e[] = $i;
	}

	return array_merge($l, $e, $r);
}

$n = (int)fgets(STDIN);
$l = trim(fgets(STDIN));

$arr = array_map('intval', explode(" ", $l));

$result = quickSort($arr);

print implode(" ", $result) . "\n";
