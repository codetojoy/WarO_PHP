
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

// build the State monad as a chain of functions

$state = playRound(array_pop($kitty), []);

foreach($kitty as $prizeCard) {
    $state = $state->bind(playRound($prizeCard));
    $state = $state->bind(logGameState($prizeCard));
}

// release the hounds!

s\runState($state, new GameState($config)); 

?>
