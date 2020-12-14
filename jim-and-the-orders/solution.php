<?php
#https://www.hackerrank.com/challenges/jim-and-the-orders/problem

error_reporting(E_ALL);

function array_print($arr){
	return "[".join(",", $arr)."]";
}

function jimOrders($orders) {
	$o = $s = [];
	foreach($orders as $i=>$item){
		$o[] = $i + 1;
		$s[] = $item[1] + $item[0];
	}
	array_multisort($s, SORT_NUMERIC, $o, SORT_NUMERIC);
	return $o;
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $n);

$orders = array();

for ($i = 0; $i < $n; $i++) {
	fscanf($stdin, "%[^\n]", $orders_temp);
	$orders[] = array_map('intval', preg_split('/ /', $orders_temp, -1, PREG_SPLIT_NO_EMPTY));
}

$result = jimOrders($orders);

fwrite($fptr, implode(" ", $result) . "\n");

fclose($stdin);
fclose($fptr);
