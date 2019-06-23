<?php
/**
 * Created by PhpStorm.
 * User: VisioN
 * Date: 26.08.2015
 * Time: 13:25
 */

namespace app\assets\messages;


use yii\web\JqueryAsset;

/**
 * Class TinyscrollbarAsset
 * @package app\assets\messages
 */
class TinyscrollbarAsset extends BaseMessageAssets
{
    public $js = [
        'js/jquery.tinyscrollbar.min.js'
    ];
    public $depends = [
        JqueryAsset::class
    ];

}