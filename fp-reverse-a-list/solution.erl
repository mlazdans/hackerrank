%% https://www.hackerrank.com/challenges/fp-reverse-a-list
-module(solution).
-export([main/0,stop/0]).

main()->solve(read()).

solve([])->ok;
solve([H|List])->
	solve(List),
	io:format("~w~n", [H]).

stop()->halt().

read()->read([]).
read(List)->
	case io:fread("", "~d") of
		eof->List;
		{ok, [E]}->read(List++[E])
	end.

