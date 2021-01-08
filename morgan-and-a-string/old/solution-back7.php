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

function morganAndString($A, $B, $ia = 0, $ib = 0, $c = 0) {
	global $mem;

	$a = $A[$ia]??"";
	$b = $B[$ib]??"";
	$k = $c;
	$mk = $mem[$k]??"";

	$pad = str_repeat(" ", $k);
	// printf("%sia=%d,ib=%d, a=%s,b=%s, k=%s, mk=%s\n", $pad, $ia,$ib,$a,$b, $k,$mk);

	if(!$a && !$b){
		$mem[$k] = "";
	} elseif(!$a){
		if(!$mk || ($b<$mk)){
			$mem[$k] = $b;
			return morganAndString($A, $B, $ia, $ib + 1, $c + 1);
		}
	} elseif(!$b){
		if(!$mk || ($a<$mk)){
			$mem[$k] = $a;
			return morganAndString($A, $B, $ia + 1, $ib, $c + 1);
		}
	} elseif($b < $a){
		if(!$mk || ($b<$mk)){
			$mem[$k] = $b;
			return morganAndString($A, $B, $ia, $ib + 1, $c + 1);
		}
	} elseif($a < $b){
		if(!$mk || ($a<$mk)){
			$mem[$k] = $a;
			return morganAndString($A, $B, $ia + 1, $ib, $c + 1);
		}
	} else { // $a == $b
		printf("need pick at ia=%d,ib=%d, a=%s,b=%s\n", $ia,$ib,$a,$b);
		$mem[$k] = $a;
		morganAndString($A, $B, $ia + 1, $ib, $c + 1);
		print $mem[$k+1];
		printf("%sia=%d,ib=%d, a=%s,b=%s, k=%s\n", $pad, $ia,$ib,$a,$b, $k);
		die;
		// }
		// if($pick && ($pick<$mem[$k])){
		// 	$mem[$k]=$pick;
		// }
		// if($a<$mem[$k]){
		// 	$mem[$k] = $a;
		// }
		// if($a<=($mem[$k+1]??"}")){
		// 	// $mem[$k+1]=$a;
		morganAndString($A, $B, $ia, $ib + 1, $c + 1);
		// }
	}
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
	// // print "$a\n$b\n";
	// print "AABABACABACABA\n";
	// print "ANNANAANNANAANN\n";

	for($i=0;$i<count($mem);$i++){
		$e = $mem[$i]??"_";
		print $e;
	}
	// print "\n";
	// fwrite($fptr, $result . "\n");
}

fclose($stdin);
fclose($fptr);
