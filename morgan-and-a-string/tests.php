<?php

$tests = [
	"input.txt"=>"output.txt",
	"input1.txt"=>"output1.txt",
	"input2.txt"=>"output2.txt",
	"input5-1.txt"=>"output5-1.txt",
	"input17-5.txt"=>"output17-5.txt",
	"input5-3.txt"=>"output5-3.txt",
	"input13-3.txt"=>"output13-3.txt",
];

foreach($tests as $testFile=>$resFile){
	$cmd = "php solution.php <$testFile";
	print "$cmd\n";
	print "Testing: $testFile...";

	exec($cmd, $out);

	$out = trim(join("", $out));
	$cmp = trim(file_get_contents($resFile));

	if($out === $cmp){
		print " pass\n";
	} else {
		print " FAIL\n";
		// print "$out\n$cmp\n";
	}
	print "\n";
}
