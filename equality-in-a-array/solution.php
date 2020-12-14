<?php
#https://www.hackerrank.com/challenges/equality-in-a-array/problem

error_reporting(E_ALL);

function equalizeArray($arr) {
	sort($arr, SORT_NUMERIC);
	$max = 0;
	for($i=0;$i<count($arr);$i++){
		$eqc = 0;
		for($j=$i;$j<count($arr);$j++){
			if($arr[$i]==$arr[$j]) {
				$eqc++;
			} else {
				break;
			}
		}
		//print "$i:$j:$eqc\n";
		if($eqc>$max){
			$max=$eqc;
		}
	}
	return count($arr) - $max;
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $n);

fscanf($stdin, "%[^\n]", $arr_temp);

$arr = array_map('intval', preg_split('/ /', $arr_temp, -1, PREG_SPLIT_NO_EMPTY));

$result = equalizeArray($arr);

fwrite($fptr, $result . "\n");

fclose($stdin);
fclose($fptr);
