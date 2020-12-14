%% https://www.hackerrank.com/challenges/fp-update-list
-module(solution).
-export([main/0,stop/0]).

main()->solve(read()).

solve(List)->lists:map(fun(E)->io:format("~w~n", [abs(E)]) end, List).

stop()->halt().

read()->
	read([]).
read(List)->
	case io:fread("", "~d") of
		eof->List;
		{ok, [E]}->read(List++[E])
	end.

