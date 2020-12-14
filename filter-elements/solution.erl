%% https://www.hackerrank.com/challenges/filter-elements
-module(solution).
-export([main/0,stop/0]).

% member_times(Elem, List) ->
	% length([ok || I <- List, I == Elem]).

main()->read().


member_times([])->[];
member_times([H|T])->
	member_times(H, T, 1).
member_times(H1,[H2|T],C) when H1 == H2->member_times(H1,T,C+1);
member_times(H1,L,C)->[{H1,C}]++member_times(L).

% member_times(L)->
	% member_times(L, #{}).
% %member_times([])->#{};
% member_times([H|T], Map)->
	% case maps:is_key(H, Map) of
		% true->NM=maps:update(H, maps:get())
		% false->
	% Map#{H => 1},
	% member_times(H, T, Map).

remove_dups(L) ->
	T = ets:new(temp,[set]),
	L1 = lists:filter(
		fun(X) -> ets:insert_new(T, {X,1}) end, L),
	ets:delete(T),
	L1.

% find_times(_E, [])->-1;
% find_times(E1, [{E2,T}|_Times]) when E1==E2->T;
% find_times(E1, [_H|Times])->find_times(E1, Times).

list2map(L)->
	list2map(L, #{}).
list2map([], M)->M;
list2map([{E,T}|L], M)->
	list2map(L, maps:put(E,T,M)).

solve({K,A})->
	SA=lists:sort(A),
	DA=remove_dups(A),
	Times=list2map(member_times(SA)),
	%io:format("A=~p~nDA=~p~nSA=~p~nTimes=~p~n", [A,DA,SA,Times]),
	lists:filter(
		fun(E)->
			P=maps:get(E, Times),
			P>=K
		end,
	DA).

print_res([])->io:format("-1~n");
print_res(L)->lists:map(fun(E)->io:format("~w ", [E]) end, L), io:format("~n").

stop()->halt().

read()->
	{ok, [T]} = io:fread("", "~d"),
	read(T).
read(0)->ok;
read(T)->
	{ok, [_N,K]} = io:fread("", "~d ~d"),
	L={K, list2int(string:tokens(io:get_line(""), " \n\r"))},
	print_res(solve(L)),
	read(T-1).

list2int(L)->lists:map(fun(X)->{Int, _} = string:to_integer(X), Int end, L).

