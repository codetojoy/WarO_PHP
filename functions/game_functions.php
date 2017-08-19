
<?php 

require_once './objects/Bid.php';
require_once './objects/GameState.php';

function findWinningBid($bids) {
    return array_reduce($bids, function ($cursor, $item) {
        $leader = $cursor;

        if ($item->getCard() > $cursor->getCard()) {
            $leader = $item;
        }

        return $leader;
    }, Bid::nullBid());
}

function getBidsForRound($players) {
    $newPlayers = array();

    $bids = array_map(function ($p) use(&$newPlayers) { 
        $name = $p->getName();
        list($card, $newPlayer) = $p->getBid();
        $bid = new Bid($card, $newPlayer);
        $newPlayers[$name] = $newPlayer;
        return $bid;
    }, $players);        

    return [$bids, $newPlayers];
}

function playRoundForPlayers($prizeCard, $players) {
    list($bids, $newPlayers) = getBidsForRound($players);

    $winningBid = findWinningBid($bids);

    $winner = $winningBid->getPlayer()->winsRound($prizeCard);

    $newPlayers[$winner->getName()] = $winner;

    return $newPlayers;
}

?>
