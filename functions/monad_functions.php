
<?php 

require 'vendor/autoload.php';

use Widmogrod\Functional as f;
use Widmogrod\Monad\State as s;

// ------- playRound

// TODO: we don't need `dummy` but there is
// something going on my understanding of the currying mechanism,
// so I'm having trouble removing it. Ugh.

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

// ------- logGameState

// TODO: we don't need `prizeCard` or `dummy` but there is
// something going on my understanding of the currying mechanism,
// so I'm having trouble removing it. Ugh.

function logState($prizeCard, $gameState, $dummy) {
    // TODO: this should really be using an IO monad
    $gameState->logState();

    return [$prizeCard, $gameState];
}

function buildLog($prizeCard, $dummy = []) { 
    return s\state(function($gameState) use ($prizeCard, $dummy) {
        return logState($prizeCard, $gameState, $dummy);
    }); 
} 

function logGameState($prizeCard = -1, $dummy = []) { 
    return f\curryN(2, 'buildLog')(...func_get_args()); 
} 

?>
