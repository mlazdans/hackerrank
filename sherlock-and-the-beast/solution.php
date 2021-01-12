<?php

# https://www.hackerrank.com/challenges/sherlock-and-the-beast/problem

/*
[c(5),c(3)]

The number of 5's it contains is divisible by 3
The number of 3's it contains is divisible by 5

n=1 [1,0], [0,1]
n=2 [2,0], [1,1], [0,2]
*n=3 [3,0], [2,1], [1,2], [0,3]
n=4 [4,0], [3,1], [2,2], [1,3], [0,4]
*n=5 [5,0], [4,1], [3,2], [2,3], [1,4], [0,5]
*n=6 [6,0], [5,1], [4,2], [3,3], [2,4], [1,5], [0,6]
n=7 [7,0], [6,1], [5,2], [4,3], [3,4], [2,5], [1,6], [0,7]
*n=8 [8,0], [7,1], [6,2], [5,3], [4,4], [3,5], [2,6], [1,7], [0,8]
*n=9 [9,0]...
*n=10 [10,0], [9,1], [8,2], [7,3], [6,4], [5,5], [4,6], [3,7], [2,8], [1,9], [0,10]
*n=11 [11,0], [10,1], [9,2], [8,3], [7,4], [6,5], [5,6], [4,7], [3,8], [2,9], [1,10], [0,10]
*n=12 [12,0]...

3:555 [3,0]
5:33333 [0,5]
6:555555 [6,0]
8:55533333 [3,5]
9:555555555 [9,0]
10:3333333333, [0,10]
11:55555533333, [6, 5]

*/

// Complete the decentNumber function below.
function decentNumber($n) {
	$n5 = $n;
	$n3 = 0;

	while($n5>=0) {
		if(($n5 % 3 == 0) && ($n3 % 5 == 0)){
			return str_repeat("5", $n5).str_repeat("3", $n3);
		}
		$n5--; $n3++;
	};

	return "-1";
}

$t = intval(trim(fgets(STDIN)));

for ($t_itr = 0; $t_itr < $t; $t_itr++) {
	$n = intval(trim(fgets(STDIN)));

	print decentNumber($n)."\n";
}
