<?php
#https://www.hackerrank.com/challenges/insertionsort2/problem

error_reporting(E_ALL);

// 1 4 3 5 6 2
function insertionSort2($n, $arr) {
	for($i=1;$i<count($arr);$i++){
		$j=$i;
		$v = $arr[$i];
		while($j && ($arr[$j - 1]>=$v)){
			$arr[$j] = $arr[$j-1];
			$j--;
		}
		$arr[$j] = $v;
		print join(" ", $arr)."\n";
	}
}

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $n);

fscanf($stdin, "%[^\n]", $arr_temp);

$arr = array_map('intval', preg_split('/ /', $arr_temp, -1, PREG_SPLIT_NO_EMPTY));

insertionSort2($n, $arr);

fclose($stdin);
