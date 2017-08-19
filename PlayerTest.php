<?php

require 'vendor/autoload.php';

require 'Hand.php';
require 'Player.php';

use PHPUnit\Framework\TestCase;

class PlayerTest extends TestCase {
    public function testClonePlayer_Basic() {
        $player = new Player('Mozart', [10,20,30], 1, 5150);

        // test
        $newPlayer = $player->clonePlayer();

        $this->assertFalse($newPlayer === $player);
        $this->assertTrue($newPlayer == $player);
    }

    public function testGetBid_Basic() {
        $hand = new Hand([10,20,30]);
        $player = new Player('Mozart', $hand);

        // test
        list($card, $newPlayer) = $player->getBid();

        $this->assertEquals(10, $card);
        $this->assertFalse($newPlayer == $player);
    }

    public function testWinsRound_Basic() {
        $hand = new Hand([10,20,30]);
        $player = new Player('Mozart', $hand);

        // test
        $newPlayer = $player->winsRound(55);

        $this->assertFalse($newPlayer == $player);
        $this->assertEquals(55, $newPlayer->getTotal());
    }
}
