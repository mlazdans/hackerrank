%% https://www.hackerrank.com/challenges/maze-escape
-module(solution).
-export([main/0,stop/0]).

-define(E, 0).
-define(WALL, 1).
-define(DOOR, 2).
-define(VISITED, 8).

-define(C_E, 45).
-define(C_WALL, 35).
-define(C_DOOR, 101).

main()->solve(readin()).

solve(Board)->
	print(Board),
	move_bot(Board),
	Moves=store_get(),
	io:format("Sol=~p~n", [Moves])
	%%io:format("~s~n", [lists:nth(1, Moves)])
.
move_bot(Board)->move_bot(Board, []).

move_bot(Board, Moves)->
	{Y, X} = bot_at(Board),
	ets:new(solutions, [set, named_table]),
	move_bot(Board, Moves, {Y, X})
	.

move_bot({N, _Board}, _Moves, {Y, X}) when (Y >= N) or (X >= N) or (X < 0) or (Y < 0)->false;
move_bot(Board, Moves, {Y, X})->
	move_bot(Board, Moves, {Y, X}, get(Board, Y,X)).

move_bot(_Board, _Moves, _Coords, Curr) when (Curr band ?VISITED>0)->false;
move_bot(_Board, _Moves, _Coords, Curr) when (Curr band ?WALL>0)->false;
move_bot(_Board, Moves, _Coords, Curr) when (Curr band ?DOOR>0)->io:format("Moves=~p~n", [Moves]),store_put_if(Moves),{solution, Moves};
move_bot(Board, Moves, {Y, X}, _Curr)->
	NB=set(Board, Y, X, ?VISITED),
	move_bot(NB, Moves++["UP"], {Y-1, X}),
	move_bot(NB, Moves++["DOWN"], {Y+1, X}),
	move_bot(NB, Moves++["LEFT"], {Y, X-1}),
	move_bot(NB, Moves++["RIGHT"], {Y, X+1}).

stop()->
	halt().

bot_at(_Board)->{2, 2}.

% object_at(Board, O)->
	% object_at(Board, O, 1).
% object_at({N, Board}, O, P) when P =< N*N->
	% case lists:nth(P, Board) band O of
		% 0->object_at({N, Board}, O, P + 1);
		% _->{(P - 1) div N, (P - 1) rem N}
	% end;
% object_at(_, _, _)->false.


% update({N, Board}, Y,X,V)->
	% I=Y*N+X+1,
	% {N, lists:sublist(Board, 1, I - 1) ++ [get({N, Board}, Y,X) bor V] ++ lists:nthtail(I, Board)}.

set({N, Board}, Y,X,V)->
	I=Y*N+X+1,
	{N, lists:sublist(Board, 1, I - 1) ++ [V] ++ lists:nthtail(I, Board)}.

get({N, Board}, Y,X)->
	I=Y*N+X+1,
	lists:nth(I, Board).

readin()->
	{ok, [_Player]} = io:fread("", "~d"),
	readin(3).
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
		?C_WALL->interpret_line(Tail, Col++[?WALL]);
		?C_DOOR->interpret_line(Tail, Col++[?DOOR]);
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

