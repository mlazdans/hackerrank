<?php

# https://www.hackerrank.com/challenges/detect-html-links/problem

$data = file_get_contents("php://stdin");

$patt = '/<a(\s+href="(.*)").*>(.*)<\/a>/U';

preg_match_all($patt, $data, $m);

for($i = 0; $i < count($m[0]); $i++){
	$url = trim($m[2][$i]);
	$text = trim($m[3][$i]);
	$text = preg_replace("/<(.*)>/U", "", $text);

	printf("%s,%s\n", $url, $text);
}
