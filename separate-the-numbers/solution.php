<?php
#https://www.hackerrank.com/challenges/separate-the-numbers/problem

error_reporting(E_ALL);

function separateNumbers($s) {
	$s = trim($s);
	for($len=1;floor($len<=strlen($s)/2);$len++){
		$i = 0;
		$f = true;
		$l = $len;
		$check = substr($s, 0, $l);
		do {
			$s1 = (int)substr($s, $i, $l);
			$s2 = ($s1 + 1);
			$s3 = substr($s, $i + $l, strlen($s2));
			if(($s1 + 1) != $s3){
				$f = false;
				break;
			}
			$l = strlen($s2);
			$i += strlen($s1);
		} while($i + $l<strlen($s));
		if($f){
			break;
		}
	}
	print $f ? "YES $check\n" : "NO\n";
}

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $q);

for ($q_itr = 0; $q_itr < $q; $q_itr++) {
	$s = '';
	fscanf($stdin, "%[^\n]", $s);

	separateNumbers($s);
}

fclose($stdin);
