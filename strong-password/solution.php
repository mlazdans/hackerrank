<?php
#https://www.hackerrank.com/challenges/strong-password/problem

error_reporting(E_ALL);

function minimumNumber($n, $password) {
	$password = trim($password);
	$len = strlen($password);

	$ret = 0;
	$missing = 0;
	if($len < 6){
		$ret = 6 - $len;
	}

	$patts = ["/[0-9]/", "/[a-z]/", "/[A-Z]/", "/[".preg_quote("!@#$%^&*()-+")."]/"];
	foreach($patts as $p){
		if(!preg_match($p, $password)){
			$missing++;
		}
	}
	//print "password=$password,len=$len,ret=$ret,missing=$missing\n";

	return max($ret, $missing);
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $n);

$password = '';
fscanf($stdin, "%[^\n]", $password);

$answer = minimumNumber($n, $password);

fwrite($fptr, $answer . "\n");

fclose($stdin);
fclose($fptr);
