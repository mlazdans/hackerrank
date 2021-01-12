<?php

# https://www.hackerrank.com/challenges/detect-html-tags/problem

$data = file_get_contents("php://stdin");

$patt = "/<\s?+([a-z0-9]+)[^<>]*>/i";

preg_match_all($patt, $data, $m);

$tags = array_unique($m[1]);

sort($tags, SORT_STRING);

print join(";", $tags);

