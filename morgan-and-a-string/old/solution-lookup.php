<?php
#https://www.hackerrank.com/challenges/morgan-and-a-string/problem

// ini_set("memory_limit", "12G");

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

function lookup($S, $c, $i){
	while($s = $S[++$i]??""){
		if($s<$c){
			return $i;
		}
	}

	return false;
}

function morganAndString($A, $B, $ia = 0, $ib = 0) {
	global $mem;

	$S = '';
	do {
		$a = $A[$ia]??"";
		$b = $B[$ib]??"";
		// printf("ia=%d,a=%s, ib=%d,b=%s,S=%s\n", $ia,$a, $ib,$b,$S);

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
			print "must pick ($a) at ia=$ia, ib=$ib\n";
			$ia0 = $ia;
			$ib0 = $ib;
			while(true) {
				$ia0 = lookup($A, $a, $ia0);
				$ib0 = lookup($B, $a, $ib0);

				if($ia0 === false || $ib0 === false || $A[$ia0] != $B[$ib0]){
					break;
				}

				$ia0++; $ib0++;
			};

			var_dump($ia0);
			var_dump($ib0);

			$pick = "";
			if($ia0 && $ib0){
				$da = $ia0 - $ia;
				$db = $ib0 - $ib;
				print "diff:$da:$db\n";
				if($da<$db){
					$pick = "a";
				} elseif($db<$da){
					$pick = "b";
				} elseif($A[$ia0] < $B[$ib0]){
					$pick = "a";
				} else {
					$pick = "b";
				}
			} elseif($ia0){
				print "ia0\n";
				$pick = "a";
			} elseif($ib0){
				print "ib0\n";
				$pick = "b";
			} else {
				$p1 = morganAndString($A, $B, $ia + 1, $ib);
				$p2 = morganAndString($A, $B, $ia, $ib + 1);
				if($p1[0] < $p2[0]){
					$pick = "a";
				} else {
					$pick = "b";
				}
			}

			if($pick == "a"){
				$ia++;
			} elseif($pick == "b"){
				$ib++;
			}

			print "picked=$pick\n";
			$S .= $a;
			// $lookupA[$a] = $ia0;

			// print "$ia0:$ib0 - $a0:$b0\n";
			// die('must pick');

			// $S .= $a;
			// if(isset($mem[$k])){
			// 	// print "mem:$k\n";
			// 	if($mem[$k] == 'a'){
			// 		$ia++;
			// 	}
			// 	if($mem[$k] == 'b'){
			// 		$ib++;
			// 	}
			// } else {
			// 	$pick1 = morganAndString($A, $B, $ia + 1, $ib);
			// 	$pick2 = morganAndString($A, $B, $ia, $ib + 1);

			// 	if($pick1<$pick2){
			// 		$S .= $pick1;
			// 		$mem[$k] = 'b';
			// 		break;
			// 	} else {
			// 		$mem[$k] = 'a';
			// 		$S .= $pick2;
			// 		break;
			// 	}
			// }
		}
	} while($a || $b);

	// $pad = str_repeat(" ", $d);
	// printf("%sia0=%d,ia=%d,a=%s, ib0=%d,ib=%d,b=%s, d=%d, S=%s\n", $pad, $ia0,$ia,$a, $ib0,$ib,$b,$d,$S);
	// print "A:".substr($A, $ia0, $ia-$ia0)."\n";
	// print "B:".substr($B, $ib0, $ib-$ib0)."\n";

	// print "\n";

	// foreach($mem as $i=>$r){
	// 	if($r[0])
	// 	// $mem[] = [$ia0,$ia, $ib0,$ib, $S];
	// }

	return $S;

	// $pad = str_repeat(" ", $d);
	// printf("%sia=%d,a=%s, ib=%d,b=%s,S=%s\n", $pad, $ia,$a, $ib,$b,$S);
	// if(isset($mem[$k])){
	// 	print "mem:\n";
	// 	return $mem[$k];
	// }
	// if(isset($mem[$ia][$ib])){
	// 	print "mem:".$mem[$ia][$ib]."\n";
	// 	return $mem[$ia][$ib];
	// }

	// if(!$a && !$b){
	// 	return $S;
	// } elseif(!$a){
	// 	return morganAndString($A, $B, $ia, $ib + 1, $d + 1, $S.$b);
	// } elseif(!$b){
	// 	return morganAndString($A, $B, $ia + 1, $ib, $d + 1, $S.$a);
	// } elseif($b < $a){
	// 	return morganAndString($A, $B, $ia, $ib + 1, $d + 1, $S.$b);
	// } elseif($a < $b){
	// 	return morganAndString($A, $B, $ia + 1, $ib, $d + 1, $S.$a);
	// } else { // $a == $b
	// 	$pick1 = morganAndString($A, $B, $ia + 1, $ib, $d + 1, $S.$b);
	// 	$pick2 = morganAndString($A, $B, $ia, $ib + 1, $d + 1, $S.$b);
	// 	if($pick1>$pick2){
	// 		return $pick2;
	// 	} else {
	// 		return $pick1;
	// 	}
	// }

	// $mem[$ia][$ib] = $S;
	// $pad = str_repeat(" ", $d);
	// printf("%sia=%d,a=%s, ib=%d,b=%s, S=%s\n", $pad, $ia,$a, $ib,$b, $S);

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
	// print "$a\n$b\n";

	fwrite($fptr, $result . "\n");
}

fclose($stdin);
fclose($fptr);
