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

main()->solve(readin()).
main(FileName)->
	{ok, Device} = file:open(FileName, [read]),
	solve(readin(Device)).

stop()->halt().

%fprof:apply({solution, main}, ["data.txt"]).
%fprof:profile().
%fprof:analyse({dest, "outfile.fprof"}).

solve(Board)->io:format("~s~n", [move_closest(Board)]).

move_closest(Board)->move_closest(Board, bot_at(Board), closest_dirt_at(Board, bot_at(Board))).
move_closest(_Board, {_Y,X}, {_Dy,Dx}) when (X < Dx) -> "RIGHT";
move_closest(_Board, {Y,_X}, {Dy,_Dx}) when (Y < Dy) -> "DOWN";
move_closest(_Board, {_Y,X}, {_Dy,Dx}) when (X > Dx) -> "LEFT";
move_closest(_Board, {Y,_X}, {Dy,_Dx}) when (Y > Dy) -> "UP";
move_closest(_,_,_)->"CLEAN".

closest_dirt_at(Board, Bot)->
	closest_dirt_at(Board, Bot, 0).
closest_dirt_at({H,W, Board}, {Y, X}, D)->
	Indexes=lists:filter(
		fun(I)->
			Iy=(I - 1) div W,
			Ix=(I - 1) rem W,
			(Iy >= Y - D) and (Iy =< Y + D) and (Ix >= X - D) and (Ix =< X + D)
		end,
	lists:seq(1, H*W)),
	Dr=lists:dropwhile(fun(N)->(lists:nth(N, Board) band ?DIRT) == 0 end, Indexes),
	if
		length(Dr)>0->ixy({H,W, Board}, lists:nth(1, Dr));
		true->closest_dirt_at({H,W, Board}, {Y, X}, D+1)
	end
.

bot_at(Board)->object_at(Board, ?BOT).

object_at(Board, O)->
	object_at(Board, O, 1).
object_at({H,W, Board}, O, P) when P =< H*W->
	case lists:nth(P, Board) band O of
		0->object_at({H,W, Board}, O, P + 1);
		_->{(P - 1) div W, (P - 1) rem W}
	end;
object_at(_, _, _)->false.


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

ixy({_H,W, _Board}, I)->
	Y=(I - 1) div W,
	X=(I - 1) rem W,
	{Y, X}.

