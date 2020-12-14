<?php

/*
A=65
Z=90
25 total

DADADD
ABBCBACBA
BABABC
DABCDAD
YZYYZYYZYZYYZYZYY
*/

# https://www.hackerrank.com/challenges/morgan-and-a-string

error_reporting(E_ALL);

$K = (int)fgets(STDIN);
for($r=0; $r<$K; $r++){
	$A = trim(fgets(STDIN));
	$B = trim(fgets(STDIN));
	$la = strlen($A);
	$lb = strlen($B);

	$S = ''; $pa=0; $pb=0;
	while(($pa<$la) && ($pb<$lb)){
		if(ord($B[$pb])==ord($A[$pa])){
			if($pb<$pa)
				$S .= $B[$pb++];
			else
				$S .= $A[$pa++];
		} elseif(ord($B[$pb])<ord($A[$pa])){
			$S .= $B[$pb++];
		} else {
			$S .= $A[$pa++];
		}
	}

	$S .= substr($A, $pa).substr($B, $pb);

	print "$S\n";
}

