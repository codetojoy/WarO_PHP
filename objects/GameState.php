
<?php 

class GameState {
    private $players;

    function __construct($players) {
        $this->players = $players;
    }

    public function getPlayers() { return $this->players; }

    public function logState() {
        echo "-------\n";
        foreach($this->players as $p) {
            $p->logState();
        };
        echo "\n\n";
    }
}

?>
