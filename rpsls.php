<?php

class RockPaperScissorsLizardSpock
{
    const LOSE = 0;
    const WIN = 1;
    const DRAW = 2;

     // All possible choices.
    private $_moves = array("Rock", "Paper", "Scissors", "Lizard", "Spock");
    // All possible outcomes.
    private $_outcomes = array(
        "Rock" => array(
            "Rock"     => self::DRAW,
            "Paper"    => self::LOSE,
            "Scissors" => self::WIN,
            "Lizard"   => self::WIN,
            "Spock"    => self::LOSE
        ),
        "Paper"    => array(
            "Rock"     => self::WIN,
            "Paper"    => self::DRAW,
            "Scissors" => self::LOSE,
            "Lizard"   => self::LOSE,
            "Spock"    => self::WIN
        ),
        "Scissors" => array(
            "Rock"     => self::LOSE,
            "Paper"    => self::WIN,
            "Scissors" => self::DRAW,
            "Lizard"   => self::WIN,
            "Spock"    => self::LOSE
        ),
        "Lizard"   => array(
            "Rock"     => self::LOSE,
            "Paper"    => self::WIN,
            "Scissors" => self::LOSE,
            "Lizard"   => self::DRAW,
            "Spock"    => self::WIN
        ),
        "Spock"    => array(
            "Rock"     => self::WIN,
            "Paper"    => self::LOSE,
            "Scissors" => self::WIN,
            "Lizard"   => self::LOSE,
            "Spock"    => self::DRAW
        )
    );
    private $_myMove = null;
    private $_computerMove = null;

    /**
     * Prompt the player with options they may choose while playing.
     * 
     * @return void
     */
    public function __construct()
    {
        echo "Enter your choice. Rock, Paper, Scissors, Lizard or Spock.\n";
        echo "Enter quit or anything else to exit the game.\n";

        

        return;
    }

    /**
     * Gets the _thorw() result and gives human readable results. Then asks the
     * user if they want to play again.
     * 
     * @return void
     */
    public function play()
    {
        $result = $this->_throw();

        switch ($result)
        {
            case (self::DRAW):
                echo "It's a draw.\n";
                break;
            case (self::LOSE):
                echo $this->_myMove." loses to " .$this->_computerMove.", you lose.\n";
                break;
            case (self::WIN):
            default:
                echo $this->_myMove." beats " .$this->_computerMove.", you win!\n";
                break;
        }

        $this->_playAgain();

        return;
    }

    /**
     * Gets the player's move from the command line or quits the game.
     * Sets the class variable "_myMove" to the result.
     * 
     * @return void
     */
    private function _getPlayerMove()
    {
        $line = $this->_getLine("Your move: ");
        $playerChoice = ucfirst(strtolower($line));
        switch (true)
        {
            case (in_array($playerChoice, $this->_moves)):
                $this->_myMove = $playerChoice;
                break;
            default:
                echo "Not a valid entry.\n";
                $this->_playAgain();
                exit();
        }

        return;
    }

    /**
     * Gets the computer's move from the options available.
     * Sets the class variable "_computerMove" to the result.
     * 
     * @return void
     */
    private function _getComputerMove()
    {
        $this->_computerMove = $this->_moves[array_rand($this->_moves)];

        return;
    }

    /**
     * Sets both the player and the computer's moves and compares the results.
     * The returned result is one from the constant game states.
     * 
     * @return self::DRAW | self::LOSE | self::WIN
     */
    private function _throw()
    {
        $this->_getPlayerMove();
        $this->_getComputerMove();

        echo "I played: ".$this->_computerMove."\n";

        return $this->_outcomes[$this->_myMove][$this->_computerMove];
    }

    /**
     * Prompts the player to play again.
     * 
     * @return void
     */
    private function _playAgain()
    {
        echo "\nPlay again?\n";
        $line = strtoupper($this->_getLine("Y/N? "));

        switch ($line)
        {
            case ("Y"):
                $this->play();
                break;
            default:
                echo "Thank you for playing.\n";
        }

        return;
    }

    /**
     * Helper function for getting the inputted text from the command line.
     * Supports Windows and *nix.
     * 
     * @param $prompt  String  A prompt to be given to the user before the input is taken.
     * @param $newLine Boolean Whether or not to add a "\n" after the prompt.
     * @return         String  The input line given by the user.
     */
    private function _getLine($prompt, $newLine = false)
    {
        if (PHP_OS == 'WINNT')
        {
            echo $prompt.($newLine !== false ? "\n" : "");
            $line = stream_get_line(STDIN, 1024, PHP_EOL);
        }
        else
        {
            $line = readline($prompt.($newLine !== false ? "\n" : ""));
        }

        return $line;
    }
}

$game = new RockPaperScissorsLizardSpock();
$game->play();