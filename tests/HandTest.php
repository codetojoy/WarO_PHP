<?php

require 'vendor/autoload.php';

require './objects/Hand.php';

use PHPUnit\Framework\TestCase;

class HandTest extends TestCase {
    public function testSelectCard_Basic() {
        $hand = new Hand([10,20,30]);

        // test
        list($card, $newHand) = $hand->selectCard();

        $this->assertEquals(10, $card);
        $this->assertFalse($hand == $newHand);
    }
}
