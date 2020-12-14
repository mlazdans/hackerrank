%% https://www.hackerrank.com/challenges/fp-hello-world-n-times
-module(solution).
-export([main/0,stop/0]).

main()->solve(read()).

solve(N) when N > 0->
	io:format("Hello World~n"),
	solve(N - 1);
solve(0)->stop().

stop()->halt().

read()->
	{ok, [N]} = io:fread("", "~d"),
	N.


