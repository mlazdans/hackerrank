<?php
#https://www.hackerrank.com/challenges/halloween-sale/problem

error_reporting(E_ALL);

function array_print($arr){
	return "[".join(",", $arr)."]";
}

function howManyGames($p, $d, $m, $s) {
	$games = 0;
	while($s>=0){
		$games++;
		$s-=$p;
		$p-=$d;
		if($p<=$m){
			$p=$m;
		}
	}
	return $games - 1;
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%[^\n]", $pdms_temp);
$pdms = explode(' ', $pdms_temp);

$p = intval($pdms[0]);

$d = intval($pdms[1]);

$m = intval($pdms[2]);

$s = intval($pdms[3]);

$answer = howManyGames($p, $d, $m, $s);

fwrite($fptr, $answer . "\n");

fclose($stdin);
fclose($fptr);
