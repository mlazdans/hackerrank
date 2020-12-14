%% https://www.hackerrank.com/challenges/string-compression
-module(solution).
-export([main/0,stop/0]).

main()->solve(read()).

d(L) when L==0->"";
d(L)->integer_to_list(L+1).

compress([])->[];
compress([C1|S])->compress(S, C1, 0).

compress([], C1, N)->[C1,d(N)];
compress([C2|S], C1, N) when C1==C2->compress(S, C1, N+1);
compress([C2|S], C1, N)->[C1,d(N)]++compress(S, C2, 0).

solve(S)->
	io:format("~s~n", [compress(S)]).

stop()->halt().

read()->
	{ok, [S]} = io:fread("", "~s"),
	S.

