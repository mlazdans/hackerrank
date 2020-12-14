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

-define(L, 2). % Limit distance

main()->solve(readin()).
main(FileName)->
	{ok, Device} = file:open(FileName, [read]),
	solve(readin(Device)).

%fprof:apply({solution, main}, ["data.txt"]).
%fprof:profile().
%fprof:analyse({dest, "outfile.fprof"}).

mark(Board)->
	Board.

solve(Board)->
	print(Board),
	B=mark(Board),
	io:format("~n"),
	print(B),
	halt(),
	move_bot(Board),
	Moves=store_get(),
	%Moves=[],
	%DA=dirt_at(Board),
	%io:format("Moves=~p~n", [Moves]),
	%M=move_closest(Board),
	%io:format("M=~p~n", [M]),
	%halt(),
	%%io:format("Sol=~p~n", [Moves])
	%lists:map(fun(I)->
		%io:format("Board[~p]=~p~n", [I,ixy(Board, I)])
	%	ixy(Board, I)
	%end, lists:seq(1,length(B))),
	%halt(),
	if
		length(Moves)>0->io:format("~s~n", [lists:nth(1, Moves)]);
		true->io:format("~s~n", [move_closest(Board)])
	end
.

move_closest(Board)->
	Bot=bot_at(Board),
	CD=closest_dirt_at(Board, Bot),
	%io:format("Bot=~p,CD=~p~n", [Bot,CD]),
	move_closest(Board, Bot, CD).
move_closest(_Board, {_Y,X}, {_Dy,Dx}) when (X < Dx) -> "RIGHT";
move_closest(_Board, {Y,_X}, {Dy,_Dx}) when (Y < Dy) -> "DOWN";
move_closest(_Board, {_Y,X}, {_Dy,Dx}) when (X > Dx) -> "LEFT";
move_closest(_Board, {Y,_X}, {Dy,_Dx}) when (Y > Dy) -> "UP";
move_closest(_,_,_)->"CLEAN".

closest_dirt_at(Board, Bot)->
	closest_dirt_at(Board, Bot, 0).
closest_dirt_at({H,W, Board}, {Y, X}, D)->
	%io:format("H=~p,W=~p,Y=~p,X=~p,D=~p~n", [H,W, Y, X,D]),
	Indexes=lists:filter(
		fun(I)->
			Iy=(I - 1) div W,
			Ix=(I - 1) rem W,
			(Iy >= Y - D) and (Iy =< Y + D) and
			(Ix >= X - D) and (Ix =< X + D)
			%and

			%((Ix == X + D) or (Iy == Y + D))
		end,
	lists:seq(1, H*W)),
	%BoardPart=lists:map(fun(N)->lists:nth(N, Board) end, Indexes),
	Dr=lists:dropwhile(fun(N)->(lists:nth(N, Board) band ?DIRT) == 0 end, Indexes),
	%io:format("Indexes:~p,Dr=~p,D=~p~n~n", [Indexes,Dr,D]),
	if
		length(Dr)>0->ixy({H,W, Board}, lists:nth(1, Dr));
		true->closest_dirt_at({H,W, Board}, {Y, X}, D+1)
	end
.


move_bot(Board)->move_bot(Board, bot_at(Board)).
move_bot(Board, SC)->move_bot(Board, SC, []).

move_bot(Board, SC, Moves)->
	{Y, X} = bot_at(Board),
	ets:new(solutions, [set, named_table]),
	move_bot(Board, SC, Moves, {Y, X})
.

move_bot(Board, SC, Moves, {Y, X})->
	move_bot(Board, SC, Moves, {Y, X}, 0).

move_bot({H,W, _Board}, {Sy, Sx}, _Moves, {Y, X}, _D) when (Y >= H) or (X >= W) or (X < 0) or (Y < 0) or (abs(Sy-Y) > ?L) or (abs(Sx-X) > ?L)->false;
move_bot(Board, SC, Moves, {Y, X}, D)->
	move_bot(Board, SC, Moves, {Y, X}, D, is_clean(Board, SC)).

move_bot(_Board, _SC, Moves, _Coords, _D, IC) when IC ->
	%%io:format("Solved:~p~n", [Moves]),
	store_put_if(Moves),
	%%io:format("Sol:~p~n", [Sol]),
	%%halt(),
	%%ets:insert(Store, {solutions, Moves}),
	{solved, Moves};
