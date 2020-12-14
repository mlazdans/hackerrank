<?php
# https://www.hackerrank.com/challenges/maze-escape

error_reporting(E_ALL);

$DEBUG = 1;

if($DEBUG){
	$start_time = microtime(true);
}

function print_map($MAP){
	print get_map($MAP);
}

function is_clean($MAP){
	for($y=0;$y<$MAP['H'];$y++)
		for($x=0;$x<$MAP['W'];$x++)
			if($MAP['map'][$y][$x]=='d')
				return false;

	return true;
}

function get_dirts($MAP){
	return array_keys(array_filter($MAP, function($e){
			return $e == 'd';
	}));
}


function get_map($MAP){
	global $W,$H,$Y,$X;

	$o = "$Y $X\n";
	$o .= "$H $W\n";
	foreach($MAP as $k=>$v){
		$o .= "$v";
		if(($k + 1) % $W == 0)
			$o .= "\n";
	}
	return $o;
}

function get_distances($elems)
{
	if(empty($elems) or (count($elems) < 2))
		return false;

	$r = array();
	$current = array_shift($elems);

	foreach($elems as $e)
		$r[$current][$e] = 0;

	return $r;
} // get_distances

function get_distances_($e, $elems)
{
}


$MAP = array();
list($Y, $X) = fscanf(STDIN, "%d %d");
list($H, $W) = fscanf(STDIN, "%d %d");
while(!feof(STDIN)){
	$line = trim(fgets(STDIN));
	if(!empty($line))
		$MAP=array_merge($MAP, str_split($line));
}

$d = get_dirts($MAP);
print_map($MAP);
print_r($d);

if($DEBUG)
{
	$end_time = microtime(true);
	print 'Finished: '.number_format(($end_time - $start_time), 4, '.', '').' sec';
}


