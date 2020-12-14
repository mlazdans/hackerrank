<?php
#https://www.hackerrank.com/challenges/icecream-parlor/problem

error_reporting(E_ALL);

function icecreamParlor($m, $arr) {
	for($i=0;$i<count($arr)-1;$i++){
		for($j=$i+1;$j<count($arr);$j++){
			if($arr[$i] + $arr[$j] == $m){
				return [$i + 1,$j + 1];
			}
		}
	}
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $t);

for ($t_itr = 0; $t_itr < $t; $t_itr++) {
	fscanf($stdin, "%d\n", $m);

	fscanf($stdin, "%d\n", $n);

	fscanf($stdin, "%[^\n]", $arr_temp);

	$arr = array_map('intval', preg_split('/ /', $arr_temp, -1, PREG_SPLIT_NO_EMPTY));

	$result = icecreamParlor($m, $arr);

	fwrite($fptr, implode(" ", $result) . "\n");
}

fclose($stdin);
fclose($fptr);
