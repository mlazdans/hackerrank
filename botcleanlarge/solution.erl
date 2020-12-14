%% https://www.hackerrank.com/challenges/botcleanlarge
-module(solution).
-export([main/0,main/1,stop/0]).

-define(E, 0).
-define(BOT, 1).
-define(DIRT, 2).
-define(VISITED, 8).

-define(C_E, 45).
-define(C_BOT, 98).
-define(C_DIRT, 100).

-define(L, 8). % Limit distance

main()->solve(readin()).
main(FileName)->
	{ok, Device} = file:open(FileName, [read]),
	solve(readin(Device)).

stop()->halt().

%fprof:apply({solution, main}, ["data.txt"]).
%fprof:profile().
%fprof:analyse({dest, "outfile.fprof"}).

%get_dirts({H,W, Board})->
%	lists:filter(fun(E)->lists:nth(E, Board) band ?DIRT>0 end, lists:seq(1, H*W)).

distance(Board, I1, I2)->distance(Board, ixy(Board, I1), ixy(Board, I2), 0).
distance(Board, {Y,X}, {Dy,Dx}, C) when (X < Dx) -> distance(Board, {Y,X+1}, {Dy,Dx}, C+1);
distance(Board, {Y,X}, {Dy,Dx}, C) when (Y < Dy) -> distance(Board, {Y+1,X}, {Dy,Dx}, C+1);
distance(Board, {Y,X}, {Dy,Dx}, C) when (X > Dx) -> distance(Board, {Y,X-1}, {Dy,Dx}, C+1);
distance(Board, {Y,X}, {Dy,Dx}, C) when (Y > Dy) -> distance(Board, {Y-1,X}, {Dy,Dx}, C+1);
distance(_,_,_,C)->C.


get_distances(Board,[E|T])->get_distances(Board,E,T).
get_distances(_Board,_E1, [])->[];
get_distances(Board,E1, L)->lists:map(fun(E2)->{E1,E2, distance(Board,E1,E2)} end,L)++get_distances(Board,L).

%24,[23,18,12]

perms([]) -> [[]];
perms(L)  -> [[H|T] || H <- L, T <- perms(L--[H])].

paths(_Dsts, [])->0;
paths(Dsts, [H|T])->paths(Dsts, H, T).
paths(_Dsts, _From, [])->0;
paths(Dsts, From, [To|[]])->
	find_dist(Dsts, From, To);
paths(Dsts, From, [To|Paths])->
	D=find_dist(Dsts, From, To),
	%io:format("Path: ~p->~p=~p~n", [From, To, D]),
	D + paths(Dsts, To, Paths)
.

find_dist(Dsts, From, To)->find_dist(Dsts, {From, To}).
find_dist([], _)->false;
find_dist([{F,T,D}|_Tail], {From, To}) when ((F==From) and (T==To)) or ((F==To) and (T==From))->D;
find_dist([_H|Tail], {From, To})->find_dist(Tail, {From, To}).

solve(Board)->
	%print(Board),
	BotI=bot_at_i(Board),
	Bot=bot_at(Board),

	CD1=closest_dirt_at(Board, Bot),
	Dist=remove_dups(get_distances(Board, BotI, CD1)),
	%io:format("CD1=~p\tDist=~p~n", [CD1,Dist]),
	%io:format("BotI=~p~n", [BotI]),
	BDF=lists:sublist(
		lists:filter(fun({From, _To, _Dist})->From==BotI end, Dist),
		1,
		?L),
	BotDist=lists:sort(fun({_From1,_To1,Dist1}, {_From2,_To2,Dist2}) -> (Dist1 < Dist2) end, BDF),
	CD=lists:map(fun({_From,To,_Dist})->To end, BotDist),

	%P=find_dist(Dist, 19, 8),
	%P=paths(bot_at_i(Board), CD, Dist),
	AllPaths1=perms(CD),
	AllPaths=lists:map(fun(E)->[BotI]++E end, AllPaths1),
	%io:format("AllPaths1=~p~n", [AllPaths1]),

	P1=lists:map(
		fun(E)->
			TotalDist=paths(Dist, E),
			%TotalDist=find_dist(Dist, BotI, lists:nth(1, E)) + paths(Dist, E),
			{TotalDist, E}
		end, AllPaths),
	P=lists:sort(fun({D1,_P1}, {D2,_P2}) -> (D1 < D2) end, P1),
	%io:format("CD1=~p~nBotDist=~p~nDist=~p~nAllPaths=~p~nP=~p~n", [CD1, BotDist, Dist, AllPaths, P]),
	{_Moves, Path}=lists:nth(1, P),
	M=move_closest(Board, Bot, ixy(Board, lists:nth(2, Path))),
	io:format("~s~n", [M])
	%io:format("M=~p~nCD=~p~nPath=~p~n", [M,CD,Path])
	%
	%io:format("Objs=~p~nDist=~p~n", [Objs,Dist])
