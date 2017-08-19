
<?php 

require 'vendor/autoload.php';

require 'Bid.php';
require 'Hand.php';
require 'Player.php';
require 'GameState.php';

use Widmogrod\Functional as f;
use Widmogrod\Monad\State as s;

function updateState($prizeCard, $gameState, $dummy) {
    $newGameState = $gameState->playRound($prizeCard);

    return [$prizeCard, $newGameState];
}

function buildGameState($prizeCard, $dummy = []) { 
    return s\state(function($gameState) use ($prizeCard, $dummy) {
        return updateState($prizeCard, $gameState, $dummy);
    }); 
} 

function playRound($prizeCard, $dummy = []) { 
    return f\curryN(2, 'buildGameState')(...func_get_args()); 
} 

//------------- configure 

$p1 = new Player('Mozart',new Hand(array(1,4,5,8)));
$p2 = new Player('Chopin',new Hand(array(2,3,6,7)));

$config = array();
$config[$p1->getName()] = $p1;
$config[$p2->getName()] = $p2;

$kitty = [10,20,30,40];

//------------- main 

/*
e.g. playRound(10, [])
        ->bind(playRound(20))
        ->bind(playRound(30))
        ->bind(playRound(40))
*/

$chain = playRound(array_pop($kitty), []);

foreach($kitty as $prizeCard) {
    $chain = $chain->bind(playRound($prizeCard));
}

list($x, $finalGameState) = s\runState($chain, new GameState($config)); 

$finalGameState->logState();

?>