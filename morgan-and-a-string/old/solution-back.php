<?php
#https://www.hackerrank.com/challenges/morgan-and-a-string/problem

error_reporting(E_ALL);

function array_print($arr){
	return "[".join(",", $arr)."]";
}

function mstr2($sa, $sb, $i = 0, $j = 0) {
	$la = strlen($sa); $lb = strlen($sb);

	$a = substr($sa, $i, 1);
	$b = substr($sb, $j, 1);

	if(($i == $la) && ($j == $lb)){
		return ["", $i, $j];
	}

	if($i == $la){
		return [$b, $i, $j + 1];
	}
	if($j == $lb){
		return [$a, $i + 1, $j];
	}

	//print "i=$i,j=$j\n";
	if($a<$b){
		return [$a, $i + 1, $j];
	} elseif($a>$b){
		return [$b, $i, $j + 1];
	} else {
		# compress
		if(false){
			$s = '';
			while(($i+1<$la) && ($j+1<$lb)&&(substr($sa, $i + 1, 1) == $a) && (substr($sa, $i + 1, 1) == substr($sb, $j + 1, 1))){
				$i++;$j++;
				$s .= $a.$a;
			}
			if($s){
				print "compress:i=$i,j=$j,s=$s\n";
				$r = mstr2($sa, $sb, $i, $j);
				$r[0] = $s.$r[0];
				print_r($r);
				//die;
				return $r;
			}
		}

		# find best next
		$max = max($la-$i,$lb-$j);
		for($t=1;$t<$max;$t++){
			$a1 = substr($sa,$t+$i,1);
			$b1 = substr($sb,$t+$j,1);
			if($a1 != $b1){
				break;
			}
		}


		//die;
		//print "la=$la,lb=$lb,t=$t,max=$max\n";
		if($t == $max){
			$r = mstr2($sa, $sb, $i + 1, $j);
			$r[0] = $a.$r[0];
		} else {
			if($a1<$b1){
				//print "$a1<$b1\n";
				$r = mstr2($sa, $sb, $i + 1, $j);
				$r[0] = $a.$r[0];
			} elseif($a1>$b1){
				$r = mstr2($sa, $sb, $i, $j + 1);
				$r[0] = $a.$r[0];
			} else {
			}
			/*
			print "$a1:$b1\n";
			$r = mstr2($sa, $sb, $i + 1, $j + 1);
			if($r[1]-1>$i){
				$r[0] = $a.$r[0];
				$r[2] = $j;
				return $r;
			} elseif($r[2]-1>$j){
				$r[0] = $a.$r[0];
				$r[1] = $i;
				return $r;
			}
			*/
		}
		return $r;
	}
}

function morganAndString($sa, $sb) {
	$sa = trim($sa); $sb = trim($sb);

	$i = $j = 0; $res = '';
	while(($r = mstr2($sa, $sb, $i, $j)) && $r[0]){
		$res .= $r[0];
		$i = $r[1];
		$j = $r[2];
	}
	return $res;
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $t);

for ($t_itr = 0; $t_itr < $t; $t_itr++) {
	$a = '';
	fscanf($stdin, "%[^\n]", $a);

	$b = '';
	fscanf($stdin, "%[^\n]", $b);

	//print "$t_itr\n";
	$result = morganAndString($a, $b);

	fwrite($fptr, $result . "\n");
}

fclose($stdin);
fclose($fptr);
