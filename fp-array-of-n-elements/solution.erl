%% https://www.hackerrank.com/challenges/fp-array-of-n-elements
-module(solution).
-export([main/0,stop/0]).

main()->solve(read()).

solve(N)->io:format("~p~n", [lists:seq(1, N)]).

stop()->halt().

read()->
	{ok, [N]} = io:fread("", "~d"),
	N.

