<?php
#https://www.hackerrank.com/challenges/abbr/problem

error_reporting(E_ALL);
ini_set('memory_limit', '1G');

/*
function del_lowers($a){
	return preg_replace("/[a-z]/", "", $a);
}

function first_lower($a){
	$m = preg_split("/[a-z]/", $a, 2, PREG_SPLIT_OFFSET_CAPTURE);
	return $m[1][1]??false;
}
*/

function ibox($i, $x, $y, $t, $cW, $color){
	$black = imagecolorallocate($i, 0,0,0);
	imagefilledrectangle($i, $x,$y, $x+$cW,$y+$cW, $color);
	imagerectangle($i, $x,$y, $x+$cW,$y+$cW, $black);
	imagestring ($i, 0, $x+3, $y+2, $t, $black);
}

function imageTable($a, $b, $Table){
	$cW = 10;
	$x = 0;
	$y = 0;

	$al = strlen($a);
	$bl = strlen($b);

	$w = $cW * ($al + 2);
	$h = $cW * ($bl + 2);
	$i = imagecreatetruecolor($w, $h);
	$white = imagecolorallocate($i, 255,255,255);
	$grey = imagecolorallocate($i, 128,128,128);
	$light = imagecolorallocate($i, 0xFF,0xFF,0xCC);
	$green = imagecolorallocate($i, 0,255,0);

	imagefill($i, 0,0, $grey);

	ibox($i, $x,$y, "", $cW, $grey);$x += $cW;
	for($ai = 0; $ai < $al; $ai++){
		$ac = substr($a, $ai, 1);
		ibox($i, $x,$y, $ac, $cW, $grey);
		ibox($i, $x,$y+($bl+1)*$cW, $ac, $cW, $grey);
		$x += $cW;
	}

	for($bi = 0; $bi < $bl; $bi++){
		$bc = substr($b, $bi, 1);
		$x = 0;$y += $cW;
		ibox($i, $x,$y, $bc, $cW, $grey);
		ibox($i, $x+($al+1)*$cW,$y, $bc, $cW, $grey);
		$x += $cW;
		for($ai = 0; $ai < $al; $ai++){
			$color = ($Table[$bi][$ai]??0) ? $green : ($bi % 2 ? $light : $white);
			ibox($i, $x,$y, "", $cW, $color);$x += $cW;
		}
	}

	imagepng($i, "out.png");
	imagedestroy($i);
}

function printTable($a, $b, $Table){
	$al = strlen($a);
	$bl = strlen($b);
	print "<style>
	th {background: grey}
	.f {background:green}
	</style>
	";
	print "<table border=1><tr><th>&nbsp;</th>";
	for($ai = 0; $ai < $al; $ai++){
		$ac = substr($a, $ai, 1);
		print "<th>$ac</th>";
	}
	print "</tr>";
	for($bi = 0; $bi < $bl; $bi++){
		$bc = substr($b, $bi, 1);
		print "<tr><th>$bc</th>";
		for($ai = 0; $ai < $al; $ai++){
			$class = ($Table[$bi][$ai]??0) ? "f" : "";
			print "<td class=$class>&nbsp;</td>";
		}
		print "</tr>";
	}
	print "</table>";
}


function abbreviation($a, $b) {
	$al = strlen($a);
	$bl = strlen($b);
	$Table = $UCount = [];

	$c = 0;
	for($ai = 0; $ai < $al; $ai++){
		$ac = substr($a, $ai, 1);
		$UCount[$ai] = $c;
		if(($ac >= 'A') && ($ac <= 'Z')){
			$c++;
		}
	}

	for($bi = 0; $bi < $bl; $bi++){
		$bc = substr($b, $bi, 1);
		for($ai = $bi; $ai < $al; $ai++){
			$r = false;
			$ac = substr($a, $ai, 1);
			$r = (strtoupper($ac) == $bc);
			if(isset($Table[$bi - 1][$ai - 1])){
				$r = $r && ($Table[$bi - 1][$ai - 1]??false);
			}
			if(($ac >= 'a') && ($ac <= 'z')){
				if(isset($Table[$bi][$ai - 1])){
					$r = $r || ($Table[$bi][$ai - 1]??false);
				}
			} elseif($UCount[$ai] > $bi){
				$r = false;
			}
			$Table[$bi][$ai] = $r;
		}
	}

	//imageTable($a, $b, $Table);
	return $Table[$bl - 1][$al - 1]??false ? "YES" : "NO";
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $q);

for ($q_itr = 0; $q_itr < $q; $q_itr++) {
    $a = '';
    fscanf($stdin, "%[^\n]", $a);

    $b = '';
    fscanf($stdin, "%[^\n]", $b);

	$Mem = [];
    $result = abbreviation(trim($a), trim($b));

    fwrite($fptr, $result . "\n");
}

fclose($stdin);
fclose($fptr);
