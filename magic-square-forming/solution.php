<?php
#https://www.hackerrank.com/challenges/magic-square-forming/problem

error_reporting(E_ALL);
$debug = false;
function swap(&$a, &$b){
	$t = $a;
	$a = $b;
	$b = $t;
}

function array_print($arr){
	foreach($arr as $row){
		$r[] = "[".join(",", $row)."]";
	}
	return join("\n", $r);
}

$SQ = [
	[2,7,6],
	[9,5,1],
	[4,3,8],
];

$Tables = [
	$SQ,
	ms_rotate($SQ),
	//ms_mirror_dia1($SQ),
	//ms_mirror_dia2($SQ),
	ms_mirror_dia3($SQ),
	ms_mirror_dia4($SQ),

	ms_rotate(ms_rotate($SQ)),
	//ms_rotate(ms_mirror_dia1(ms_rotate($SQ))),
	//ms_rotate(ms_mirror_dia2(ms_rotate($SQ))),
	ms_rotate(ms_mirror_dia3(ms_rotate($SQ))),
	ms_rotate(ms_mirror_dia4(ms_rotate($SQ))),

	ms_rotate(ms_rotate(ms_rotate($SQ))),
	//ms_rotate(ms_mirror_dia1(ms_rotate(ms_rotate(($SQ))))),
	//ms_rotate(ms_mirror_dia2(ms_rotate(ms_rotate(($SQ))))),
	ms_rotate(ms_mirror_dia3(ms_rotate(ms_rotate(($SQ))))),
	ms_rotate(ms_mirror_dia4(ms_rotate(ms_rotate(($SQ))))),

];

function ms_mirror_dia1($s){
	swap($s[0][0], $s[0][2]);
	swap($s[2][0], $s[2][2]);
	return $s;
}

function ms_mirror_dia2($s){
	swap($s[0][1], $s[2][1]);
	swap($s[1][0], $s[1][2]);
	return $s;
}

function ms_mirror_dia3($s){
	swap($s[0][0], $s[2][2]);
	swap($s[0][1], $s[1][2]);
	swap($s[1][0], $s[2][1]);
	return $s;
}

function ms_mirror_dia4($s){
	swap($s[0][2], $s[2][0]);
	swap($s[0][1], $s[1][0]);
	swap($s[1][2], $s[2][1]);
	return $s;
}

function ms_mirror_col($s){
	foreach($s as &$row){
		swap($row[0], $row[2]);
	}
	return $s;
}

function ms_mirror_row($s){
	return [$s[2],$s[1],$s[0]];
}

function ms_rotate($s){
	return [array_column($s, 2),array_column($s, 1),array_column($s, 0)];
}

function diag1Sum($s){
	$sum = 0;
	for($i=0;$i<count($s);$i++){
		$sum += $s[$i][$i];
	}
	return $sum;
}

function diag2Sum($s){
	$sum = 0;
	for($i=0;$i<count($s);$i++){
		$sum += $s[$i][count($s) - $i - 1];
	}
	return $sum;
}

function colSum($s, $col){
	return array_sum(array_column($s, $col));
}

function rowSum($s, $row){
	return array_sum($s[$row]);
}

function formingMagicSquare($s) {
	global $Tables, $debug;

	if($debug){
		foreach($Tables as $Table){
			print array_print($Table)."\n\n";
		}

		print "!!\n".array_print($s)."\n\n";
	}

	$minCost = INF;
	$minI = INF;
	foreach($Tables as $i=>$Table){
		$cost = 0;
		foreach($s as $r=>$row){
			foreach($row as $c=>$col){
				$cost += abs($Table[$r][$c] - $col);
			}
		}
		if($debug){
			print "$i:$cost\n";
		}
		if($cost < $minCost){
			$minI = $i;
			$minCost = $cost;
		}
	}
	if($debug){
		print "table=$minI\n";
	}
	return $minCost;
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

$s = array();

for ($i = 0; $i < 3; $i++) {
	fscanf($stdin, "%[^\n]", $s_temp);
	$s[] = array_map('intval', preg_split('/ /', $s_temp, -1, PREG_SPLIT_NO_EMPTY));
}

$result = formingMagicSquare($s);

fwrite($fptr, $result . "\n");

fclose($stdin);
fclose($fptr);
