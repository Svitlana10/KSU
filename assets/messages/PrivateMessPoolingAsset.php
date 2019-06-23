<?php
/**
 * Created by PhpStorm.
 * User: VisioN
 * Date: 06.06.2015
 * Time: 17:19
 */

namespace app\assets\messages;


use vision\messages\components\MyMessages;
use yii\web\JqueryAsset;
use yii\web\View;

/**
 * Class PrivateMessPoolingAsset
 * @package app\assets\messages
 */
class PrivateMessPoolingAsset extends BaseMessageAssets {

    public $js = [
        'js/private_mess_pooling.js',
    ];

    public $depends = [
        JqueryAsset::class
    ];


    /**
     * Registers the CSS and JS files with the given view.
     * @param View $view the view that the asset files are to be registered with.
     */
    public function registerAssetFiles($view)
    {
        $nameController = MyMessages::getMessageComponent()->nameController;
        $base_script = "var baseUrlPrivateMessage ='{$nameController}';";
        $view->registerJs($base_script, $view::POS_BEGIN);

        return parent::registerAssetFiles($view);
    }
} 