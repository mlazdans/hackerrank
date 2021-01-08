<?php
#https://www.hackerrank.com/challenges/morgan-and-a-string/problem

error_reporting(E_ALL);

ini_set("memory_limit", "12G");

// JZZSZFW
// AZZNJOJ

// standart:AJZZNJOJZZSZFW
// compress:AJZZZNJOJZSZFW

function mstr3($sa, $sb, $i = 0, $j = 0, $d = 0) {
	global $Map;

	$la = strlen($sa); $lb = strlen($sb);
	$pad = str_repeat(" ", $d*2);

	/*
	if(isset($Map[$i][$j])){
		print "mem[$i][$j]=".$Map[$i][$j]."\n";
		return $Map[$i][$j];
	}
	*/

	$str = '';
	do {
		$a = substr($sa, $i, 1);
		$b = substr($sb, $j, 1);
		//print $pad."[i=$i,j=$j,str=$str]\n";

		if($i>=$la){
			$str .= substr($sb, $j);
			break;
		} elseif($j>=$lb){
			//return $res.substr($sa, $i);
			$str .= substr($sa, $i);
			break;
		} elseif($a<$b){
			$i++;
			$str .= $a;
		} elseif($a>$b){
			$j++;
			$str .= $b;
		} else {
			$s1 = mstr3($sa, $sb, $i + 1, $j, $d + 1);
			$s2 = mstr3($sa, $sb, $i, $j + 1, $d + 1);
			if($s1&&$s2){
				$str .= $a.min($s1,$s2);
			} elseif($s1){
				$str .= $a.$s1;
			} else {
				$str .=  $a.$s2;
			}
			break;

			/*
			if(isset($Map[$i + 1][$j])){
				$s1 = $Map[$i + 1][$j];
			} else {
				$s1 = mstr3($sa, $sb, $i + 1, $j, $d + 1);
				$Map[$i + 1][$j] = $s1;
			}

			if(isset($Map[$i][$j + 1])){
				$s2 = $Map[$i][$j + 1];
			} else {
				$s2 = mstr3($sa, $sb, $i, $j + 1, $d + 1);
				$Map[$i][$j + 1] = $s2;
			}
			*/

			/*
			print $pad."[$a==$b],res=$res,str=$str\n";
			print $pad."start s1\n";
			$s1 = mstr3($sa, $sb, $res.$str.$a, $i + 1, $j, $d + 1);
			print $pad."s1=$s1\n";
			print $pad."start s2\n";
			$s2 = mstr3($sa, $sb, $res.$str.$a, $i, $j + 1, $d + 1);
			print $pad."s2=$s2\n";
			*/
		}
	} while(true);

	//$Map[$i][$j] = $str;
	return $str;
}

function morganAndString($sa, $sb) {
	global $Map;

	$Map = [];
	$sa = trim($sa); $sb = trim($sb);
	//print "$sa\n$sb\n=========================\n";

	$a = mstr3($sa, $sb);
	print_r($Map);
	return $a;
	/*
	$i = $j = 0; $res = '';
	while(($r = mstr2($sa, $sb, $i, $j)) && $r[0]){
		$res .= $r[0];
		$i = $r[1];
		$j = $r[2];
	}
	return $res;
	*/
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $t);

for ($t_itr = 0; $t_itr < $t; $t_itr++) {
	$a = '';
	fscanf($stdin, "%[^\n]", $a);

	$b = '';
	fscanf($stdin, "%[^\n]", $b);

	$result = morganAndString($a, $b);

	fwrite($fptr, $result . "\n");
}

fclose($stdin);
fclose($fptr);
