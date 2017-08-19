
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

    private static function nullBid() { return new Bid(-1, 'Dr. Null'); }

    public static function findWinningBid($bids) {
        return array_reduce($bids, function ($cursor, $item) {
            $leader = $cursor;

            if ($item->getCard() > $cursor->getCard()) {
                $leader = $item;
            }

            return $leader;
        }, Bid::nullBid());
    }
}

?>
