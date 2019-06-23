<?php
/**
 * Created by PhpStorm.
 * User: VisioN
 * Date: 25.09.2015
 * Time: 14:46
 */

namespace app\assets\messages;

use yii\web\JqueryAsset;

/**
 * Class SortElementsAsset
 * @package app\assets\messages
 */
class SortElementsAsset extends BaseMessageAssets {
    public $js = [
        'js/sortElements.js'
    ];


    public $depends = [
        JqueryAsset::class
    ];
}