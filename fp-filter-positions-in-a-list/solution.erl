%% https://www.hackerrank.com/challenges/fp-filter-positions-in-a-list
-module(solution).
-export([main/0,stop/0]).

main()->solve(read()).

solve(List)->solve(List, 1).
solve([], _N)->ok;
solve([H|List], N) when N rem 2 == 0 ->io:format("~p~n", [H]), solve(List, N + 1);
solve([H|List], N)->solve(List, N + 1).

stop()->halt().

read()->
	read([]).
read(List)->
	case io:fread("", "~d") of
		eof->List;
		{ok, [E]}->read(List++[E])
	end.

