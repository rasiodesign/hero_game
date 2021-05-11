<?php

namespace Libraries;

use Libraries;

/**
 * Player
 *
 * @author    Silviu Bobicescu <silviu_bobicescu@yahoo.com>
 */
class Player extends Fighter
{

    /**
     * Class constructor
     *
     * Generate player object and assign configuration values
     *
     * @param array $properties - player stats
     * @return void
     */
    public function __construct($properties = null)
    {
        parent::__construct($properties);
    }

    /**
     * Method to set player name
     *
     * @return void
     */
    public function setName()
    {
        $this->set("name", "Beast");
    }
}