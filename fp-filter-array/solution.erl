%% https://www.hackerrank.com/challenges/fp-filter-array
-module(solution).
-export([main/0,stop/0]).

main()->solve(read()).

solve({X, List})->
	F=lists:filter(fun(E)-> E < X end, List),
	lists:map(fun(E)->io:format("~w~n", [E]) end, F).

stop()->halt().

read()->
	{ok, [S]} = io:fread("", "~d"),
	{S, read([])}.
read(List)->
	case io:fread("", "~d") of
		eof->List;
		{ok, [E]}->read(List++[E])
	end.

