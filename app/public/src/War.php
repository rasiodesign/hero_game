<?php
namespace War;

/**
 * War Interface
 *
 * @author    Silviu Bobicescu <silviu_bobicescu@yahoo.com>
 */
interface War
{

    public function start();

    public function applyDamage();

    public function saveStrikes();

    public function switchPlayers();

    public function checkHook($action);

}