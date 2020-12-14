%% https://www.hackerrank.com/challenges/fp-hello-world
-module(solution).
-export([main/0,stop/0]).

main()->io:format("~s~n",[solve()]).

solve()->"Hello World".

stop()->halt().

