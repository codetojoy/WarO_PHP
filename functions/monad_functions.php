
<?php 

require 'vendor/autoload.php';

require_once './functions/game_functions.php';

use Widmogrod\Functional as f;
use Widmogrod\Monad\State as s;

// TODO: we don't need `dummy` but there is
// something going on re: my understanding of the currying mechanism,
// so I'm having trouble removing it. Ugh.

// ------- playRound

function updateState($prizeCard, $gameState) {
    $newGameState = playRoundGameState($prizeCard, $gameState);

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

function buildLog($prizeCard, $dummy) {
    return s\state(function($gameState) use ($prizeCard) { 
        // TODO: this should really be using an IO monad
        $gameState->logState();
        return [$prizeCard, $gameState];
    }); 
} 

function logGameState($prizeCard, $dummy = []) {
    return f\curryN(2, 'buildLog')(...func_get_args()); 
} 

// ------- seed

function seedGameState($prizeCard, $dummy = []) { 
    return s\state(function($gameState) use ($prizeCard) {
        // identity, no-op
        return [$prizeCard, $gameState];
    }); 
} 

function seedState($prizeCard, $dummy = []) { 
    return f\curryN(2, 'seedGameState')(...func_get_args()); 
} 

?>
