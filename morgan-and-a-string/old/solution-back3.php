<?php
#https://www.hackerrank.com/challenges/morgan-and-a-string/problem

// DAJACKNIEL
// JACK
// DANIEL

// AABABACABACABA
// ABACABA
// ABACABA

function pick($A, $B, $ia, $ib){
	global $ranges;

	$ia0 = $ia;
	$ib0 = $ib;
	// foreach($ranges as $r){
	// 	if(
	// 		(($ia>=$r[0]) && ($ia<=$r[1])) &&
	// 		(($ib>=$r[0]) && ($ib<=$r[1]))
	// 	){
	// 		print "mem\n";
	// 		return $r[2];
	// 	}
	// }

	$la = strlen($A);
	$lb = strlen($B);
	$ret = "";
	// $ret = $lb<$la"a";
	// $ret = $lb-$ib>$la-$ia?"b":"a";
	while(!$ret && ($ia<$la||$ib<$lb)){
		// $a = $A[$ia]??"~";
		// $b = $B[$ib]??"~";

		if($ia==$la){
			$ret = "a";
		} else if($ib==$lb){
			$ret = "b";
		} elseif($A[$ia] == $B[$ib]){
			$ia++; $ib++;
		} elseif($A[$ia] > $B[$ib]){
			$ret = "b";
		} else {
			$ret = "a";
		}
	}

	return [
		$ia,
		$ib,
		$ret?$ret:"a"
	];
}

function morganAndString($A, $B) {
	$ia = $ib = 0;
	$la = strlen($A);
	$lb = strlen($B);

	$S = '';
	while(($ia<$la)||($ib<$lb)){
		$a = $A[$ia]??"~";
		$b = $B[$ib]??"~";
		// printf("ia=%d,a=%s, ib=%d,b=%s, len=%d, S=%s\n", $ia, $a, $ib, $b, strlen($S), $S);

		$pick = '';
		if($a == $b){
			$pick = pick($A, $B, $ia + 1, $ib + 1);
			print_r($pick);
			die;
			// print "pick=$pick\n";
		} elseif($a < $b){
			$pick = "a";
		} elseif($a > $b){
			$pick = "b";
		}

		if($pick == 'a'){
			$S .= $a;
			$ia++;
		} else {
			$S .= $b;
			$ib++;
		}
	}

	// print "S=$S\n";
	// printf("ia=%d,a=%s, ib=%d,b=%s\n", $ia, $A[$ia]??'-', $ib, $B[$ib]??'-');
	// print $pick;
	// die;
	return $S;
}

$fptr = fopen("php://stdout", "w");
$stdin = fopen("php://stdin", "r");

$t = (int)fgets($stdin);

for ($t_itr = 0; $t_itr < $t; $t_itr++) {
	$a = trim(fgets($stdin));
	$b = trim(fgets($stdin));

	$ranges = [];
	$result = morganAndString($a, $b);

	fwrite($fptr, $result . "\n");
}

fclose($stdin);
fclose($fptr);
