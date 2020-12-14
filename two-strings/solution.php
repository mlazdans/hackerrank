<?php

# https://www.hackerrank.com/challenges/two-strings

error_reporting(E_ALL);

$K = (int)fgets(STDIN);
for($r=0; $r<$K; $r++){
	$A = trim(fgets(STDIN));
	$B = trim(fgets(STDIN));
	if(strlen($A)>strlen($B)){
		$C = $A;
		$A = $B;
		$B = $C;
	}
	$la = strlen($A);
	$lb = strlen($A);
	$found = false;
	for($i=0;$i<$la;$i++){
		if(strpos($B, $A[$i]) !== false){
			$found = true;
			break;
		}
	}

	print ($found?"YES":"NO")."\n";
}

