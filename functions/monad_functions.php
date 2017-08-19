
<?php 

require 'vendor/autoload.php';

use Widmogrod\Functional as f;
use Widmogrod\Monad\State as s;

// ------- playRound

// TODO: we don't need `dummy` but there is
// something going on my understanding of the currying mechanism,
// so I'm having trouble removing it. Ugh.

function updateState($prizeCard, $gameState) {
    $newGameState = $gameState->playRound($prizeCard);

    return [$prizeCard, $newGameState];
}

function buildGameState($prizeCard, $dummy = []) { 
    return s\state(function($gameState) use ($prizeCard) {
        return updateState($prizeCard, $gameState);
    }); 
} 

function playRound($prizeCard, $dummy = []) { 
    return f\curryN(2, 'buildGameState')(...func_get_args()); 
} 

// ------- logGameState

// TODO: we don't need `prizeCard` or `dummy` but there is
// something going on my understanding of the currying mechanism,
// so I'm having trouble removing it. Ugh.

function logState($gameState) {
    // TODO: this should really be using an IO monad
    $gameState->logState();
    $unused = -1;

    return [$unused, $gameState];
}

function buildLog($prizeCard, $dummy) {
    return s\state(function($gameState) { 
        return logState($gameState);
    }); 
} 

function logGameState($prizeCard, $dummy = []) {
    return f\curryN(2, 'buildLog')(...func_get_args()); 
} 

?>
