<?php

namespace Libraries;

/**
 * Player
 *
 * @author    Silviu Bobicescu <silviu_bobicescu@yahoo.com>
 */
abstract class Fighter
{
    /**
     * Player health value
     * @var integer
     */
    protected $health = 0;

    /**
     * Player health strength
     * @var integer
     */
    protected $strength = 0;

    /**
     * Player defense value
     * @var integer
     */
    protected $defense = 0;

    /**
     * Player speed value
     * @var integer
     */
    protected $speed = 0;

    /**
     * Player luck value
     * @var integer
     */
    protected $luck = 0;

    /**
     * Player name value
     * @var string
     */
    protected $name = "";

    /**
     * Player strike value
     * @var integer
     */
    protected $strike = 0;

    /**
     * Player taken value
     * @var integer
     */
    protected $taken = 0;

    /**
     * Player lucky value
     * @var integer
     */
    protected $getLucky = 0;

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
        if ($properties !== null)
        {
            $this->setProperties($properties);
        }
        $this->setName();
    }

    /**
     * Method to set custom properties
     *
     * @param array $properties - player stats
     * @return boolean
     */
    public function setProperties($properties)
    {
        if (is_array($properties))
        {
            foreach ((array) $properties as $k => $v)
            {
                $this->set($k, rand($v["min"],$v["max"]));
            }

            return true;
        }

        return false;
    }

    /**
     * Method to set player name
     *
     * @param array $properties - player stats
     * @return boolean
     */
    abstract public function setName();

    /**
     * Method to get class property
     *
     * @param mixed $properties
     * @return mixed
     */
    public function get($property)
    {
        return $this->$property;
    }

    /**
     * Method to set class property
     *
     * @param mixed $properties
     * @return mixed
     */
    public function set($property, $value = array())
    {
        $this->$property = $value;

        return $this->$property;
    }

    /**
     * Method to get class property
     *
     * @return string - String representation of the current element
     */
    public function __toString()
    {
        $string = "<br/>Player: " . $this->name.
                "<br/>Health: " . $this->health.
                "<br/>Strength: " . $this->strength.
                "<br/>Defense: " . $this->defense.
                "<br/>Speed: " . $this->speed.
                "<br/>Luck: " . $this->luck.
                "<br/>Strike: " . $this->strike.
                "<br/>Taken: " . $this->taken.
                "<br/>Get Lucky: " . $this->getLucky.
                "<br/><br/>";

        return $string;
    }
}

