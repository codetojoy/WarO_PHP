
<?php 

class Hand {
    private $cards;

    function __construct($cards) {
        $this->cards = $cards;
    }

    public function selectCard() {
        $card = $this->cards[0];
        $newHand = new Hand(array_slice($this->cards,1));
        return [$card, $newHand];
    } 
}

?>
