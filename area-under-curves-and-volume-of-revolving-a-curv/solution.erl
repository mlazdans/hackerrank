%% https://www.hackerrank.com/challenges/area-under-curves-and-volume-of-revolving-a-curv
-module(solution).
-export([main/0,stop/0]).

main()->solve(read()).

f(AB, X)->lists:sum(lists:map(fun({A,B})-> A * math:pow(X,B) end, AB)).
area(AB,L,R)->lists:sum(lists:map(fun(XX)->X=XX/1000, f(AB, X) end, lists:seq(L*1000,R*1000)))/1000.
volume(AB,L,R)->
	S=lists:map(fun(XX)->H=XX/1000, Rad=f(AB, H), math:pi()*Rad*Rad end, lists:seq(L*1000,R*1000)),
	lists:sum(S)/1000.

solve({AB,L,R})->io:format("~.1f~n~.1f~n", [area(AB, L,R), volume(AB, L,R)]).

stop()->halt().

list2int(L)->lists:map(fun(X)->{Int, _} = string:to_integer(X), Int end, L).

read()->
	A=list2int(string:tokens(io:get_line(""), " \n\r")),
	B=list2int(string:tokens(io:get_line(""), " \n\r")),
	[L,R]=list2int(string:tokens(io:get_line(""), " \n\r")),
	{lists:zip(A,B),L,R}.

