<?php

namespace War;
use War\War;
use View as ViewNs;

/**
 * Battle
 *
 * @author    Silviu Bobicescu <silviu_bobicescu@yahoo.com>
 */
class Battle implements War
{
    /**
     * Player object
     * @var object
     */
    protected $first = NULL;

    /**
     * Player object
     * @var object
     */
    protected $second = NULL;

    /**
     * View object
     * @var object
     */
    protected $view = NULL;

    /**
     * Skills values
     * @var array
     */
    protected $skills = [];

    /**
     * Damage values
     * @var integer
     */
    protected $damage = 0;

    /**
     * Iterator values
     * @var integer
     */
    protected $i = 0;


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
    public function __construct(\Libraries\Fighter $orderusPlayer , \Libraries\Fighter $beastPlayer, array $skills)
    {

        $this->setView();

        $this->setFirst($orderusPlayer,$beastPlayer);

        $this->skills = $skills;
    }

    /**
     * Method to generate view object
     *
     * @return boolean
     */
    protected function setView()
    {
        if (!isset($this->view))
        {
            $this->view = new ViewNs\View();
        }

        return true;
    }

    /**
     * Method to set first player to strike
     *
     * @param object $orderusPlayer
     * @param object $beastPlayer
     * @return boolean
     */
    protected function setFirst($orderusPlayer,$beastPlayer)
    {
        $first  = $orderusPlayer;
        $second = $beastPlayer;

        $orderusPlayerSpeed = $orderusPlayer->get('speed');
        $beastPlayerSpeed = $beastPlayer->get('speed');

        if ($orderusPlayerSpeed == $beastPlayerSpeed) {
            $orderusPlayerLuck = $orderusPlayer->get('luck');
            $beastPlayerLuck = $beastPlayer->get('luck');

            $first  = $orderusPlayerLuck > $beastPlayerLuck ? $orderusPlayer : $beastPlayer;
            $second = $orderusPlayerLuck < $beastPlayerLuck ? $orderusPlayer : $beastPlayer;

        }else{
            $first  = $orderusPlayerSpeed > $beastPlayerSpeed ? $orderusPlayer : $beastPlayer;
            $second = $orderusPlayerSpeed < $beastPlayerSpeed ? $orderusPlayer : $beastPlayer;
        }

        $this->first = $first;
        $this->second = $second;

        $this->view->setInitial(0, $first->__toString());
        $this->view->setInitial(1, $second->__toString());

        return true;
    }

    /**
     * Method to start the battle
     *
     * @return void
     */
    public function start()
    {
        if (!empty($this->first) && !empty($this->second)) {
            $this->i = 0;
            do{
                $this->saveStrikes();

                $this->setDamage();
                $this->applyDamage();

                $this->setBattleDetails();

                $defenderHealth = $this->second->get("health");
                if ($defenderHealth <= 0) {
                    $this->view->set("winner", $this->first->get("name"));
                    break;
                }

                $this->switchPlayers();
                $this->checkHook("afterSwitchPlayers");

                $this->i++;

            }while($defenderHealth > 0 || $this->i <= 20);
        }
        $this->view->display();
    }

    /**
     * Method to set each strike details
     * to view object
     *
     * @return boolean
     */
    protected function setBattleDetails(){
        $this->view->setBattle("loveste", $this->i, $this->first->get("name"));
        $this->view->setBattle("primeste", $this->i, $this->second->get("name"));
        $this->view->setBattle("damage", $this->i, $this->damage);

        $this->view->setBattle("first", $this->i, $this->first->__toString());
        $this->view->setBattle("second", $this->i, $this->second->__toString());

        return true;
    }

    /**
     * Method to generate strike damage value
     *
     * @return boolean
     */
    protected function setDamage()
    {
        $this->damage = $this->first->get("strength") - $this->second->get("defense");
        $this->checkHook("afterSetDamage");

        return true;
    }

    /**
     * Method to apply damage value to player object
     *
     * @return boolean
     */
    public function applyDamage()
    {
        $lucky = $this->checkHook("beforeApplyDamage");
        if ($lucky === false) {
            $this->second->set("health", $this->second->get("health") - $this->damage);
        }

        return true;
    }

    /**
     * Method to increase strike number to players object
     *
     * @return boolean
     */
    public function saveStrikes()
    {
        $this->first->set("strike", $this->first->get("strike")+1);
        $this->second->set("taken", $this->second->get("taken")+1);

        return true;
    }

    /**
     * Method to switch turn to strike
     *
     * @return boolean
     */
    public function switchPlayers()
    {
        $first  = $this->first;
        $second = $this->second;

        $this->first = $second;
        $this->second = $first;

        return true;
    }

    /**
     * Method to check hook functions defined in configuration file
     * runs hook functions if found
     *
     * @return boolean
     */
    public function checkHook($action)
    {
        if (!isset($this->skills[$action])) {
            return false;
        }

        foreach($this->skills[$action] as $config){
            if (is_callable([$this,$config['func']])) {
                return call_user_func([$this,$config['func']], $config['argument']);
            }
        }
        return false;
    }
}
