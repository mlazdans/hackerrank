<?php
#https://www.hackerrank.com/challenges/happy-ladybugs/problem

error_reporting(E_ALL);

function array_print($arr){
	return "[".join(",", $arr)."]";
}

function isHappy($a){
	$state = [
		'happy'=>true,
		'items'=>[],
	];
	for($i=0; $i<count($a);$i++){
		$st = [
			'color'=>$a[$i],
			'left'=>$i>0?$a[$i-1]:false,
			'right'=>$i+1<count($a)?$a[$i+1]:false,
		];
		$st['happy'] = ($st['left'] == $st['color']) || ($st['right'] == $st['color']);
		$state['items'] = $st;
		$state['happy'] = $state['happy'] && $st['happy'];
	}
	return $state;
}

function happyLadybugs($b) {
	$a = str_split(trim($b));

	$state = isHappy($a);
	if($state['happy']){
		return "YES";
	}

	$c = array_reduce($a, function($c, $i){
		$c[$i] = ($c[$i]??0) + 1;
		return $c;
	}, []);

	$emptyCellCount = $c["_"]??0;
	foreach($c as $color=>$count){
		if($color == '_'){
			continue;
		}
		if($count == 1){
			return "NO";
		}
	}
	return $emptyCellCount ? "YES" : "NO";
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $g);

for ($g_itr = 0; $g_itr < $g; $g_itr++) {
	fscanf($stdin, "%d\n", $n);

	$b = '';
	fscanf($stdin, "%[^\n]", $b);

	$result = happyLadybugs($b);

	fwrite($fptr, $result . "\n");
}

fclose($stdin);
fclose($fptr);
