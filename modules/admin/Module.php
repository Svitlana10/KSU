<?php

namespace app\modules\admin;

use Yii;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $layout = '/admin';

    /**
     * @var string
     */
    public $controllerNamespace = 'app\modules\admin\controllers';
    public $defaultRoute = 'dog';

    /**
     * @inheritdoc
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'denyCallback' => function ($rule, $action) {
                    throw new ForbiddenHttpException('Need to be login in..');
                },
                'rules' => [
                    [
                        'roles' => ['@'],
                        'allow' => true,
                        'matchCallback' => function ($rule, $action) {
                            return (Yii::$app->user->identity->isAdmin || Yii::$app->user->identity->isModer) ? true : false;
                        }
                    ]
                ]
            ]
        ];
    }
}
