<?php
#https://www.hackerrank.com/challenges/palindrome-index/problem

function unsetChar($s, $i){
	return substr_replace($s, "", $i, 1);
}

function isPalindrome($s){
	$l = strlen($s);
	$i = 0;

	do {
		$c1 = substr($s, $i, 1);
		$c2 = substr($s, $l-$i-1, 1);
		if($c1 != $c2){
			return false;
		}
		$i++;
	} while($i<$l);

	return true;
}

function palindromeIndex($s) {
	$s = trim($s);
	$l = strlen($s);
	$i = 0;

	do{
		$c1 = substr($s, $i, 1);
		$c2 = substr($s, $l-$i-1, 1);
		if($c1 != $c2){
			if(isPalindrome(unsetChar($s, $i))){
				return $i;
			}
			if(isPalindrome(unsetChar($s, $l-$i-1))){
				return $l-$i-1;
			}
		}
		$i++;
	} while($i<$l);

	return -1;
}

$fptr = fopen("php://stdout", "w");
$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $q);

for ($q_itr = 0; $q_itr < $q; $q_itr++) {
	$s = '';
	fscanf($stdin, "%[^\n]", $s);

	$result = palindromeIndex($s);

	fwrite($fptr, $result . "\n");
}

fclose($stdin);
fclose($fptr);
