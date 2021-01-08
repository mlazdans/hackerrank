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

function pick($A, $B, $c, $ia, $ib){
	global $mem;

	$ia0 = $ia;
	$ib0 = $ib;
	// nomem: ANNANAANNANAANN
	// mem:   ANNANAANNNANAAN

	if(isset($mem['A'][$c]) && isset($mem['B'][$c])){
		if($mem['A'][$c]<$mem['B'][$c]){
			return "a";
		} elseif($mem['A'][$c]>$mem['B'][$c]){
			return "b";
		} else {
			return "";
		}
	}

	// if(isset($mem['A'][$c]) && isset($mem['B'][$c])){
	// 	if($mem['A'][$c]<$ia && $mem['B'][$c]<$ib){
	// 		print "isset\n";
	// 		die;
	// 		return $mem['A'][$c]-$ia<$mem['B'][$c]-$ib?"a":"b";
	// 	}
	// }

	$la = strlen($A);
	$lb = strlen($B);
	$pick = "";
	while($ia<$la||$ib<$lb){
		$a = $A[$ia]??"}";
		$b = $B[$ib]??"{";

		if($b < $c){
			$pick = "b";
			// $mem[] = [$ia,$ib,$pick];
			break;
		} elseif($a < $c){
			$pick = "a";
			// $mem[] = [$ia,$ib,$pick];
			break;
		} else {
			$ia++;
			$ib++;
		}
	}

	// print_r($mem);
	print "c=$c, ia=$ia,ib=$ib, pick=".($pick?$pick:"nopick")."\n";
	if(!$pick){
		$mem['A'][$c] = $ia;
		$mem['B'][$c] = $ib;
		// $pick = "a";
	}

	// $mem[] = [$ia,$ib,$pick];

	return $pick;
}

function morganAndString($A, $B, $ia = 0, $ib = 0) {
	// $la = strlen($A);
	// $lb = strlen($B);

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

		printf("ia=%d,a=%s, ib=%d,b=%s, len=%d, S=%s\n", $ia,$a, $ib,$b, strlen($S), $S);
		if($b < $a){
			// print "\$b < \$a = $b < $a\n";
			$ib++;
			$S .= $b;
		} elseif($a < $b){
			// print "\$a < \$b = $a < $b\n";
			$ia++;
			$S .= $a;
		} else {
			$pick = pick($A, $B, $a, $ia + 1, $ib + 1);
			if($pick == 'a'){
				// print "pick a\n";
				$ia++;
				$S .= $a;
			} elseif($pick == 'b'){
				// print "pick b\n";
				$ib++;
				$S .= $b;
			} else {
				// print "pick both\n";
				$S .= "$a$b";
				$ia++;
				$ib++;
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

	//printf("ia=%d,a=%s, ib=%d,b=%s\n", $ia,$a, $ib,$b);
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

	// print_r($mem);
	// print "$a\n$b\nANNANAANNANAANN\n\n";

	fwrite($fptr, $result . "\n");
}

fclose($stdin);
fclose($fptr);
