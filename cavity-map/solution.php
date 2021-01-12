<?php

# https://www.hackerrank.com/challenges/cavity-map/problem

// Complete the cavityMap function below.
function cavityMap($grid) {
	for($i=1; $i<count($grid)-1;$i++){
		$line = str_split($grid[$i]);
		for($j=1; $j<count($line)-1;$j++){
			$c = $line[$j];
			$isCav = ($c>$grid[$i - 1][$j]) && ($c>$grid[$i][$j + 1]) && ($c>$grid[$i + 1][$j]) && ($c>$grid[$i][$j - 1]);
			if($isCav){
				$grid[$i][$j] = 'X';
			}
		}
	}

	return $grid;
}

fscanf(STDIN, "%d\n", $n);

$grid = array();
for ($i = 0; $i < $n; $i++) {
	$grid[] = trim(fgets(STDIN));
}

print implode("\n", cavityMap($grid))."\n";
