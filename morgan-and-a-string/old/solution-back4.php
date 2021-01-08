<?php
#https://www.hackerrank.com/challenges/morgan-and-a-string/problem

ini_set("memory_limit", "12G");

// DAJACKNIEL
// JACK
// DANIEL
// bbaaaabbbb

// AABABACABACABA
// ABACABA
// ABACABA

function pick($A, $B, $ia, $ib){
	global $mem;

	// nomem: ANNANAANNANAANN
	// mem:   ANNANAANNNANAAN

	$la = strlen($A);
	$lb = strlen($B);
	$pick = "";
	while($ia<$la||$ib<$lb){
		$a = $A[$ia]??"";
		$b = $B[$ib]??"";

		if($a == $b){
			$ia++; $ib++;
		} elseif($b < $a){
			$pick = "b";
			// $mem[] = [$ia,$ib,$pick];
			break;
		} elseif($a < $b){
			$pick = "a";
			// $mem[] = [$ia,$ib,$pick];
			break;
		}
	}

	// print "pick=$pick\n";
	if(!$pick){
		$pick = "a";
		// print "nopikk\n";
	}

	// $mem[] = [$ia,$ib,$pick];

	return $pick;
}

function morganAndString($A, $B, $ia = 0, $ib = 0) {
	global $mem;

	// $la = strlen($A);
	// $lb = strlen($B);

	$k = "$ia,$ib";
	// if(isset($mem[$k])){
	// 	print "mem\n";
	// 	return $mem[$k];
	// }

	$S = '';
	do{
		$a = $A[$ia]??"";
		$b = $B[$ib]??"";

		if(!$a){
			$ib++;
			$S .= $b;
			continue;
		}

		if(!$b){
			$ia++;
			$S .= $a;
			continue;
		}

		if($b < $a){
			$ib++;
			$S .= $b;
		} elseif($a < $b){
			$ia++;
			$S .= $a;
		} else {
			$pick = pick($A, $B, $ia + 1, $ib + 1);
			if($pick == 'a'){
				$ia++;
				$S .= $a;
			} else {
				$ib++;
				$S .= $b;
			}
		}
	} while($a || $b);

	return $S;



	if(!$a && !$b){
		return "";
	} elseif(!$a){
		return $b.morganAndString($A, $B, $ia, $ib + 1);
	} elseif(!$b){
		return $a.morganAndString($A, $B, $ia + 1, $ib);
	}

	printf("ia=%d,a=%s, ib=%d,b=%s\n", $ia,$a, $ib,$b);
	if($b < $a){
		return $b.morganAndString($A, $B, $ia, $ib + 1);
	} elseif($a < $b){
		return $a.morganAndString($A, $B, $ia + 1, $ib);
	} else { // $a == $b
		$pick = pick($A, $B, $ia + 1, $ib + 1);
		if($pick == 'a'){
			return $a.morganAndString($A, $B, $ia + 1, $ib);
		} else {
			return $b.morganAndString($A, $B, $ia, $ib + 1);
		}
		// print "picked: $pick\n";
		// die;
		// $pick1 = morganAndString($A, $B, $ia + 1, $ib);
		// $pick2 = morganAndString($A, $B, $ia, $ib + 1);
		// if(!$pick){
		// 	$pick = $a.morganAndString($A, $B, $ia + 1, $ib);
		// 	if(!$pick){
		// 		$pick = $b.morganAndString($A, $B, $ia, $ib + 1);
		// 	}
		// } else {
		// }
		// print "picked: $pick1:$pick2\n";
		// return $mem[$k] = ($pick1<$pick2?$a.$pick1:$b.$pick2);
		//return $pick;
		// $pick = pick($A, $B, $a, $ia + 1, $ib + 1);
		// if($pick == 'a'){
		// 	return $a.morganAndString($A, $B, $ia + 1, $ib);
		// } else {
		// 	return $b.morganAndString($A, $B, $ia, $ib + 1);
		// }

		// printf("ia=%d,a=%s, ib=%d,b=%s, pick=%s\n", $ia,$a, $ib,$b, $pick);
		// $S = morganAndString($A, $B, $ia + 1, $ib + 1);
		// $S2 = morganAndString($A, $B, $ia, $ib + 1);
		// print "S1=$S\n\n";
		// die('die');

		//return $S.morganAndString($A, $B, $ia + , $ib);
	}

	// $S = '';
	// while(($ia<$la)||($ib<$lb)) {
	// 	$a = $A[$ia]??"{";
	// 	$b = $B[$ib]??"}";

	// 	$pick = '';
	// 	if($a == $b){
	// 		//$pick = pick($A, $B, $a, $ia + 1, $ib + 1);
	// 		$pick = pick($A, $B, $a, $ia + 1, $ib + 1);
	// 	} elseif($a > $b){
	// 		$pick = "b";
	// 	} else {
	// 		$pick = "a";
	// 	}

	// 	// printf("ia=%d,a=%s, ib=%d,b=%s, pick=%s, len=%d, S=%s\n", $ia,$a, $ib,$b, $pick, strlen($S), $S);
	// 	if($pick == 'a'){
	// 		$S .= $a;
	// 		$ia++;
	// 		// $S .= substr($A, $ia0, $ia - $ia0);
	// 	} elseif($pick == 'b'){
	// 		$S .= $b;
	// 		$ib++;
	// 		// $S .= substr($B, $ib0, $ib - $ib0);
	// 	}

	// 	// printf("ia0=%d,ia=%d,a=%s, ib0=%d,ib=%d,b=%s, pick=%s, len=%d, S=%s\n", $ia0,$ia,$a, $ib0,$ib,$b, $pick, strlen($S), $S);
	// };

	// return $S;
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
	// print "ANNANAANNANAANN\n";

	fwrite($fptr, $result . "\n");
}

fclose($stdin);
fclose($fptr);
