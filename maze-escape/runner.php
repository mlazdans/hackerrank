<?php
# php runner.php <game-4977411.json
error_reporting(E_ALL);

$PLAYER_ID = 1;

$json = fgets(STDIN);
$a = json_decode($json);

//print_r($a->inputs["payload"]);
$b = json_decode($a->inputs);

$pipes = array();
$dspec = array(
	0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
	1 => array("pipe", "w"),  // stdout is a pipe that the child will write to
	2 => array("file", "error-output.txt", "a") // stderr is a file to write to
	);
unlink("moves");

$m=0;
foreach($b->payload as $p)
{
	$p_id = substr($p,0,1);
	if($p_id != $PLAYER_ID)
		continue;

	print "$p\n";
	$process = proc_open("php solution.php", $dspec, $pipes);
	fwrite($pipes[0], $p);
	fclose($pipes[0]);
	echo stream_get_contents($pipes[1]);
	fclose($pipes[1]);
	proc_close($process);
	copy("moves", "output/moves".str_pad(++$m, 4, "0", STR_PAD_LEFT));
}


