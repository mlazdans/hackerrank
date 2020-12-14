%% https://www.hackerrank.com/challenges/saveprincess2
-module(solution).
-export([main/0,stop/0]).

main()->solve(read_board()).

solve({N, Board})->
	P=princess_at({N, Board}),
	M=me_at({N, Board}),
	move(M, P)
.

move({My,_}, {Py,_}) when My < Py ->
	io:format("DOWN~n");
move({My,_}, {Py,_}) when My > Py ->
	io:format("UP~n");
move({_,Mx}, {_,Px}) when Mx < Px ->
	io:format("RIGHT~n");
move({_,Mx}, {_,Px}) when Mx > Px ->
	io:format("LEFT~n");
move(_, _)->ok.

princess_at({N, Board})->object_at({N, Board}, 2).
me_at({N, Board})->object_at({N, Board}, 1).

object_at({N, Board}, O)->
	object_at({N, Board}, O, 1).
object_at({N, Board}, O, Y) when Y =< N->
	X=string:str(lists:nth(Y, Board), [O]),
	case X of
		0->object_at({N, Board}, O, Y + 1);
		_->{Y, X}
	end.

stop()->
	halt().

read_board()->
	{ok, [N]} = io:fread("", "~d"),
	{ok, [_]} = io:fread("", "~s"),
	{ok, [_]} = io:fread("", "~s"),
	read_board({N, []}, 1).
read_board({N, Board}, I) when I =< N ->
	case io:fread("", "~s") of
		{ok, [Line]}->read_board({N, Board++[interpret_line(Line)]}, I + 1)
	end;
read_board({N, Board}, I) when I > N ->
	{N, Board}.

interpret_line([], Col)->
	Col;
interpret_line([H|Tail], Col)->
	case H of
		45->interpret_line(Tail, Col++[0]);  %% -
		109->interpret_line(Tail, Col++[1]); %% m
		112->interpret_line(Tail, Col++[2]); %% p
		_->io:format("~p~n", [H])
	end.
interpret_line(Line)->
	interpret_line(Line, [])
.

