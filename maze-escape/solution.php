<?php
# https://www.hackerrank.com/challenges/maze-escape

# ngochai94

error_reporting(E_ALL);

//ini_set('memory_limit', '512M');

$MAP_W = 3;
$MAP_H = 3;
$BOT_Y = 1;
$BOT_X = 1;
$ALL_MOVES = array();

$OLD_MAP = array();
$OLD_MOVE = '';

$DEBUG = 0;

if($DEBUG)
{
	$start_time = microtime(true);
}

if(file_exists("moves"))
{

	$f=fopen("moves", "r");
	$OLD_MOVE = trim(fgets($f));
	while(!feof($f)){
		$line = trim(fgets($f));
		if(!empty($line))
			$OLD_MAP[]=str_split($line);
	}
	fclose($f);

if($DEBUG)
{
	print "Old:\n";
	print_board($OLD_MAP);
}
	if($OLD_MOVE == 'LEFT'){
		$OLD_MAP = rotate_right($OLD_MAP);
	}
	if($OLD_MOVE == 'RIGHT'){
		$OLD_MAP = rotate_left($OLD_MAP);
	}
	if($OLD_MOVE == 'DOWN'){
		$OLD_MAP = rotate_flip($OLD_MAP);
	}

if($DEBUG)
{
	print "Old-rotated:\n";
	print_board($OLD_MAP);
}

	list($OLD_Y, $OLD_X) = find_bot($OLD_MAP);
	//$OLD_MAP[$OLD_Y][$OLD_X]='-'; # Delete bot pos
//	print "OLD_Y=$OLD_Y, OLD_X=$OLD_X\n";
}

$Player = (int)fgets(STDIN);
for($r=0; $r<3; $r++){
	$map[]=str_split(trim(fgets(STDIN)));
}

if($DEBUG)
{
print "New map:\n";
print_board($map);
}

# Merge new view
if($OLD_MAP)
{
	$OLD_MAP_W = count($OLD_MAP[0]);
	$OLD_MAP_H = count($OLD_MAP);

	if($OLD_Y<1){
		$OLD_Y++;
		$new_row = array_fill(0, $OLD_MAP_W, '.'); # Tumsa
		/*
		$new_row[$OLD_X-1] = $map[0][0];
		$new_row[$OLD_X] = $map[0][1];
		$new_row[$OLD_X+1] = $map[0][2];
		*/
		array_unshift($OLD_MAP, $new_row);
	}
	for($r=-1; $r<2; $r++){
		$OLD_MAP[$OLD_Y-1][$OLD_X+$r] = $map[0][$r+1];
		$OLD_MAP[$OLD_Y][$OLD_X+$r] = $map[1][$r+1];
		$OLD_MAP[$OLD_Y+1][$OLD_X+$r] = $map[2][$r+1];
	}
	//print_board($OLD_MAP);

	$map = $OLD_MAP;
	$MAP_W = count($map[0]);
	$MAP_H = count($map);
	//$BOT_Y = $OLD_Y+1;
	$BOT_Y = $OLD_Y;
	//$BOT_Y = 1;
	$BOT_X = $OLD_X;

}

if($DEBUG)
{
print "W=$MAP_W,H=$MAP_H,Y=$BOT_Y,X=$BOT_X\n";
print "Merged:\n";
print_board($map);
}

function rotate_left($map)
{
	return call_user_func_array(
		'array_map',
		array(-1 => null) + array_map('array_reverse', $map)
		);
} // rotate_left

function rotate_right($map)
{
	return rotate_left(rotate_left(rotate_left($map)));
} // rotate_right

function rotate_flip($map)
{
	return rotate_left(rotate_left($map));
} // rotate_flip

function avail_moves()
{
	return array(
		"LEFT"=>array(0,-1),
		"DOWN"=>array(+1,0),
		"UP"=>array(-1,0),
		"RIGHT"=>array(0,+1),
		);
} // avail_moves

function avail_revail_moves()
{
	return array(
		array(-1,-1),
		array(-1,0),
		array(-1,+1),

		array(0,-1),
		array(0,0),
		array(0,+1),

		array(+1,-1),
		array(+1,0),
		array(+1,+1),
		);
} // avail_revail_moves

function find_bot($map){
	return find_object($map, 'b');
} // find_bot

function find_exit($map){
	return find_object($map, 'e');
} // find_exit

function find_object($map, $o)
{
	#return array(Y,X)
	foreach($map as $y=>$row)
		foreach($row as $x=>$c)
			if($c == $o)
				return array($y,$x);

	return false;
} // find_object

function move_bot_exit($map, $Y = 1, $X = 1, $MOVES = array())
{
	global $MAP_W, $MAP_H, $ALL_MOVES;

	if(($Y>=$MAP_H) || ($Y<0) || ($X>=$MAP_W) || ($X<0))
		return false;

	$C = $map[$Y][$X];
	if(($C == "#") || ($C == 'x') || ($C == '.'))
		return false;

	if($C == 'e'){
		$ALL_MOVES[] = $MOVES;
		return true;
	}

	# TODO: izvēlēties to gājienu, kur vairāk tumsas apkārt
	$nmap = $map;
	$nmap[$Y][$X] = 'x';
	if(is_full($nmap)){
		//$ALL_MOVES['simple'][] = $MOVES;
		return false;
	}

	$avail_moves = avail_moves();
	foreach($avail_moves as $dir=>$c)
	{
		$m = $MOVES;
		$m[] = $dir;
		move_bot_exit($nmap, $Y+$c[0], $X+$c[1], $m);
	}
} // move_bot_exit

