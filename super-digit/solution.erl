%% https://www.hackerrank.com/challenges/super-digit
-module(solution).
-export([main/0,stop/0]).

main()->solve(read()).

sumList(N)->lists:foldl(fun(E, Sum)->E-48+Sum end, 0, N).

sd(N) when N<10->N;
sd(N)->sd(sumList(integer_to_list(N))).

solve({N, K})->io:format("~w~n", [sd(sumList(N)*K)]).

stop()->halt().

read()->
	{ok, [N,KT]} = io:fread("", "~s ~s"),
	{K,_}=string:to_integer(KT),
	{N, K}.

