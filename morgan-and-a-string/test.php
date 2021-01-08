<?php

function comp($s1, $s2){
	printf("%s>%s=%d\n", $s1, $s2, $s1 > $s2);
}

comp("abc", "aaa");
comp("aaa", "aaa");
comp("aab", "aaa");
comp("aa", "aaa");
comp("bb", "aa");
comp("ba", "aa");
comp("aa", "ab");
comp("aa", "");
comp("", "aa");
comp("Y", "Z");
comp("a", "");
comp("", "a");
comp("aa", "a");
comp("ba", "a");
comp(false, "aa");
comp(false, "");
comp("", false);
