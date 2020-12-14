%% https://www.hackerrank.com/challenges/fp-list-replication
-module(solution).
-export([main/0,stop/0]).

main()->solve(read()).

solve({S, [E|List]})->
	solve(E, S),
	solve({S, List});
solve({_S, []})->ok.

solve(E, Times) when Times > 0->
	io:format("~p~n", [E]),
	solve(E, Times - 1);
solve(_E, 0)->ok.

stop()->halt().

read()->
	{ok, [S]} = io:fread("", "~d"),
	{S, read([])}.
read(List)->
	case io:fread("", "~d") of
		eof->List;
		{ok, [E]}->read(List++[E])
	end.

