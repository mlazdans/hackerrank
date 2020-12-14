%% https://www.hackerrank.com/challenges/string-mingling
-module(solution).
-export([main/0,stop/0]).

main()->solve(read()).

solve({P,Q})->
	io:format("~s~n", [lists:zipwith(fun(A,B)-> [A,B] end, P,Q)]).

stop()->halt().

read()->
	{ok, [P]} = io:fread("", "~s"),
	{ok, [Q]} = io:fread("", "~s"),
	{P,Q}.


