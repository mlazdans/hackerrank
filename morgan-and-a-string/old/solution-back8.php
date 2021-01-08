<?php
#https://www.hackerrank.com/challenges/morgan-and-a-string/problem

// ini_set("memory_limit", "1G");

// DAJACKNIEL
// JACK
// DANIEL
// bbaaaabbbb

// AABABACABACABA
// ABACABA
// ABACABA

// ANNANAAN
// NNANAAN
// nomem: ANNANAANNANAANN
// mem:   ANNANAANNNANAAN

// function lookup($S, $c, $i){
// 	while($s = $S[++$i]??""){
// 		if($s<$c){
// 			return $i;
// 		}
// 	}

// 	return false;
// }

// function lookup($A, $B, $ia0, $ib0, $c) {
// 	$ia = $ia0;
// 	$ib = $ib0;
// 	$S = $pick = "";
// 	do {
// 		$a = $A[$ia]??"";
// 		$b = $B[$ib]??"";
// 		if(($a == $b) && ($b == $c)){
// 			$ia++;
// 			$ib++;
// 		} elseif($a < $c){
// 			$pick = "a";
// 			break;
// 		} elseif($b < $c){
// 			$pick = "b";
// 			break;
// 		}
// 	} while($a || $b);
// 	printf("lookup ia=%d,ib=%d, pick=%s\n", $ia,$ib,$pick);
// 	return [$ia,$ib,$pick];
// }

function morganAndString($A, $B, $ia0 = 0, $ib0 = 0) {
	global $mem;

	$ia = $ia0;
	$ib = $ib0;
	// if(isset($mem['A'][$ib])){
	// 	print "mem\n";
	// 	return $mem[$ia][$ib];
	// }

	$S = '';
	do {
		$a = $A[$ia]??"";
		$b = $B[$ib]??"";

		if(!$a && !$b){
			break;
		} elseif(!$a){
			$S .= substr($B, $ib);
			break;
		} elseif(!$b){
			$S .= substr($A, $ia);
			break;
		} elseif($b < $a){
			$S .= $b;
			$ib++;
		} elseif($a < $b){
			$S .= $a;
			$ia++;
		} else { // $a == $b
			$S .= $a;
			// TODO: some zipping
			printf("need pick at ia=%d,ib=%d, a=%s,b=%s,S=%s\n", $ia,$ib,$a,$b,$S);
			$pick1 = morganAndString($A, $B, $ia + 1, $ib);
			$pick2 = morganAndString($A, $B, $ia, $ib + 1);
			die;
			// $mem[$ia + 1][$ib] = $pick1;
			$pick2 = morganAndString($A, $B, $ia, $ib + 1);
			print "picked:$pick1<$pick2\n";
			// $mem[$ia][$ib + 1] = $pick2;
			if($pick1<$pick2){
				$S .= $pick1;
			} else {
				$S .= $pick2;
			}
			break;
		}
	} while(true);

	$mem[$ia0][$ib0] = $S;

	return $S;
}

$fptr = fopen("php://stdout", "w");
$stdin = fopen("php://stdin", "r");

$t = (int)fgets($stdin);

for ($t_itr = 0; $t_itr < $t; $t_itr++) {
	$a = trim(fgets($stdin));
	$b = trim(fgets($stdin));

	$mem = [];
	$result = morganAndString($a, $b);
	print_r($mem);
	// print "AABABACABACABA\n";
	print "ANNANAANNANAANN\n";

	fwrite($fptr, $result . "\n");
}

fclose($stdin);
fclose($fptr);
