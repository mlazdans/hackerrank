<?php

// Complete the commonChild function below.
$mem = [];
function commonChild($A0, $B0, $istart = 0) {
	global $mem;

	$len = strlen($A0);
	//$k = $len - $istart;
	$k = $istart;
	if(isset($mem[$k])){
		return $mem[$k];
	}

	$max = 0;
	$A = $A0;
	$B = $B0;
	$steps = 0;

	$ib = 0;

	for($ia = $istart; $ia<$len; $ia++){
		// $B = $B0;
		printf("new iter [%s] start=%d ia=%d\n", $A[$ia], $istart, $ia);
		// $steps = 0;
		// for($ib = $ia; $ib<$len; $ib++){
			// if(stripos($B, $A[$ia], $ia) === false){
			// 	printf("skip %s", $A[$ia]);
			// 	continue;
			// }

			$offs = stripos($B, $A[$ia], $ib);

			// && ($ib>=$ia)
			if($offs !== false){
				$steps++;
				printf("found=[%s] from %d at=%d ia=%d offs=%d steps=%d\n", $A[$ia], $ia, $ib, $ia, $offs, $steps);
				$ib = $offs;
				$A[$ia] = "_";
				$B[$ib] = "_";
				printf("%s\n%s\n\n", $A, $B);
			}
		// }
		// $max = max($max, $steps, commonChild($A0, $B0, $ia + 1));
		// $steps = max($steps, commonChild($A0, $B0, $ia + 1));
		// $steps +
		print "end; steps=$steps max=$max\n\n";
	}
	die;
	$max = $steps;

	$mem[$k] = $max;

	printf("ret: %d start=%d steps=%d\n", $max, $istart, $steps);

	return $max;
}

$stdin = fopen("php://stdin", "r");

$s1 = trim(fgets($stdin));
$s2 = trim(fgets($stdin));

$result1 = commonChild($s1, $s2);
// $result2 = commonChild($s2, $s1);

print "$result1\n";
print_r($mem);
// print "$result2\n";

fclose($stdin);