function move_bot($map, $Y = 1, $X = 1, $MOVES = array(), $d = 0)
{
	global $MAP_W, $MAP_H, $ALL_MOVES;

	/*
	print "Y=$Y,X=$X\n";
	print_board($map);
	print "\n";
	*/

	if(($Y>=$MAP_H) || ($Y<0) || ($X>=$MAP_W) || ($X<0))
		return false;

	$C = $map[$Y][$X];
	if(($C == "#") || ($C == 'x') || ($C == '.'))
		return false;

	if($MOVES){
		$r = bot_revails($map, $Y, $X);
		$ALL_MOVES[] = array($r, $MOVES);
		//if($d>5)
		//	return;
	}

	$nmap = $map;
	$nmap[$Y][$X] = 'x';
	if(is_full($nmap)){
		//$ALL_MOVES[][] = array(0, $MOVES);
		return false;
	}

	$MAX_REVAIL = -1;
	$MAX_REVAIL_MOVE = '';

	$avail_moves = avail_moves();
	foreach($avail_moves as $dir=>$c)
	{
		$m = $MOVES;
		$m[] = $dir;
		move_bot($nmap, $Y+$c[0], $X+$c[1], $m, $d + 1);
		/*
		if($revail=move_bot($nmap, $Y+$c[0], $X+$c[1], $m, $d + 1))
		{
			if($revail > $MAX_REVAIL){
				$MAX_REVAIL=$revail;
				$MAX_REVAIL_MOVE=$dir;
			}
		}
		*/
	}

	//return ($MAX_REVAIL_MOVE);
} // move_bot


function bot_revails($map, $Y, $X)
{
	global $MAP_W, $MAP_H;

	$revail = 0;

	if($X==0)
		$revail+=3;
	if($X==$MAP_W-1)
		$revail+=3;
	if($Y==0)
		$revail+=3;
	if($Y==$MAP_H-1)
		$revail+=3;

	$avail_moves = avail_revail_moves();
	foreach($avail_moves as $dir=>$c)
	{
		$Y1=$Y+$c[0];
		$X1=$X+$c[1];
		if(($Y1>=$MAP_H) || ($Y1<0) || ($X1>=$MAP_W) || ($X1<0))
			continue;
		if($map[$Y1][$X1]=='.')
			$revail++;
	}

	return $revail;
} // bot_revails

function print_board($map)
{
	print get_board($map)."\n";
} // print_board

function get_board($map)
{
	$r = '';
	foreach($map as $row)
	{
		foreach($row as $c)
			$r.=$c;
		$r.="\n";
	}
	return $r;
} // get_board

function is_full($map)
{
	foreach($map as $row)
		foreach($row as $c)
			if($c == '-')
				return false;

	return true;
} // is_full

if(find_exit($map)){
	move_bot_exit($map, $BOT_Y, $BOT_X);
}

if($ALL_MOVES)
{
	$moves = array();
	$counts = array();
	foreach($ALL_MOVES as $m){
		$counts[] = count($m);
		$moves[] = $m;
	}
	array_multisort($counts, SORT_ASC, SORT_NUMERIC, $moves);

	/*
	print_r($ALL_MOVES);
	print_r($counts);
	print_r($moves);
	print_board($map);
	die;
	*/

	$MOVE = $moves[0][0];
} else {
	move_bot($map, $BOT_Y, $BOT_X);
	$revails = array();
	$counts = array();
	$moves = array();
	foreach($ALL_MOVES as $m){
		$revails[] = $m[0];
		$counts[] = count($m[1]);
		$moves[] = $m[1];
	}
	/*
	print_r($ALL_MOVES);
	print_r($counts);
	print_r($moves);
	*/
	array_multisort($revails, SORT_DESC, SORT_NUMERIC, $counts, SORT_ASC, SORT_NUMERIC, $moves);
	$MOVE = $moves[0][0];
}
/*
# Mēģina veco gājienu
if($OLD_MOVE && !isset($ALL_MOVES['exit']))
{
	$potential_move = '';
	if($OLD_MOVE == 'UP')
		$potential_move = 'DOWN';
	if($OLD_MOVE == 'DOWN')
		$potential_move = 'UP';
	if($OLD_MOVE == 'LEFT')
		$potential_move = 'RIGHT';
	if($OLD_MOVE == 'RIGHT')
		$potential_move = 'LEFT';
	foreach($moves as $m){
		if($potential_move == $m[0]){
			$MOVE = $potential_move;
			break;
		}
	}
}
*/

print "$MOVE\n";

$m = avail_moves();
$map[$BOT_Y][$BOT_X] = '-';
$map[$BOT_Y + $m[$MOVE][0]][$BOT_X + $m[$MOVE][1]] = 'b';

$f=fopen("moves", "w");
fputs($f, "$MOVE\n");
fputs($f, get_board($map));
fclose($f);

if($DEBUG)
{
	$end_time = microtime(true);
	print 'Finished: '.number_format(($end_time - $start_time), 4, '.', '').' sec';
}


