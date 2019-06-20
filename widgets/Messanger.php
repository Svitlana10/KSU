<?php


namespace app\widgets;


use yii\base\Widget;

/**
 * Class Messanger
 * @package app\widgets
 */
class Messanger extends Widget
{
    public function run()
    {
        return $this->render('messanger');
    }
}