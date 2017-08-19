
<?php 

require 'vendor/autoload.php';

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

?>
