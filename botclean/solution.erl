%% https://www.hackerrank.com/challenges/botclean
-module(solution).
-export([main/0,stop/0]).

-define(E, 0).
-define(BOT, 1).
-define(DIRT, 2).
-define(VISITED, 8).

-define(C_E, 45).
-define(C_BOT, 98).
-define(C_DIRT, 100).

-define(N, 5).

main()->solve(readin()).

solve(Board)->
	%%print(Board),
	move_bot(Board),
	Moves=store_get(),
	%%io:format("Sol=~p~n", [Moves])
	io:format("~s~n", [lists:nth(1, Moves)])
.
move_bot(Board)->move_bot(Board, []).

move_bot(Board, Moves)->
	{Y, X} = bot_at(Board),
	ets:new(solutions, [set, named_table]),
	move_bot(Board, Moves, {Y, X})
	.

move_bot({N, _Board}, _Moves, {Y, X}) when (Y >= N) or (X >= N) or (X < 0) or (Y < 0)->false;
move_bot(Board, Moves, {Y, X})->
	move_bot(Board, Moves, {Y, X}, is_clean(Board)).

move_bot(_Board, Moves, _Coords, IC) when IC ->
	%%io:format("Solved:~p~n", [Moves]),
	store_put_if(Moves),
	%%io:format("Sol:~p~n", [Sol]),
	%%halt(),
	%%ets:insert(Store, {solutions, Moves}),
	{solved, Moves};
move_bot(Board, Moves, {Y, X}, IC)->
%%	A=get(Board, Y,X),
%%	io:format("A&DIRT=~p,A&VISITED=~p~n", [A band ?DIRT, A band ?VISITED]),
	move_bot(Board, Moves, {Y, X}, IC, get(Board, Y,X)).

move_bot(_Board, _Moves, _Coords, _IC, Curr) when (Curr band ?VISITED>0)->false;
move_bot(Board, Moves, {Y, X}, _IC, Curr) when (Curr band ?DIRT>0)->NB=set(Board, Y, X, ?BOT),move_bot(NB, Moves++["CLEAN"], {Y, X});
move_bot(Board, Moves, {Y, X}, _IC, _Curr)->
	NB=set(Board, Y, X, ?VISITED),
	move_bot(NB, Moves++["UP"], {Y-1, X}),
	move_bot(NB, Moves++["DOWN"], {Y+1, X}),
	move_bot(NB, Moves++["LEFT"], {Y, X-1}),
	move_bot(NB, Moves++["RIGHT"], {Y, X+1}).

is_clean({_N, Board})->length(lists:dropwhile(fun(E)->(E band ?DIRT) == 0 end, Board)) == 0.

stop()->
	halt().

bot_at(Board)->object_at(Board, ?BOT).

object_at(Board, O)->
	object_at(Board, O, 1).
object_at({N, Board}, O, P) when P =< N*N->
	case lists:nth(P, Board) band O of
		0->object_at({N, Board}, O, P + 1);
		_->{(P - 1) div N, (P - 1) rem N}
	end;
object_at(_, _, _)->false.


update({N, Board}, Y,X,V)->
	I=Y*N+X+1,
	{N, lists:sublist(Board, 1, I - 1) ++ [get({N, Board}, Y,X) bor V] ++ lists:nthtail(I, Board)}.

set({N, Board}, Y,X,V)->
	I=Y*N+X+1,
	{N, lists:sublist(Board, 1, I - 1) ++ [V] ++ lists:nthtail(I, Board)}.

get({N, Board}, Y,X)->
	I=Y*N+X+1,
	lists:nth(I, Board).

readin()->
	{ok, [Y]} = io:fread("", "~d"),
	{ok, [X]} = io:fread("", "~d"),
	update(readin(5),Y,X,?BOT).
readin(N)->
	readin({N, []}, 1).
readin({N, Board}, I) when I =< N ->
	case io:fread("", "~s") of
		{ok, [Line]}->readin({N, Board++interpret_line(Line)}, I + 1)
	end;
readin({N, Board}, _) ->
	{N, Board}.

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
print({N, Board})->print({N, Board}, 1).
print({N, Board}, I) when I =< N*N ->
	io:format("~p", [lists:nth(I, Board)]),
	if
		(I rem (N) =:= 0)->io:format("~n");
		true->io:format("")
	end,
	print({N, Board}, I + 1);
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

