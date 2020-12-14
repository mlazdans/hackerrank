<?php
#https://www.hackerrank.com/challenges/bigger-is-greater/problem

error_reporting(E_ALL);

/*
a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z
====================================================================
dkhc
c<->d=3 pos
h<->d=2 pos=>hdkc
minimize d+ =>dkc=>cdk=>hcdk

--
hcdk

=================
yricnue
yri(e)cnu
yric(u)ne => yric(u)en (minimize tail)

--
yricuen

==================
hefg
g<->f=1 pos=>hegf

--
hegf

==================
hnerjzmwsrf

hn(f)erjzmwsr (9 pos)
hnerjz(r)mwsf (3 pos) =>hnerjz(r)fmsw
hnerjz(s)mwrf (2 pos)
hnerjz(w)msrf (1 pos)

--
hnerjzrfmsw

zvtronmlkkihc
==================
zvtronmlkkihc (c) - nevar
zvtronmlkkihc (h) - nevar
....

--
no answer
*/

function array_print($arr){
	return "[".join(",", $arr)."]";
}

#y=121,r=114,i=105,c=99,n=110,u=117,e=101
#yricnue
#-------
#yriecnu
#yricuen

function swap(&$a, &$b){
	$t = $a;
	$a = $b;
	$b = $t;
}

function biggerIsGreater($w) {
	$a = str_split(trim($w), 1);
	$best = [-INF, -INF];
	for($i = count($a)-1; $i >= 0; $i--){
		for($j = $i-1; $j >= 0; $j--){
			//print "i=$i:j=$j\n";
			if($a[$i]>$a[$j]){
				if($j > $best[0]){
					$best = [$j, $i];
				} elseif($j == $best[0]){
					if($a[$i] < $a[$best[1]]){
						$best[1] = $i;
					}
				}
				break;
			}
		}
	}

	if($best[0] == -INF){
		return "no answer";
	}

	//print array_print($a)."\n";
	swap($a[$best[0]], $a[$best[1]]);
	$tail = array_slice($a, $best[0] + 1);
	sort($tail);
	$ret = array_merge(
		array_slice($a, 0, $best[0] + 1),
		$tail
	);
	// print array_print($a)."\n";
	// print array_print($tail)."\n";
	// print array_print($ret)."\n";
	// print_r($best);
	return join("", $ret);
}

$fptr = fopen("php://stdout", "w");

$stdin = fopen("php://stdin", "r");

fscanf($stdin, "%d\n", $T);

for ($T_itr = 0; $T_itr < $T; $T_itr++) {
    $w = '';
    fscanf($stdin, "%[^\n]", $w);

    $result = biggerIsGreater($w);

    fwrite($fptr, $result . "\n");
}

fclose($stdin);
fclose($fptr);
