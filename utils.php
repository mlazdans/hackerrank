<?php

function printTable($table){
	print "<table border=1>";
	foreach($table as $row){
		print "<tr>";
		foreach($row as $col){
			print "<td>$col&nbsp;</td>";
		}
		print "</tr>";
	}
	print "</table>";
}
