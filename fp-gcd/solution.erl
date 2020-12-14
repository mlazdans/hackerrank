%% https://www.hackerrank.com/challenges/functional-programming-warmups-in-recursion---gcd
-module(solution).
-export([main/0,stop/0]).

main()->solve(read()).

gcd(X,0)->X;
gcd(X,Y)->gcd(Y,X rem Y).

solve({X,Y})->io:format("~w~n", [gcd(X,Y)]).

stop()->halt().

list2int(L)->lists:map(fun(X)->{Int, _} = string:to_integer(X), Int end, L).

read()->
	[X,Y]=lists:reverse(lists:sort(list2int(string:tokens(io:get_line(""), " \n\r")))),
	{X,Y}.


