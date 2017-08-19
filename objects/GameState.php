
<?php 

require_once './functions/game_functions.php';

class GameState {
    private $players;

    function __construct($players) {
        $this->players = $players;
    }

    public function logState() {
        echo "-------\n";
        foreach($this->players as $p) {
            $p->logState();
        };
        echo "\n\n";
    }

    public function playRound($prizeCard) {
        $newPlayers = playRoundForPlayers($prizeCard, $this->players);
        
        return new GameState($newPlayers);
    }
}

?>
