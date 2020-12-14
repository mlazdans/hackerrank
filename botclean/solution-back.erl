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
	{_N,A}=move_bot(Board),
	io:format("~p~n", [A])
	%%io:format("~s~n", [lists:nth(1, A)])
.
move_bot(Board)->
	move_bot(Board, []).
move_bot(Board, Moves)->
	{Y, X} = bot_at(Board),
	move_bot(Board, Moves, {Y, X}).
move_bot(Board, Moves, {Y, X})->
	IC = is_clean(Board),
	if
		(Y >= ?N) or (X >= ?N) or (X < 0) or (Y < 0)->false;
		%%IC->print(Board),io:format("MOVES=~p~n", [Moves]),Moves;
		IC->io:format("Solved:~p~n", [Moves]),{solved, Moves};
		true->
			A = get(Board, Y,X),
			if
				A==?VISITED->false;
				true->
					if
						A==?DIRT->
							NB=set(Board, Y, X, ?BOT),
							case move_bot(NB, Moves++["CLEAN"], {Y, X}) of
								{solved, M}->{solved, M};
								false->false
							end;
						true->
							NB=set(Board, Y, X, ?VISITED),
							case move_bot(NB, Moves++["UP"], {Y-1, X}) of
								{solved, M}->{solved, M};
								false->case move_bot(NB, Moves++["DOWN"], {Y+1, X}) of
									{solved, M}->{solved, M};
									false->case move_bot(NB, Moves++["LEFT"], {Y, X-1}) of
										{solved, M}->{solved, M};
										false->case move_bot(NB, Moves++["RIGHT"], {Y, X+1}) of
											{solved, M}->{solved, M};
											false->false
										end
									end
								end
							end
					end
			end
	end
	.

% move_bot(Board)->
	% move_bot(Board, []).
% move_bot(Board, Moves)->
	% {Y, X} = bot_at(Board),
	% move_bot(Board, Moves, {Y, X}).
% move_bot(Board, Moves, {Y, X})->
	% M=possible_moves(Board, {Y, X}),
	% move_bot(Board, Moves, {Y, X}, M).
% move_bot(Board, Moves, {Y, X}, M)->
	% print(Board),
	% A = get(Board, Y,X),
	% io:format("Y=~p,X=~p,A=~p~n", [Y, X, A]),
	% NB=set(Board, Y, X, ?VISITED),
	% if
		% A band ?DIRT>0->move_bot(NB, Moves++["CLEAN"], {Y, X});
		% true->Moves++["MOVE"]
		% %%A band ?E==0->
	% end
% %%	case is_clean(Board) of
% %%		true->Moves;
% %%		false->move_bot
% %%	io:format("~p~n", [A])
% ;
% move_bot(Board, Moves, {Y, X}, [])->
	% Moves.

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

% print(false)->false;
% print({N, Board})->print({N, Board}, 1).
% print({N, Board}, I) when I =< N*N ->
	% io:format("~p", [lists:nth(I, Board)]),
	% if
		% (I rem (N) =:= 0)->io:format("~n");
		% true->io:format("")
	% end,
	% print({N, Board}, I + 1);
% print(_, _)->ok.

