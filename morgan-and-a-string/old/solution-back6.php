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

function morganAndString($A, $B, $ia = 0, $ib = 0, $c = '') {
	global $mem;

	$ia0 = $ia;
	$ib0 = $ib;

	// if($c){
	// 	$a = $A[$ia]??"}";
	// 	$b = $B[$ib]??"{";
	// 	if($a<$b)
	// }

	// foreach($mem as $r){
	// 	if(($ia>=$r[0]) && ($ib>=$r[1])){
	// 		print "mem:$r[2]\n";
	// 		return $r[2];
	// 	}
	// }

	$S = '';
	do {
		$a = $A[$ia]??"";
		$b = $B[$ib]??"";

		if(!$a && !$b){
			break;
		// } elseif($c){
		// 	if($a && ($a<$c)){
		// 		$S .= $a;
		// 		break;
		// 	} elseif($b && ($b<$c)){
		// 		$S .= $b;
		// 		break;
		// 	} else {
		// 		$S .= $c;
		// 		break;
		// 		// $ib++;
		// 		// $ia++;
		// 		// $S .= $c.$c;
		// 		//die("no-$c");
		// 	}
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
			// if(isset($mem[$k])){
			// 	// print "mem:$k\n";
			// 	if($mem[$k] == 'a'){
			// 		$ia++;
			// 	}
			// 	if($mem[$k] == 'b'){
			// 		$ib++;
			// 	}
			// } else {
			$S .= $a;
			// printf("need pick at ia=%d,ib=%d, a=%s,b=%s,S=%s\n", $ia-$ia0,$ib-$ib0,$a,$b,$S);
			printf("need pick at ia=%d,ib=%d, a=%s,b=%s,S=%s\n", $ia,$ib,$a,$b,$S);
			$pick1 = morganAndString($A, $B, $ia + 1, $ib, $a);
			$pick2 = morganAndString($A, $B, $ia, $ib + 1, $a);
			// if(isset($mem[$ia + 1][$ib])){
			// 	// print "mem1\n";
			// 	$pick1 = $mem[$ia + 1][$ib];
			// } else {
			// 	$pick1 = $mem[$ia + 1][$ib] = morganAndString($A, $B, $ia + 1, $ib, $a);
			// }

			// if(isset($mem[$ia][$ib + 1])){
			// 	// print "mem2\n";
			// 	$pick2 = $mem[$ia][$ib + 1];
			// } else {
			// 	$pick2 = $mem[$ia][$ib + 1] = morganAndString($A, $B, $ia, $ib + 1, $a);
			// }

			// print "pick:$pick1:$pick2\n";
			// die;
			if($pick1<$pick2){
				// print ":a\n";
				$S .= $pick1;
				// $ia++;
				// $mem[$k] = 'b';
				break;
			} else {
				// $mem[$k] = 'a';
				// print ":b\n";
				// $ib++;
				$S .= $pick2;
				break;
			}
		}
	} while($a || $b);

	return $S;

	// if(!isset($mem[$s1][$s2]) && !isset($mem[$s2][$s1])){
	// 	$mem[$s1][$s2] = $S;
	// }

	// $pad = str_repeat(" ", $d);
	// printf("%sia0=%d,ia=%d,a=%s, ib0=%d,ib=%d,b=%s, d=%d, S=%s\n", $pad, $ia0,$ia,$a, $ib0,$ib,$b,$d,$S);
	// print "A:".substr($A, $ia0, $ia-$ia0)."\n";
	// print "B:".substr($B, $ib0, $ib-$ib0)."\n";

	// print "\n";

	// foreach($mem as $i=>$r){
	// 	if($r[0])
	// 	// $mem[] = [$ia0,$ia, $ib0,$ib, $S];
	// }

	// print "ret:$S\n";
	// foreach($mem as $r){
	// 	if($r[0] == $ia0)
	// }

	// $s1 = substr($A, $ia0, $ia-$ia0);
	// $s2 = substr($B, $ib0, $ib-$ib0);

	// printf("!ia=%d,ib=%d, a=%s,b=%s,$s1+$s2=%s\n", $ia,$ib,$a,$b,$S);
	// print "stat\n";
	// print_r($mem);
	// $mem[] = [$ia, $ib, $S];




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
