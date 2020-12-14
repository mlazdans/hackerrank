<?php

# https://www.hackerrank.com/challenges/funny-string

error_reporting(E_ALL);

$K = (int)fgets(STDIN);
for($r=0; $r<$K; $r++){
	$A = trim(fgets(STDIN));
	$la = strlen($A);

	$funny = true;
	for($i=1;$i<$la;$i++){
		$ir=$la-$i;
		if(abs(ord($A[$i])-ord($A[$i-1])) != abs(ord($A[$ir])-ord($A[$ir-1]))){
			$funny = false;
			break;
		}
	}

	print ($funny?"Funny":"Not Funny")."\n";
}

