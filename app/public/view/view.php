<?php

namespace View;


/**
 * View
 *
 * @author    Silviu Bobicescu <silviu_bobicescu@yahoo.com>
 */
class View
{
    /**
     * Path to template file
     * @var string
     */
    protected $template = "";

    /**
     * Players stats
     * @var array
     */
    protected $initialValue = array();

    /**
     * Battle details
     * @var array
     */
    protected $battle = array();

    /**
     * Battle details to display
     * @var string
     */
    protected $battleDetails = "";

    /**
     * Errors
     * @var array
     */
    protected $error = array();

    /**
     * Messages
     * @var string
     */
    protected $message = NULL;

    /**
     * Layout file name
     * @var string
     */
    protected $layout = NULL;

    /**
     * Battle file name
     * @var string
     */
    protected $battleLayout = NULL;

    /**
     * Winner player name
     * @var string
     */
    protected $winner = "";


    /**
     * Class constructor
     *
     * Set template files
     *
     * @param array $propertiy
     * @return void
     */
    public function __construct($property = array())
    {
        $template = isset($property['template']) && !empty($property['template']) ? $property['template'] : "default";
        $this->set("template", $template);

        $layout = isset($property['layout']) && !empty($property['layout']) ? $property['layout'] : "index";
        $this->set("layout", $layout);

        $battleLayout = isset($property['battleLayout']) && !empty($property['battleLayout']) ? $property['battleLayout'] : "battle";
        $this->set("battleLayout", $battleLayout);
    }

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
    public function set($property, $value = null)
    {
        $this->$property = $value;

        return $this->$property;
    }

    /**
     * Method to set initial players stats
     *
     * @param string $value
     * @param integer $row
     * @return string
     */
    public function setInitial($row, $value = null)
    {
        if ($value == null) {
            return false;
        }

        $this->initialValue[$row] = $value;
        return $this->initialValue[$row];
    }

    /**
     * Method to set battle details
     *
     * @param string $value
     * @param integer $row
     * @param integer $rowFirst
     * @return string
     */
    public function setBattle($row, $rowFirst, $value = null)
    {
        if ($value == null) {
            return false;
        }

        $this->battle[$rowFirst][$row] = $value;

        return $this->battle[$rowFirst];
    }

    /**
     * Method to get Errors
     *
     * @return string
     */
    public function getErrorMsg()
    {
        return implode("/r/n",$this->error);
    }

    /**
     * Generate main layout and display it
     *
     * @return boolean
     */
    public function display()
    {
        $mainLayout = $this->template . "/" . $this->layout . ".php";
        $output     = "";

        if (!file_exists("view/" . $mainLayout)) {
            echo "Invalid layout";
            exit;
        }

        $this->generateBattle();

        ob_start();
        include $mainLayout;
        $output = ob_get_contents();
        ob_end_clean();

        echo $output;
        return true;
    }

    /**
     * Generate battle layout and add it to main layout
     *
     * @return void
     */
    protected function generateBattle(){

        $battleLayout = $this->template . "/" . $this->battleLayout . ".php";

        if (!file_exists("view/" . $battleLayout) || empty($this->battle)) {
            $this->battleDetails = "";
            return true;
        }

        foreach($this->battle as $value){
            ob_start();
            include $battleLayout;
            $output = ob_get_contents();
            ob_end_clean();

            $this->battleDetails .= $output;
        }
    }
}