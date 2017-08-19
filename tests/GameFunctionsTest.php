<?php

require 'vendor/autoload.php';

require_once './objects/Bid.php';
require_once './objects/Hand.php';
require_once './objects/Player.php';

require_once './functions/game_functions.php';

use PHPUnit\Framework\TestCase;

class GameFunctionsTest extends TestCase {
    public function testFindWinningBid_Basic() {
        $p1 = new Player('Mozart', new Hand([20,30]));
        $p2 = new Player('Bach', new Hand([21,31]));
        $p3 = new Player('Chopin', new Hand([22,32]));

        $bids = array();
        array_push($bids, new Bid(10, $p1)); 
        array_push($bids, new Bid(11, $p2)); 
        array_push($bids, new Bid(12, $p3)); 

        // test
        $result = findWinningBid($bids);

        $this->assertEquals(12, $result->getCard());
        $this->assertTrue($p3 === $result->getPlayer());
    }

    public function testGetBidsForRound_Basic() {
        $p1 = new Player('Mozart', new Hand([10,20,30]));
        $p2 = new Player('Bach', new Hand([11,21,31]));
        $p3 = new Player('Chopin', new Hand([12,22,32]));

        $players = array();
        $players[$p1->getName()] = $p1;
        $players[$p2->getName()] = $p2;
        $players[$p3->getName()] = $p3;

        // test
        list($bids, $newPlayers) = getBidsForRound($players);

        usort($bids, function ($item1, $item2) {
            return $item1->getCard() <=> $item2->getCard();
        });
        $this->assertEquals(10, $bids[0]->getCard());
        $this->assertEquals(11, $bids[1]->getCard());
        $this->assertEquals(12, $bids[2]->getCard());

        $this->assertEquals('Mozart', $bids[0]->getPlayer()->getName());
        $this->assertEquals('Bach', $bids[1]->getPlayer()->getName());
        $this->assertEquals('Chopin', $bids[2]->getPlayer()->getName());
    }
}
