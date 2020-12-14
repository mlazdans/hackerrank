%% https://www.hackerrank.com/challenges/jumping-bunnies
-module(solution).
-export([main/0,stop/0]).

main()->solve(read()).

lcm(L)->lcm(L, 2, 1).
lcm(L, Div, Acc)->lcm(L, Div, Acc, lists:filter(fun(E)-> E rem Div == 0 end, L)).
lcm(L, Div, Acc, [])->lcm(L, Div+1, Acc);
lcm(L, Div, Acc, _A)->
	B=lists:filtermap(
		fun(E)->
			case E rem Div of
				0->{true, E div Div};
				_->{true, E}
			end
		end,
	L),
	D=lists:dropwhile(fun(E)-> E==1 end, B),
	case length(D) of
		0->Acc*Div;
		_->lcm(B, Div, Acc * Div)
	end
.

solve(Dist)->io:format("~w~n", [lcm(Dist)]).

stop()->halt().

list2int(L)->lists:map(fun(X)->{Int, _} = string:to_integer(X), Int end, L).

read()->
	{ok, [_N]}=io:fread("", "~d"),
	list2int(string:tokens(io:get_line(""), " \n\r")).

