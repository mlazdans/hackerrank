<?php
#https://www.hackerrank.com/challenges/sam-and-substrings/problem

error_reporting(E_ALL);

/* 1234
1    mod 17 = 1
4    mod 17 = 4

 2   mod 17 = 2
12   mod 17 = 12  (1*10 + 2*1) mod 17 = 10 + 2 = 10 + 2 = 12

  3  mod 17 = 3
 23  mod 17 = 6  (2*10 + 3*1) mod 17 = 20 + 3 = 3 + 3 = 6
123  mod 17 = 4  (1*100 + (2*10 + 3)) = 15 + 20 + 3 = 15 + 3 + 3 = 21 = 4

  34 mod 17 = 0  (3*10 + 4*1) mod 17 = 13 + 4 = 17 = 0
 234 mod 17 = 13 (2*100 + (3*10 + 4)) = 13 + 30 + 4 = 13 + 13 + 4 = 30 = 13
1234 mod 17 = 10 (1*1000 + (2*100 + 3*10 + 4)) = 14 + 13 + 13 + 4 = 10
*/

/*
1234/1000 + 1234/100 + 1234/10 + 1234 / 1
123/100 + 123/10 + 123/1 + 23/10 + 23/1 + 3/1
1+12+123+2+23+3
*/

//$Mod = bcadd(bcpow(10, 9), 7);
$Mod = pow(10, 9) + 7;
function substrings($n){
	global $Mod;

	$sum = $Table[0] = substr($n, 0, 1);
	for($i=1;$i<strlen($n);$i++){
		$d = substr($n, $i, 1);
		$Table[$i] = (($i+1)*$d + 10*$Table[$i-1]) % $Mod;
		$sum += $Table[$i];
		$sum = $sum % $Mod;
	}
	return $sum;
}

$fptr = fopen("php://stdout", "w");
$stdin = fopen("php://stdin", "r");
$n = '';
fscanf($stdin, "%[^\n]", $n);
$result = substrings($n);
fwrite($fptr, $result . "\n");
fclose($stdin);
fclose($fptr);
