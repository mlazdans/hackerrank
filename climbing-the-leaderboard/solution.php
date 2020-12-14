<?php
#https://www.hackerrank.com/challenges/climbing-the-leaderboard/problem

error_reporting(E_ALL);

function findScoreI(Array $arr, $x){
	$mid = $low = 0;
	$high = count($arr) - 1;
	while ($low <= $high) {
		$mid = floor(($low + $high) / 2);
		if ($x > $arr[$mid]) {
			$high = $mid -1;
		} elseif($x <= $arr[$mid]) {
			$low = $mid + 1;
		}
	}

	return $low;
}

function insertScore(&$scores, &$ranks, $sc){
	$si = findScoreI($scores, $sc);
	$scores[$si] = $sc;
	if($si > 0){
		$ranks[$si] = $ranks[$si - 1] + 1;
		$ranks[$si] = $scores[$si - 1] == $scores[$si] ? $ranks[$si - 1] : $ranks[$si];
	}
	return $ranks[$si];
}

function climbingLeaderboard($scores, $alice) {
	$r = 0;
	$oldsc = -1;
	$ranks = [];
	foreach($scores as $i=>$sc){
		if($sc != $oldsc){
			$r++;
			$oldsc = $sc;
		}
		$ranks[$i] = $r;
	}
	$ret = [];
	foreach($alice as $sc){
		$ret[] = insertScore($scores, $ranks, $sc);
	}
	return $ret;
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $scores_count);

fscanf($stdin, "%[^\n]", $scores_temp);

$scores = array_map('intval', preg_split('/ /', $scores_temp, -1, PREG_SPLIT_NO_EMPTY));

fscanf($stdin, "%d\n", $alice_count);

fscanf($stdin, "%[^\n]", $alice_temp);

$alice = array_map('intval', preg_split('/ /', $alice_temp, -1, PREG_SPLIT_NO_EMPTY));

$result = climbingLeaderboard($scores, $alice);

fwrite($fptr, implode("\n", $result) . "\n");

fclose($stdin);
fclose($fptr);
