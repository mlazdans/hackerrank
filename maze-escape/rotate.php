<?php

$start_time = microtime(true);

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


$OLD_MAP=array();
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
}


for($r=0;$r<1000;$r++)
	$a=rotate_right($OLD_MAP);

$end_time = microtime(true);
print 'Finished: '.number_format(($end_time - $start_time), 4, '.', '').' sec';
