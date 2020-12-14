<?php
#https://www.hackerrank.com/challenges/acm-icpc-team/problem

error_reporting(E_ALL);

function array_print($arr){
	return "[".join(",", $arr)."]";
}

function acmTeam($topic) {
	foreach($topic as $i=>$line){
		$topic[$i] = str_split(trim($line));
		//print "$i=".array_print($topic[$i])."\n";
	}
	//print "\n";

	$map = [];
	for($i=0;$i<count($topic)-1;$i++){
		for($j=$i + 1;$j<count($topic);$j++){
			$line = [];
			foreach($topic[$i] as $bi=>$b){
				$line[] = $topic[$j][$bi] | $topic[$i][$bi];
			}
			//print "[$i,$j]=".array_print($line)."\n";
			//$map[$i] = max(array_sum($line), $map[$i]??0);
			$map[] = array_sum($line);
		}
	}
	//print_r($map);
	$max = max($map);
	$count = array_reduce($map, function($c,$i) use ($max){
		return $i == $max ? $c + 1 : $c;
	}, 0);

	return [$max, $count];
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%[^\n]", $nm_temp);
$nm = explode(' ', $nm_temp);

$n = intval($nm[0]);

$m = intval($nm[1]);

$topic = array();

for ($i = 0; $i < $n; $i++) {
	$topic_item = '';
	fscanf($stdin, "%[^\n]", $topic_item);
	$topic[] = $topic_item;
}

$result = acmTeam($topic);

fwrite($fptr, implode("\n", $result) . "\n");

fclose($stdin);
fclose($fptr);
