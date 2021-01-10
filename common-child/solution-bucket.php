<?php

// Complete the commonChild function below.
function buildBucket($A,$B){
	for($ia = 0; $ia<strlen($A); $ia++){
		if(stripos($B, $A[$ia], $ia) !== false){
			if(isset($bucket[$A[$ia]])){
				$bucket[$A[$ia]]++;
			} else {
				$bucket[$A[$ia]] = 1;
			}
		}
	}
	return $bucket;
}

function commonChild($A, $B) {
	$bucketA = buildBucket($A, $B);
	$bucketB = buildBucket($B, $A);
	$str = '';

	print "$A\n$B\n";
	printf("[%d,%d]\n", count($bucketA), count($bucketB));
	print_r($bucketA);
	print_r($bucketB);

	do {
		$pick = false;
		foreach($bucketA as $k=>$v){
			if(($v>0) && ($bucketB[$k]??0>0)){
				$pick = true;
				$str .= $k;
				$bucketA[$k]--;
				$bucketB[$k]--;
			}
		}
	} while($pick);

	print "$A\n$B\n";
	print_r($bucketA);
	print_r($bucketB);
	return $str;
}

$stdin = fopen("php://stdin", "r");

$s1 = trim(fgets($stdin));
$s2 = trim(fgets($stdin));

$result1 = commonChild($s1, $s2);
// $result2 = commonChild($s2, $s1);
print "$result1\n";
// print "$result2\n";

fclose($stdin);
