<?php
/**
 * Created by PhpStorm.
 * User: VisioN
 * Date: 22.05.2015
 * Time: 14:05
 */

namespace app\assets\messages;

use yii\web\JqueryAsset;

/**
 * Class MessageAssets
 * @package app\assets\messages
 */
class MessageAssets extends BaseMessageAssets {

    public $js = [
        'js/vision_messages.js',
    ];

    public $depends = [
        PrivateMessPoolingAsset::class,
        JqueryAsset::class
    ];

} 