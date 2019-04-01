<?php

namespace app\widgets;

use app\models\Article;
use app\models\Category;
use yii\base\Widget;

/**
 * Created by PhpStorm.
 * User: comrade
 * Date: 07.03.19
 * Time: 9:12
 */

class Sidebar extends Widget
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

        return $this->render('sidebar', [
            'popular'       => Article::getPopular(),
            'recent'        => Article::getRecent(),
            'categories'    => Category::getAll()
        ]);
    }
}