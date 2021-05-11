<?php

$orderusConfig = [
    "health" => ["min" => 70, "max" => 100],
    "strength" => ["min" => 70, "max" => 80],
    "defense" => ["min" => 45, "max" => 55],
    "speed" => ["min" => 40, "max" => 50],
    "luck" => ["min" => 10, "max" => 30]
];

$beastConfig = [
    "health" => ["min" => 60, "max" => 90],
    "strength" => ["min" => 60, "max" => 90],
    "defense" => ["min" => 40, "max" => 60],
    "speed" => ["min" => 40, "max" => 60],
    "luck" => ["min" => 25, "max" => 40]
];

$skills = [
    "beforeApplyDamage" => [
        ["class" => "Magic", "func" => "checkLucky","argument" => 1]],
    "afterSetDamage" => [
        ["class" => "Magic", "func" => "checkMagicShield","argument" => 20]],
    "afterSwitchPlayers" => [
        ["class" => "Magic", "func" => "checkRapidStrike","argument" => 10]]
];