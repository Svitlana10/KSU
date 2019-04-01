<?php
namespace app\widgets;

use yii\base\Widget;

/**
 * Created by PhpStorm.
 * User: comrade
 * Date: 07.03.19
 * Time: 9:26
 */

class Footer extends Widget
{
    public function init()
    {
        parent::init();
        ob_start();
    }

    public function run()
    {
        ob_get_clean();

        return $this->render('footer', []);
    }
}