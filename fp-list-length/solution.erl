%% https://www.hackerrank.com/challenges/fp-list-length
-module(solution).
-export([main/0,stop/0]).

main()->solve(read()).

solve(List)->io:format("~w~n", [solve(List, 0)]).
solve([_H|List], N)->solve(List, N+1);
solve([], N)->N.

stop()->halt().

read()->
	read([]).
read(List)->
	case io:fread("", "~d") of
		eof->List;
		{ok, [E]}->read(List++[E])
	end.

