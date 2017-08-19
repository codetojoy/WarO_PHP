
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

    public function getBid() { 
        list($card, $newHand) = $this->hand->selectCard();
        $newPlayer = new Player($this->name, $newHand, $this->roundsWon, $this->total);
        return [$card, $newPlayer];
    }
    
    public function winsRound($prizeCard) {
        return new Player($this->name, 
                          $this->hand, 
                          $this->roundsWon + 1, 
                          $this->total + $prizeCard);
    }
}

?>
