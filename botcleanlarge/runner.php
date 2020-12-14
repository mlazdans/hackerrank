<?php
# php runner.php <game-4977411.json
error_reporting(E_ALL);

array_map('unlink', glob("output/*"));

$f=fopen("data.txt", "r");

function parse_map($f){
	$MAP = array();
	list($MAP['Y'], $MAP['X']) = fscanf($f, "%d %d");
	list($MAP['H'], $MAP['W']) = fscanf($f, "%d %d");
	while(!feof($f)){
		$line = trim(fgets($f));
		if(!empty($line))
			$MAP['map'][]=str_split($line);
	}
	return $MAP;
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


function get_map($MAP){
	$o='';
	$o .= "$MAP[Y] $MAP[X]\n";
	$o .= "$MAP[H] $MAP[W]\n";
	for($y=0;$y<$MAP['H'];$y++){
		for($x=0;$x<$MAP['W'];$x++)
			$o .= $MAP['map'][$y][$x];
		$o .= "\n";
	}
	return $o;
}

function set_clean($MAP, $Y, $X){
	if($MAP['map'][$Y][$X] != 'd')
		$MAP['map'][$Y][$X] = '-';
	return $MAP;
}
function set_bot($MAP, $Y, $X){
	if($MAP['map'][$Y][$X] != 'd')
		$MAP['map'][$Y][$X] = 'b';
	return $MAP;
}
function move_map($MAP, $Dir){
	$Y = $MAP['Y'];
	$X = $MAP['X'];
	if($Dir == 'CLEAN'){
		$MAP['map'][$Y][$X] = 'b';
	} elseif($Dir == 'RIGHT'){
		$MAP=set_clean($MAP, $Y, $X);
		$MAP['X']=++$X;
		$MAP=set_bot($MAP, $Y, $X);
	} elseif($Dir == 'LEFT'){
		$MAP=set_clean($MAP, $Y, $X);
		$MAP['X']=--$X;
		$MAP=set_bot($MAP, $Y, $X);
	} elseif($Dir == 'UP'){
		$MAP=set_clean($MAP, $Y, $X);
		$MAP['Y']=--$Y;
		$MAP=set_bot($MAP, $Y, $X);
	} elseif($Dir == 'DOWN'){
		$MAP=set_clean($MAP, $Y, $X);
		$MAP['Y']=++$Y;
		$MAP=set_bot($MAP, $Y, $X);
	} else {
		die('Incorrect move!');
	}

	return $MAP;
}

$MAP = parse_map($f);
fclose($f);

$pipes = array();
$dspec = array(
	0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
	1 => array("pipe", "w"),  // stdout is a pipe that the child will write to
	2 => array("file", "error-output.txt", "a") // stderr is a file to write to
	);

$m=0;
$mapstr = get_map($MAP);
do
{
	$process = proc_open("erl -noshell -run solution main -run solution stop", $dspec, $pipes);

	stream_set_blocking($pipes[0], 0);
	stream_set_blocking($pipes[1], 0);
	stream_set_blocking(STDIN, 0);

	if($process === FALSE){
		die('Cannot exec solution!');
	}

	$a=fwrite($pipes[0], $mapstr);
	fclose($pipes[0]);

	$start_time = microtime(true);
	# Last line to allow some debug
	while(!feof($pipes[1])){
		if($line = trim(fgets($pipes[1])))
			$move = $line;
		print "$line\n";
	}
	//$move = trim(stream_get_contents($pipes[1]));
	fclose($pipes[1]);

	$end_time = microtime(true);
	print 'Finished: '.number_format(($end_time - $start_time), 4, '.', '')." sec\n";

	proc_close($process);

	//print "$move\n";
	$MAP = move_map($MAP, $move);

	$mapstr = get_map($MAP);
	file_put_contents("output/moves".str_pad(++$m, 4, "0", STR_PAD_LEFT), "$move\n".$mapstr);
} while(!is_clean($MAP));

