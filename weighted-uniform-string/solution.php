<?php
#https://www.hackerrank.com/challenges/weighted-uniform-string/problem

error_reporting(E_ALL);

function weightedUniformStrings($s, $queries) {
	$a = str_split(trim($s));
	$rep = [];
	for($i=0;$i<count($a);$i++){
		$j = $i + 1;
		$r = 1;
		while(($j<count($a)) && ($a[$i] == $a[$j])){
			$j++; $r++;
		}
		$rep[$a[$i]] = max($r, ($rep[$a[$i]]??0));
		$i = $j - 1;
	}

	$ret = [];
	foreach($queries as $q){
		$qr = "No";
		foreach($rep as $k=>$v){
			$w = ord($k) - 96;
			if($q % $w == 0){
				if($v * $w >= $q){
					$qr = "Yes";
					break;
				}
			}
		}
		$ret[] = $qr;
	}
	return $ret;
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

$s = '';
fscanf($stdin, "%[^\n]", $s);

fscanf($stdin, "%d\n", $queries_count);

$queries = array();

for ($i = 0; $i < $queries_count; $i++) {
    fscanf($stdin, "%d\n", $queries_item);
    $queries[] = $queries_item;
}

$result = weightedUniformStrings($s, $queries);

fwrite($fptr, implode("\n", $result) . "\n");

fclose($stdin);
fclose($fptr);
