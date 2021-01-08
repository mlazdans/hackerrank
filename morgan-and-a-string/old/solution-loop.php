<?php
#https://www.hackerrank.com/challenges/morgan-and-a-string/problem

ini_set("memory_limit", "1G");

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

function morganAndString($A, $B, $ia = 0, $ib = 0) {
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
			// printf("need pick at ia=%d,ib=%d, a=%s,b=%s,S=%s\n", $ia-$ia0,$ib-$ib0,$a,$b,$S);
			printf("need pick at ia=%d,ib=%d, a=%s,b=%s,S=%s\n", $ia,$ib,$a,$b,$S);
			$pick1 = morganAndString($A, $B, $ia + 1, $ib);
			$pick2 = morganAndString($A, $B, $ia, $ib + 1);
			print "picked\n";
			if($pick1<$pick2){
				$S .= $pick1;
				break;
			} else {
				$S .= $pick2;
				break;
			}
		}
	} while($a || $b);

	printf("ret at ia=%d,ib=%d, a=%s,b=%s,S=%s\n", $ia,$ib,$a,$b,$S);
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

	// print_r($mem);
	// print "$a\n$b\n";

	fwrite($fptr, $result . "\n");
}

fclose($stdin);
fclose($fptr);
