<?php

require 'vendor/autoload.php';

require_once './objects/Bid.php';
require_once './objects/Player.php';

require_once './functions/game_functions.php';

use PHPUnit\Framework\TestCase;

class GameFunctionsTest extends TestCase {
    public function testFindWinningBid_Basic() {
        $p1 = new Player('Mozart', [20,30]);
        $p2 = new Player('Bach', [21,31]);
        $p3 = new Player('Chopin', [22,32]);

        $bids = array();
        array_push($bids, new Bid(10, $p1)); 
        array_push($bids, new Bid(11, $p2)); 
        array_push($bids, new Bid(12, $p3)); 

        // test
        $result = findWinningBid($bids);

        $this->assertEquals(12, $result->getCard());
        $this->assertTrue($p3 === $result->getPlayer());
    }
}
