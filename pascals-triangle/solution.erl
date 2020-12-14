%% https://www.hackerrank.com/challenges/pascals-triangle
-module(solution).
-export([main/0,stop/0]).

main()->solve(read()).

pascal(0, 0)->1;
pascal(N, K) when K>N->0;
pascal(_N, K) when K<0->0;
pascal(N, K)->pascal(N-1, K-1)+pascal(N-1, K).

row(N)->lists:map(fun(E)-> io:format("~w ", [pascal(N, E)]) end, lists:seq(0, N)).
solve(Rows)->lists:map(fun(N)-> row(N), io:format("~n") end, lists:seq(0, Rows - 1)).

stop()->halt().

read()->
	{ok, [N]}=io:fread("", "~d"),
	N.

