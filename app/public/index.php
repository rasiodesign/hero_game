<?php

require_once __DIR__ . '/config/config.php';
require __DIR__ . '/vendor/autoload.php';

use Libraries\Player;
use Libraries\Orderus;
use War\Magic;

if (empty($orderusConfig) || empty($beastConfig)) {
    die("Invalid config!");
}


$orderusPlayer = new Orderus($orderusConfig);
$beastPlayer = new Player($beastConfig);
$battle = new Magic($orderusPlayer, $beastPlayer, $skills);

function start(\War\War $battle, \Libraries\Fighter $orderusPlayer, \Libraries\Fighter $beastPlayer, array $skills){
    $battle->start($orderusPlayer, $beastPlayer, $skills);
}

start($battle, $orderusPlayer, $beastPlayer, $skills);