move_bot(Board, SC, Moves, {Y, X}, D, IC)->
%%	A=get(Board, Y,X),
%%	io:format("A&DIRT=~p,A&VISITED=~p~n", [A band ?DIRT, A band ?VISITED]),
	move_bot(Board, SC, Moves, {Y, X}, D, IC, get(Board, Y,X)).

move_bot(_Board, _SC, _Moves, _Coords, _D, _IC, Curr) when (Curr band ?VISITED>0)->false;
move_bot(Board, SC, Moves, {Y, X}, D, _IC, Curr) when (Curr band ?DIRT>0)->NB=set(Board, Y, X, ?BOT),move_bot(NB, SC, Moves++["CLEAN"], {Y, X}, D + 1);
move_bot(Board, SC, Moves, {Y, X}, D, _IC, _Curr)->
	NB=set(Board, Y, X, ?VISITED),
	%io:format("D=~p~n", [D]),
	%print(Board),
	%io:format("~n"),
	move_bot(NB, SC, Moves++["UP"], {Y-1, X}, D + 1),
	move_bot(NB, SC, Moves++["DOWN"], {Y+1, X}, D + 1),
	move_bot(NB, SC, Moves++["LEFT"], {Y, X-1}, D + 1),
	move_bot(NB, SC, Moves++["RIGHT"], {Y, X+1}, D + 1).

is_clean({H,W, Board}, {Sy, Sx})->
	%io:format("H=~p,W=~p,Sy=~p,Sx=~p", [H,W, Sy, Sx]),
	Indexes=lists:filter(
		fun(I)->
			Iy=(I - 1) div W,
			Ix=(I - 1) rem W,
			(Iy >= Sy - ?L) and (Iy =< Sy + ?L) and
			(Ix >= Sx - ?L) and (Ix =< Sx + ?L)
		end,
	lists:seq(1, H*W)),
	BoardPart=lists:map(fun(N)->lists:nth(N, Board) end, Indexes),
	length(lists:dropwhile(fun(E)->(E band ?DIRT) == 0 end, BoardPart)) == 0
	%I=Sy*H+Sx+1,
	%(I rem (H) =:= 0)->io:format("~n"); %% test H
	%%length(lists:dropwhile(fun(E)->(E band ?DIRT) == 0 end, Board)) == 0
.

stop()->
	halt().

dirt_at(Board)->object_at(Board, ?DIRT).
bot_at(Board)->object_at(Board, ?BOT).

object_at(Board, O)->
	object_at(Board, O, 1).
object_at({H,W, Board}, O, P) when P =< H*W->
	case lists:nth(P, Board) band O of
		0->object_at({H,W, Board}, O, P + 1);
		_->{(P - 1) div W, (P - 1) rem W} %% test H,W
	end;
object_at(_, _, _)->false.


update({H,W, Board}, Y,X,V)->
	I=Y*W+X+1,
	{H,W, lists:sublist(Board, 1, I - 1) ++ [get({H,W, Board}, Y,X) bor V] ++ lists:nthtail(I, Board)}.

set({H,W, Board}, Y,X,V)->
	I=Y*W+X+1,
	{H,W, lists:sublist(Board, 1, I - 1) ++ [V] ++ lists:nthtail(I, Board)}.

get(Board, {Y,X})->get(Board, Y,X).
get({H,W, Board}, Y,X)->
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
readin(Device, {H,W, Board}, _) ->
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

ixy({H,W, _Board}, I)->
	Y=(I - 1) div W,
	X=(I - 1) rem W,
	%io:format("H=~p,W=~p,I=~p,Y=~p,X=~p~n", [H,W,I, Y,X]),
	{Y, X}.

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

store_get()->
	Sol=ets:lookup(solutions, moves),
	if
		length(Sol)==0->[];
		true->
			{moves, Moves}=lists:nth(1, Sol),
			Moves
	end.

store_put_if(NewMoves)->
	Moves=store_get(),
	if
		length(Moves)==0->ets:insert(solutions, {moves,NewMoves});
		length(NewMoves)<length(Moves)->ets:insert(solutions, {moves,NewMoves});
		true->ok
	end.

