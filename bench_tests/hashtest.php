<?php

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

$tests = 1000000;

$outcomes1 = array(
    "Rock" => array(
        "Rock"     => 2,
        "Paper"    => 0,
        "Spock"    => 0
    ),
    "Paper"    => array(
        "Paper"    => 2,
        "Scissors" => 0,
        "Lizard"   => 0,
    ),
    "Scissors" => array(
        "Rock"     => 0,
        "Scissors" => 2,
        "Spock"    => 0
    ),
    "Lizard"   => array(
        "Rock"     => 0,
        "Scissors" => 0,
        "Lizard"   => 2,
    ),
    "Spock"    => array(
        "Paper"    => 0,
        "Lizard"   => 0,
        "Spock"    => 2
    )
);

$outcomes2 = array(
	"e0d5865cce779aff944ec1f85485ecdc" => 2,
	"1f1f92879bb76169606efc02f3279457" => 0,
	"6f16ca156b3ec43e64a3b799bf4cfd12" => 0,
	"c47d8ed4b10883c0ec3fada0c550d264" => 2,
	"d5246969e5a8d933bbcd33598600faed" => 0,
	"9fe043ddec958e795d0d4de4370b3969" => 0,
	"d6de56e908cdfe9dd29dc5989553a2c5" => 0,
	"99e2f2711fac08caa8c3143f472d275c" => 2,
	"8ae5ac43f9e3301991a902a6c2f34b1b" => 0,
	"280262ee61c5b1bec68a3bc3889ab877" => 0,
	"f1e63da149d4d9222b6d48219a304134" => 0,
	"3fe70df1dda7ae5adb38de574faa7cfd" => 2,
	"5a33055edfbbf8dccccac660ffb334c5" => 0,
	"841291b1299b02116f0631aa092bb42b" => 0,
	"0345236e1dde1616239bb94198a6b8d7" => 2
);

$outcomes3 = array(
	"Rock|Rock"         => 2,
	"Rock|Paper"        => 0,
	"Rock|Spock"        => 0,
	"Paper|Paper"       => 2,
	"Paper|Scissors"    => 0,
	"Paper|Lizard"      => 0,
	"Scissors|Rock"     => 0,
	"Scissors|Scissors" => 2,
	"Scissors|Spock"    => 0,
	"Lizard|Rock"       => 0,
	"Lizard|Scissors"   => 0,
	"Lizard|Lizard"     => 2,
	"Spock|Paper"       => 0,
	"Spock|Lizard"      => 0,
	"Spock|Spock"       => 2
);

$moves = array("Rock", "Paper", "Scissors", "Lizard", "Spock");

$time_start = microtime_float();
for ($i = 0; $i < $tests; $i++)
{
	$myMove = "Rock";
	$computerMove = $moves[array_rand($moves)];

	if (!in_array($computerMove,array_keys($outcomes1[$myMove])))
	{
		//echo "1 ";
	}
	else
	{
		//echo $outcomes1[$myMove][$computerMove]." ";
	}
}
$time_end = microtime_float();
$time = $time_end - $time_start;

echo "\nTested multi-dimensional array in ".$time." seconds\n";

$time_start = microtime_float();
for ($i = 0; $i < $tests; $i++)
{
	$myMove = "Rock";
	$computerMove = $moves[array_rand($moves)];

	$outcomeHash = md5($myMove."|".$computerMove);

	if (!array_key_exists($outcomeHash, $outcomes2))
	{
		//echo "1 ";
	}
	else
	{
		//echo $outcomes2[$outcomeHash]." ";
	}

}
$time_end = microtime_float();
$time = $time_end - $time_start;

echo "\nTested hash map in ".$time." seconds\n";

$time_start = microtime_float();
for ($i = 0; $i < $tests; $i++)
{
	$myMove = "Rock";
	$computerMove = $moves[array_rand($moves)];

	$outcomeHash = $myMove."|".$computerMove;

	if (!array_key_exists($outcomeHash, $outcomes3))
	{
		//echo "1 ";
	}
	else
	{
		//echo $outcomes2[$outcomeHash]." ";
	}

}
$time_end = microtime_float();
$time = $time_end - $time_start;

echo "\nTested simple hash map in ".$time." seconds\n";

$time_start = microtime_float();
for ($i = 0; $i < $tests; $i++)
{
	$myMove = "Rock";
	$computerMove = $moves[array_rand($moves)];

	switch (true)
	{
	    case ($myMove == $computerMove):
	        //echo "2 ";
	        break;
	    case ($myMove == "Rock"     && ($computerMove == "Paper"    || $computerMove == "Spock")):
	    case ($myMove == "Paper"    && ($computerMove == "Scissors" || $computerMove == "Lizard")):
	    case ($myMove == "Scissors" && ($computerMove == "Rock"     || $computerMove == "Spock")):
	    case ($myMove == "Lizard"   && ($computerMove == "Rock"     || $computerMove == "Scissors")):
	    case ($myMove == "Spock"    && ($computerMove == "Lizard"   || $computerMove == "Paper")):
	        //echo "0 ";
	        break;
	    default:
	        //echo "1 ";
	}
}
$time_end = microtime_float();
$time = $time_end - $time_start;

echo "\nTested switch/case statements array in ".$time." seconds\n";