.

move_closest(_Board, {_Y,X}, {_Dy,Dx}) when (X < Dx) -> "RIGHT";
move_closest(_Board, {Y,_X}, {Dy,_Dx}) when (Y < Dy) -> "DOWN";
move_closest(_Board, {_Y,X}, {_Dy,Dx}) when (X > Dx) -> "LEFT";
move_closest(_Board, {Y,_X}, {Dy,_Dx}) when (Y > Dy) -> "UP";
move_closest(_,_,_)->"CLEAN".

closest_dirt_at(Board, Bot)->
	closest_dirt_at(Board, Bot, [], 0).
closest_dirt_at(_Board, _Bot, Dirts, _D) when length(Dirts)>=?L->Dirts;
closest_dirt_at({H,W, _Board}, _Bot, Dirts, D) when D>W+H->Dirts;
%closest_dirt_at(_Board, _Bot, Dirts, D) when D>=?L->remove_dups(Dirts);
closest_dirt_at({H,W, Board}, {Y,X}, Dirts, D)->
	Indexes=lists:filter(
		fun(I)->
			Iy=(I - 1) div W,
			Ix=(I - 1) rem W,
			Dy=Iy-Y,
			Dx=Ix-X,
			AB=abs(Dx)+abs(Dy),
			P=(AB == D),
			%io:format("D=~w, I=~w\tDy=~w,Dx=~w\tAB=~w\t~p~n", [D, I, Dy,Dx,AB,P]),
			P
			%(abs(X - Ix) =< D) and (abs(Y - Iy) =< D)
			%(Iy >= Y - D) and (Iy =< Y + D) and (Ix >= X - D) and (Ix =< X + D)
		end,
	lists:seq(1, H*W)),
	%io:format("D=~w,Indexes:~p~n", [D,Indexes]),
	Dr=lists:filter(fun(N)->lists:nth(N, Board) band ?DIRT > 0 end, Indexes),
	closest_dirt_at({H,W, Board}, {Y, X}, Dirts++Dr, D+1)
.

bot_at_i(Board)->object_at_i(Board, ?BOT).
bot_at(Board)->object_at(Board, ?BOT).

object_at(Board, O)->
	ixy(Board, object_at_i(Board, O)).

object_at_i(Board, O)->
	object_at_i(Board, O, 1).
object_at_i({H,W, Board}, O, P) when P =< H*W->
	case lists:nth(P, Board) band O of
		0->object_at_i({H,W, Board}, O, P + 1);
		_->P
	end;
object_at_i(_, _, _)->false.

ixy({_H,W, _Board}, I)->
	Y=(I - 1) div W,
	X=(I - 1) rem W,
	{Y, X}.

update({H,W, Board}, Y,X,V)->
	I=Y*W+X+1,
	{H,W, lists:sublist(Board, 1, I - 1) ++ [get({H,W, Board}, Y,X) bor V] ++ lists:nthtail(I, Board)}.

get({_H,W, Board}, Y,X)->
	I=Y*W+X+1,
	lists:nth(I, Board).

readin()->readin(standard_io).
readin(Device)->
	{ok, [Y,X]} = io:fread(Device, "", "~d~d"),
	{ok, [H,W]} = io:fread(Device, "", "~d~d"),
	update(readin(Device, {H,W}),Y,X,?BOT).
readin(Device, {H,W})->
	readin(Device, {H,W, []}, 1).
readin(Device, {H,W, Board}, I) when I =< H ->
	case io:fread(Device, "", "~s") of
		{ok, [Line]}->readin(Device, {H,W, Board++interpret_line(Line)}, I + 1)
	end;
readin(_Device, {H,W, Board}, _) ->
	{H,W, Board}.

interpret_line([], Col)->
	Col;
interpret_line([H|Tail], Col)->
	case H of
		?C_E->interpret_line(Tail, Col++[?E]);
		?C_BOT->interpret_line(Tail, Col++[?BOT]);
		?C_DIRT->interpret_line(Tail, Col++[?DIRT]);
		_->io:format("~p~n", [H])
	end.
interpret_line(Line)->
	interpret_line(Line, [])
.

print(false)->false;
print({H,W, Board})->print({H,W, Board}, 1).
print({H,W, Board}, I) when I =< W*H ->
	io:format("~p", [lists:nth(I, Board)]),
	if
		(I rem W == 0)->io:format("~n"); %% test H
		true->io:format("")
	end,
	print({H,W, Board}, I + 1);
print(_, _)->ok.

remove_dups([])    -> [];
remove_dups([H|T]) -> [H | [X || X <- remove_dups(T), X /= H]].

