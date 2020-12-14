<?php
#https://www.hackerrank.com/challenges/two-characters/problem

error_reporting(E_ALL);

function charmap($s){
	$Map = [];
	for($i=0;$i<strlen($s);$i++){
		$c = substr($s,$i,1);
		$Map[$c] = ($Map[$c]??0) + 1;
	}
	return $Map;
}

function isAlternating($s1){
	$l = strlen($s1);
	$c1 = substr($s1, 0, 1);
	$c2 = substr($s1, 1, 1);
	if(($l < 2) || ($c1 == $c2)){
		return false;
	}
	$pos = 0;
	while($pos<$l){
		$c3 = substr($s1, $pos, 1);
		$c4 = substr($s1, $pos+1, 1);
		if($c1 != $c3){
			return false;
		}
		if(($pos+1<$l) && ($c2 != $c4)){
			return false;
		}
		$pos+=2;
	}
	return true;
}

function alternate($s) {
	if(isAlternating($s)){
		return strlen($s);
	}

	$map = charmap(trim($s));
	arsort($map);
	$keys = array_keys($map);
	$max = 0;
	for($i=0;$i<count($keys)-1;$i++){
		for($z=$i+1;$z<count($keys)-1;$z++){
			$c1 = $keys[$i];
			$c2 = $keys[$z];
			$s1 = preg_replace("/[^$c1$c2]/", "", $s);
			//print "[c1=$c1,c2=$c2]=$s1\n";
			if(isAlternating($s1)){
				//print "[alter]=$s1\n";
				$max = max($max, strlen($s1));
			}
		}
	}
	return $max;
}

$fptr = fopen("php://stdout", "w");

$l = intval(trim(fgets(STDIN)));

$s = rtrim(fgets(STDIN), "\r\n");

$result = alternate($s);

fwrite($fptr, $result . "\n");

fclose($fptr);
