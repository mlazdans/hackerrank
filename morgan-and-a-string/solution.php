<?php
#https://www.hackerrank.com/challenges/morgan-and-a-string/problem

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

function zip($A, $B, $ia0, $ib0, $c) {
	global $zip;

	if(isset($zip[$ia0][$ib0])){
		return $zip[$ia0][$ib0];
	}

	$ia = $ia0; $ib = $ib0;

	while(($a = $A[$ia]??"") && ($b = $B[$ib]??"")) {
		if(($a == $b) && ($b == $c)){
			$ia++; $ib++;
		} else {
			break;
		}
	};

	$l = $ia-$ia0;
	// printf("inzip: ia=%d(%d) ib=%d(%d) [c=%s], l=%d\n", $ia,$ia0, $ib,$ib0, $c, $l);

	return $zip[$ia0][$ib0] = ($l ? [str_repeat($c, $l), $l] : false);
}

function lookup($A, $B, $ia0, $ib0) {
	global $lookup;

	if(isset($lookup[$ia0][$ib0])){
		return $lookup[$ia0][$ib0];
	}

	$ia = $ia0; $ib = $ib0;
	$pick = "";

	do {
		$a = $A[$ia]??"";
		$b = $B[$ib]??"";

		if(!$a && !$b){
			$pick = "";
			break;
		} elseif(!$a){
			$pick = "b";
			break;
		} elseif(!$b){
			$pick = "a";
			break;
		} elseif($a == $b){
			$ia++; $ib++;
		} elseif($a < $b){
			$pick = "a";
			break;
		} elseif($b < $a){
			$pick = "b";
			break;
		} else {
			$pick = "";
			break;
		}
	} while($a || $b);

	return $lookup[$ia0][$ib0] = ($pick ? [$pick, $ia, $ib] : false);
}

function morganAndString($A, $B, $ia0 = 0, $ib0 = 0) {
	$ia = $ia0;
	$ib = $ib0;

	$S = '';
	do {
		$a = $A[$ia]??"";
		$b = $B[$ib]??"";

		// printf("loop: ia=%d(%d) ib=%d(%d) a=%s, b=%s l=%d, S=%s\n", $ia,$ia0,$ib,$ib0, $a, $b, strlen($S),"-");
		if(!$a){
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
			// printf("need pick: ia=%d(%d) ib=%d(%d) [c=%s] l=%d, S=%s\n", $ia,$ia0,$ib,$ib0, $a,strlen($S),$S);

			if(($L = lookup($A, $B, $ia + 1, $ib + 1, $a)) !== false){
				list($pick) = $L;
				$S .= $a;
				if($pick == 'a'){
					$ia++;
				} else {
					$ib++;
				}
			} else {
				if(($Z = zip($A, $B, $ia, $ib, $a)) !== false){
					list($zip, $l) = $Z;
					$S .= $zip;
				}

				$p1 = morganAndString($A, $B, $ia + $l, $ib);
				$p2 = morganAndString($A, $B, $ia, $ib + $l);

				// printf("picked: ia=%d(%d) ib=%d(%d) [c=%s] l=%d, S=%s\n", $ia,$ia0,$ib,$ib0, $a,strlen($S),$S);

				if($p1<$p2){
					$S .= $p1;
				} else{
					$S .= $p2;
				}
				break;
			}
		}
	} while($a || $b);

	return $S;
}

$fptr = fopen("php://stdout", "w");
$stdin = fopen("php://stdin", "r");

$t = (int)fgets($stdin);

for ($t_itr = 0; $t_itr < $t; $t_itr++) {
	$a = trim(fgets($stdin));
	$b = trim(fgets($stdin));

	$zip = $lookup = $mem = [];
	$result = morganAndString($a, $b);

	fwrite($fptr, $result . "\n");
}

fclose($stdin);
fclose($fptr);
