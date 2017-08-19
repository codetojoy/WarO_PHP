
<?php 

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

    public function getBidsForRound() {
        $newPlayers = array();

        $bids = array_map(function ($p) use(&$newPlayers) { 
            $name = $p->getName();
            list($card, $newPlayer) = $p->getBid();
            $bid = new Bid($card, $newPlayer);
            $newPlayers[$name] = $newPlayer;
            return $bid;
        }, $this->players);        

        return [$bids, $newPlayers];
    }

    public function playRound($prizeCard) {
        list($bids, $newPlayers) = $this->getBidsForRound();

        $winningBid = Bid::findWinningBid($bids);

        $winner = $winningBid->getPlayer()->winsRound($prizeCard);

        $newPlayers[$winner->getName()] = $winner;

        return new GameState($newPlayers);
    }
}

?>
