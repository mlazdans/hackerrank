<?php
# https://www.hackerrank.com/challenges/digital-camera-day-or-night

error_reporting(E_ALL);

function color_decode($c)
{
	return explode(",", $c);
} // color_decode

function brightness($c)
{
	return array_sum(color_decode($c)) / 3;
} // brightness

$buf = '';
$br = array();
while(!feof(STDIN)){
	$c = fgetc(STDIN);
	if(preg_match("/\s/", $c)){
		if($buf = trim($buf)) {
			$br[] = brightness($buf);
			$buf = '';
		}
		continue;
	}
	$buf .= $c;
}

print array_sum($br) / count($br) > 64 ? "day" : "night";

