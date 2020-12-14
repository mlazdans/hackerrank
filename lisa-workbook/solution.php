<?php
#https://www.hackerrank.com/challenges/lisa-workbook/problem

error_reporting(E_ALL);

function workbook($n, $k, $arr) {
	$ret = 0;
	$page = 0;
	foreach($arr as $i=>$v){
		$pa = ceil($v / $k);
		//print "pa=$pa,v=$v\n";
		for($j=1;$j<=$pa;$j++){
			$page++;
			$s = min(($j - 1) * $k + 1, $v);
			$e = min($j * $k, $v);
			if(($page>=$s) && ($page<=$e)){
				$ret++;
			}
			//print "\tpage=$page,s=$s,e=$e,ret=$ret\n";
		}
	}
	return $ret;
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%[^\n]", $nk_temp);
$nk = explode(' ', $nk_temp);

$n = intval($nk[0]);

$k = intval($nk[1]);

fscanf($stdin, "%[^\n]", $arr_temp);

$arr = array_map('intval', preg_split('/ /', $arr_temp, -1, PREG_SPLIT_NO_EMPTY));

$result = workbook($n, $k, $arr);

fwrite($fptr, $result . "\n");

fclose($stdin);
fclose($fptr);
