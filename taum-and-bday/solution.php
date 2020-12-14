<?php
#https://www.hackerrank.com/challenges/taum-and-bday/problem

error_reporting(E_ALL);

function taumBday($b, $w, $bc, $wc, $z) {
	if($bc+$z<$wc){
		$wc = $bc+$z;
	} elseif($wc+$z<$bc){
		$bc = $wc+$z;
	}
	return $b*$bc + $w*$wc;
}

$fptr = fopen("php://stdout", "w");

$t = intval(trim(fgets(STDIN)));

for ($t_itr = 0; $t_itr < $t; $t_itr++) {
    $first_multiple_input = explode(' ', rtrim(fgets(STDIN)));

    $b = intval($first_multiple_input[0]);

    $w = intval($first_multiple_input[1]);

    $second_multiple_input = explode(' ', rtrim(fgets(STDIN)));

    $bc = intval($second_multiple_input[0]);

    $wc = intval($second_multiple_input[1]);

    $z = intval($second_multiple_input[2]);

    $result = taumBday($b, $w, $bc, $wc, $z);

    fwrite($fptr, $result . "\n");
}

fclose($fptr);
