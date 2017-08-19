
<?php 

require 'game_functions.php';

class GameState {
    private $players;

    function __construct($players) {
        $this->players = $players;
    }

    public function logState() {
        foreach($this->players as $p) {
            $p->logState();
        };
    }

    public function getPlayers() { return $this->players; }

    public function playRound($prizeCard) {
        $newPlayers = playRoundForPlayers($prizeCard, $this->players);
        
        return new GameState($newPlayers);
    }
}

?>
