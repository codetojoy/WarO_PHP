
<?php 

class Player {
    private $name;
    private $hand; 
    private $roundsWon;
    private $total;

    function __construct($name, $hand, $roundWon = 0, $total = 0) {
        $this->name = $name;
        $this->hand = $hand;
        $this->roundsWon = $roundWon;
        $this->total = $total;
    }

    public function getName() { return $this->name; }
    public function getTotal() { return $this->total; }

    public function logState() {
        echo "name: ".$this->name." roundsWon: ".$this->roundsWon." total: ".$this->total."\n";
    }

    public function clonePlayer() {
        $newPlayer = new Player($this->name, $this->hand, $this->roundsWon, $this->total);
        return $newPlayer;
    }

    public function getBid() { 
        list($card, $newHand) = $this->hand->selectCard();
        $newPlayer = $this->clonePlayer();
        $newPlayer->hand = $newHand;
        return [$card, $newPlayer];
    }
    
    public function winsRound($prizeCard) {
        $newPlayer = $this->clonePlayer();
        $newPlayer->roundsWon = $this->roundsWon + 1;
        $newPlayer->total = $this->total + $prizeCard;
        return $newPlayer;
    }
}

?>
