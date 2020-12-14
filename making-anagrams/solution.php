<?php
#https://www.hackerrank.com/challenges/making-anagrams/problem

error_reporting(E_ALL);

function charmap($s){
	for($i=0;$i<strlen($s);$i++){
		$c = substr($s,$i,1);
		$Map[$c] = ($Map[$c]??0) + 1;
	}
	return $Map??[];
}

function unsets(&$map1, &$map2){
	$del = 0;
	foreach($map1 as $k=>$v){
		if(!isset($map2[$k])){
			//print "unset(map1[$k])\n";
			unset($map1[$k]);
			$del += $v;
		}
	}
	return $del;
}

function subtracts(&$map1, &$map2){
	$del = 0;
	foreach($map1 as $k=>$v){
		if(isset($map2[$k])){
			$del += abs($map2[$k] - $v);
			unset($map2[$k]);
			unset($map1[$k]);
		}
	}
	return $del;
}

function makingAnagrams($s1, $s2) {
	$s1map = charmap(trim($s1));
	$s2map = charmap(trim($s2));
	//print_r($s1map);
	//print_r($s2map);

	$del = 0;
	$del += unsets($s1map, $s2map);
	$del += unsets($s2map, $s1map);
	$del += subtracts($s1map, $s2map);
	$del += subtracts($s2map, $s1map);
	//print_r($s1map);
	//print_r($s2map);

	return $del;
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

$s1 = '';
fscanf($stdin, "%[^\n]", $s1);

$s2 = '';
fscanf($stdin, "%[^\n]", $s2);

$result = makingAnagrams($s1, $s2);

fwrite($fptr, $result . "\n");

fclose($stdin);
fclose($fptr);
