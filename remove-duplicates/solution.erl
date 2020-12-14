%% https://www.hackerrank.com/challenges/remove-duplicates
-module(solution).
-export([main/0,stop/0]).

main()->solve(read()).

remove_dups(L) ->
	T = ets:new(temp,[set]),
	L1 = lists:filter(
		fun(X) -> ets:insert_new(T, {X,1}) end, L),
	ets:delete(T),
	L1.

solve(S)->io:format("~s~n", [remove_dups(S)]).

stop()->halt().

read()->
	{ok, [S]} = io:fread("", "~s"),
	S.

