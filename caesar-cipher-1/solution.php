<?php
#https://www.hackerrank.com/challenges/caesar-cipher-1/problem

error_reporting(E_ALL);

function array_print($arr){
	return "[".join(",", $arr)."]";
}

function caesarCipher($s, $k) {
	$ranges = [
		[ord('a'),ord('z')],
		[ord('A'),ord('Z')]
	];
	$ret = '';
	$a = str_split(trim($s));
	foreach($a as $c){
		$o = ord($c);
		$nc = $c;
		$nco = ord($c);
		foreach($ranges as $r){
			if(($o>=$r[0]) && ($o<=$r[1])){
				$nco = $r[0] + ($o - $r[0] + $k) % ($r[1] - $r[0] + 1);
				$nc = chr($nco);
			}
		}
		$ret.=$nc;
	}
	return $ret;
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $n);

$s = '';
fscanf($stdin, "%[^\n]", $s);

fscanf($stdin, "%d\n", $k);

$result = caesarCipher($s, $k);

fwrite($fptr, $result . "\n");

fclose($stdin);
fclose($fptr);
