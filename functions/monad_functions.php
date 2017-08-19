
<?php 

require 'vendor/autoload.php';

use Widmogrod\Functional as f;
use Widmogrod\Monad\State as s;

// ------- playRound

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

function logState($prizeCard, $gameState, $dummy) {
    echo "TRACER logState\n";
    $gameState->logState();

    return [$prizeCard, $gameState];
}

function buildLog($prizeCard, $dummy = []) { 
    echo "TRACER buildLog outer \n";
    return s\state(function($gameState) use ($prizeCard, $dummy) {
        echo "TRACER buildLog inner \n";
        return logState($prizeCard, $gameState, $dummy);
    }); 
} 

function logGameState($prizeCard, $dummy = []) { 
    echo "TRACER logGameState\n";
    return f\curryN(2, 'buildLog')(...func_get_args()); 
} 

?>
