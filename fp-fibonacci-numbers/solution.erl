%% https://www.hackerrank.com/challenges/functional-programming-warmups-in-recursion---fibonacci-numbers
-module(solution).
-export([main/0,stop/0]).

main()->solve(read()).

% fib(1)->0;
% fib(2)->1;
% fib(N)->fib(N-1)+fib(N-2).
fib(N)->
	fib(2,0,0,N).
fib(2,_Acc,_Last,N)->fib(3,1,1,N);
fib(C,Acc,Last,N) when C<N->
	fib(C+1,Acc+Last,Acc,N);
fib(_C,Acc,_Last,_N)->Acc.

solve(N)->io:format("~w~n", [fib(N)]).

stop()->halt().

read()->
	{ok, [N]}=io:fread("", "~d"),
	N.

