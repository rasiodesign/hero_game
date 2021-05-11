<?php

namespace War;

use War\Battle;

/**
 * Magic
 *
 * @author    Silviu Bobicescu <silviu_bobicescu@yahoo.com>
 */
class Magic extends Battle
{


    /**
     * Class constructor
     *
     * Get view object, generate players object
     * Set first player to strike
     *
     * @param array $orderusConfig - player stats
     * @param array $beastConfig - player stats
     * @param array $properties - skills stats
     * @return void
     */
    /*
    public function __construct(\Libraries\Fighter $orderusPlayer , \Libraries\Fighter $beastPlayer, array $skills)
    {
        parent::__construct($orderusPlayer, $beastPlayer, $skills);
    }
    */

    /**
     * Method to check if player gats Lucky
     *
     * @return boolean
     */
    public function checkLucky($a)
    {

        $luck = $this->second->get('luck');
        $taken = $this->second->get('taken');
        $getLucky = $this->second->get('getLucky');

        $percent = (($getLucky + 1) / $taken) * 100;
        if ((int)$percent < $luck) {
            $this->second->set('getLucky', $this->second->get('getLucky') +1);
            $this->view->setBattle("lucky", $this->i, $this->second->get("name"));
            return true;
        } else {
            return false;
        }

    }

    /**
     * Method to check if player can have a rapid strike
     *
     * @return boolean
     */
    public function checkRapidStrike($percent)
    {

        if ($this->second->get("name") != "Orderus") {
            return false;
        }

        $rapidStrike    = $this->second->get('rapidStrike');
        $strike         = $this->second->get('strike');

        $percentCurrent = (($rapidStrike + 1) / $strike) * 100;
        if ((int)$percentCurrent < $percent) {
            $this->second->set('rapidStrike', $this->second->get('rapidStrike') +1);
            $this->view->setBattle("rapid", $this->i, $this->second->get("name"));
            $this->switchPlayers();
            return true;
        }
        return true;
    }

    /**
     * Method to check if a player can have magic shield
     *
     * @return boolean
     */
    public function checkMagicShield($percent)
    {

        if ($this->second->get("name") != "Orderus") {
            return false;
        }

        //$magic          = $this->second->get('magic');
        $magicShield    = $this->second->get('magicShield');
        $taken          = $this->second->get('taken');

        $percentCurrent = (($magicShield + 1) / $taken) * 100;
        if ((int)$percentCurrent < $percent) {
            $this->second->set('magicShield', $this->second->get('magicShield') +1);
            $this->view->setBattle("magic", $this->i, $this->second->get("name"));
            $this->damage = ceil($this->damage/ 2);
        }
        return true;
    }
}