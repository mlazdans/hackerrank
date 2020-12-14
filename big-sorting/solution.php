<?php
#https://www.hackerrank.com/challenges/big-sorting/problem

error_reporting(E_ALL);

function array_print($arr){
	return "[".join(",", $arr)."]";
}

function bigSorting($a) {
	$sorter = function($a, $b){
		$la = strlen($a);
		$lb = strlen($b);
		if($la < $lb){
			return -1;
		} elseif($la > $lb){
			return 1;
		} else {
			for($i=0;$i<$la;$i++){
				$ca = (int)substr($a, $i, 1);
				$cb = (int)substr($b, $i, 1);
				if($ca < $cb){
					return -1;
				} elseif($ca > $cb){
					return 1;
				}
			}
		}
		return 0;
	};

	usort($a, $sorter);
	return $a;
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $n);

$unsorted = array();

for ($i = 0; $i < $n; $i++) {
	$unsorted_item = '';
	fscanf($stdin, "%[^\n]", $unsorted_item);
	$unsorted[] = $unsorted_item;
}

$result = bigSorting($unsorted);

fwrite($fptr, implode("\n", $result) . "\n");

fclose($stdin);
fclose($fptr);
