<?php

require 'vendor/autoload.php';

require './objects/GameState.php';

use PHPUnit\Framework\TestCase;

class GameStateTest extends TestCase {
    public function testSelectCard_Basic() {
        // test

        $this->assertEquals(10, 5+5);
    }
}
