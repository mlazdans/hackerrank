%% https://www.hackerrank.com/challenges/fp-solve-me-first
-module(solution).
-export([main/0,stop/0]).

main()->io:format("~p~n",[solve(read())]).

solve({A, B})->A + B.

stop()->halt().

read()->
	{ok, [A,B]} = io:fread("", "~d~d"),
	{A, B}.

