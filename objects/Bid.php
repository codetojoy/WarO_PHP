
<?php 

class Bid {
    private $card; 
    private $player;

    function __construct($card, $player) {
        $this->card = $card;    
        $this->player = $player;    
    }

    public function getCard() { return $this->card; }
    public function getPlayer() { return $this->player; }

    public static function nullBid() { return new Bid(-1, 'Dr. Null'); }
}

?>
