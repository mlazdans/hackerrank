%% https://www.hackerrank.com/challenges/rotate-string
-module(solution).
-export([main/0,stop/0]).

main()->solve(read()).

rotate(S)->rotate(S, length(S)).
rotate(_S, 0)->io:format("~n");
rotate([H|S], N)->
	NS=S++[H],
	io:format("~s ", [NS]),
	rotate(NS, N-1).

solve(L)->lists:map(fun(E)-> rotate(E) end, L).

stop()->halt().

read()->
	{ok, [N]}=io:fread("", "~d"),
	read([], N).
read(L,0)->L;
read(L,N)->
	{ok, [S]}=io:fread("", "~s"),
	read(L++[S],N-1).


