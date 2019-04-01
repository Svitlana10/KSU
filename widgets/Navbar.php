<?php


namespace app\widgets;


use yii\base\Widget;

/**
 * Class Navbar
 * @package app\widgets
 */
class Navbar extends Widget
{
    public function init()
    {
        parent::init();
        ob_start();
    }

    /**
     * @return string
     */
    public function run()
    {
        ob_get_clean();

        return $this->render('navbar', []);
    }

}