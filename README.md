##Please write a command line script in the language of your choice that will play Rock-Paper-Scissors-Lizard-Spock:
(http://en.wikipedia.org/wiki/Rock-paper-scissors-lizard-Spock)

The program should take as input one of the five choices (rock, paper, scissors, lizard, or spock), pick one at random for the computer to play, and pick a winner. Example output:

```
$ php rpsls.php
your move: paper
I played: spock
paper disproves spock, you win!
```

---

###Reasons for using switch/case for determining results:
####After testing with hash maps and multi-dimensional arrays, the following results were seen:

```
$ php hashtest.php
Tested multi-dimensional array in 1.4494609832764 seconds
Tested hash map in 1.2991299629211 seconds
Tested simple hash map in 0.84005308151245 seconds
Tested switch/case statements array in 0.64577412605286 seconds
```

* Even the simple hashmap ($s1."|".$s2) was over 30% slower than the switch/case. These results may not be refelcted upon using larger hash tables.