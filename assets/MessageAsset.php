<?php
/**
 * Created by PhpStorm.
 * User: VisioN
 * Date: 26.08.2015
 * Time: 12:53
 */

namespace app\assets;


use app\assets\messages\BaseMessageAssets;
use app\assets\messages\PrivateMessPoolingAsset;
use app\assets\messages\SortElementsAsset;
use app\assets\messages\TinyscrollbarAsset;

/**
 * Class MessageAsset
 * @package app\assets
 */
class MessageAsset extends BaseMessageAssets {

    public $js = [
        'js/private_mess_cload.js'
    ];

    public $css = [
        'css/cload_message.css',
    ];

    public $depends = [
        PrivateMessPoolingAsset::class,
        TinyscrollbarAsset::class,
        SortElementsAsset::class
    ];

}