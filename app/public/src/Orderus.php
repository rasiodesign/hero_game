<?php

namespace Libraries;

use Libraries;

/**
 * Orderus
 *
 * @author    Silviu Bobicescu <silviu_bobicescu@yahoo.com>
 */
class Orderus extends Fighter
{


    /**
     * Player rapid strike value
     * @var integer
     */
    protected $rapidStrike = 0;

    /**
     * Player magic shield value
     * @var integer
     */
    protected $magicShield = 0;

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
        $this->set("name", "Orderus");
    }
}