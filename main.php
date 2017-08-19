
<?php 

require 'vendor/autoload.php';

require_once './objects/Bid.php';
require_once './objects/Hand.php';
require_once './objects/Player.php';
require_once './objects/GameState.php';

require_once './functions/monad_functions.php';

use Widmogrod\Monad\State as s;

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
