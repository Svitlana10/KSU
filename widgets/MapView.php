<?php


namespace app\widgets;


use yii\base\Widget;

/**
 * Class MapView
 * @package app\widgets
 */
class MapView extends Widget
{

    public $model;

    /**
     * @return string
     */
    public function run()
    {
        if($this->model && $this->model->google_location) {
            return $this->render('map', ['model' => $this->model]);
        }

        return '';
    }


}