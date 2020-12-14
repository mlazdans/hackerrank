%% https://www.hackerrank.com/challenges/eval-ex
-module(solution).
-export([main/0,stop/0]).

main()->solve(read()).

solve(List)->lists:map(fun(E)-> io:format("~.4f~n", [ex(E)]) end, List).

ex(X)->ex(X, X, 1, 1, 1).
ex(_X, _XX, _Fac, Acc, 10)->Acc;
ex(X, XX, Fac, Acc, N)->ex(X, XX*X, Fac*(N+1), Acc + XX/Fac, N+1).

stop()->halt().

read()->
	{ok, [_N]}=io:fread("", "~d"),
	read([]).
read(List)->
	case io:fread("", "~f") of
		eof->List;
		{ok, [E]}->read(List++[E])
	end.

