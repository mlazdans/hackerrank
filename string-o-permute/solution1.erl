%% https://www.hackerrank.com/challenges/string-o-permute
-module(solution).
-export([main/0,stop/0]).

main()->solve(read()).

solve(L)->ok.
% perm(S)->
	% lists:map(
		% fun(I)->N=(I-1)*2,[lists:nth(N+2,S), lists:nth(N+1,S)] end,
		% lists:seq(1, length(S) div 2)
	% ).
%
% solve(L)->
	% io:format("~p~n", [L]),
	% lists:map(fun(E)->io:format("~s~n", [perm(E)]) end, L).

stop()->halt().

read()->
	{ok, [N]} = io:fread("", "~d"),
	{ok, [C1]} = io:fread("", "~c"),
	read(C1, "").
read(C1, "")->
	{ok, [C2]} = io:fread("", "~c"),
	read(C1, C2);
read(C1, C2)->
	io:format("~s,~s", [C2,C1]),
	case io:fread("", "~c") of
		{ok, "\n"}->io:format("!!!!");
		{ok, [C]}->read(C, "");
		eof->ok
	end.


