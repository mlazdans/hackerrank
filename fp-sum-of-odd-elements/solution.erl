%% https://www.hackerrank.com/challenges/fp-sum-of-odd-elements
-module(solution).
-export([main/0,stop/0]).

main()->solve(read()).

solve(List)->
	L1=lists:filter(fun(E)-> abs(E) rem 2 == 1 end, List),
	io:format("~w~n", [lists:sum(L1)]).

stop()->halt().

read()->
	read([]).
read(List)->
	case io:fread("", "~d") of
		eof->List;
		{ok, [E]}->read(List++[E])
	end.

