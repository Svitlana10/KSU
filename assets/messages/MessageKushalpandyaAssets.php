<?php
/**
 * Created by PhpStorm.
 * User: VisioN
 * Date: 04.06.2015
 * Time: 12:58
 */

namespace app\assets\messages;

/**
 * Class MessageKushalpandyaAssets
 * @package app\assets\messages
 */
class MessageKushalpandyaAssets extends BaseMessageAssets  {

    public $css = [
        'css/kushalpandya.css',
    ];

    public $depends = [
        MessageAssets::class
    ];

} 