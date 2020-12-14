%% https://www.hackerrank.com/challenges/string-o-permute
-module(solution).
-export([main/0,stop/0]).

main()->solve(read()).

part(List) ->
	part(List, []).
part([], Acc) ->
	lists:reverse(Acc);
part([H1,H2|T], Acc) ->
	part(T, [[H2,H1]|Acc]).

solve(L)->
	lists:map(fun(E)->io:format("~s~n", [part(E)]) end, L).

stop()->halt().

read()->
	{ok, [N]} = io:fread("", "~d"),
	read([], N).
read(L, 0)->L;
read(L, N)->
	{ok, [S]} = io:fread("", "~s"),
	read(L++[S], N-1).


