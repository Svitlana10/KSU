<?php

use app\models\User;
use app\modules\admin\Module as AdminModule;
use vision\messages\components\MyMessages;

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => getenv('COOKIE_VALIDATION_KEY'),
            'enableCookieValidation' => false,
            'baseUrl' => ''
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl'=>['auth/login']
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'db' => require(__DIR__ . '/db.php'),
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
            ],
        ],
        'mymessages' => [
            //Обязательно
            'class'    => MyMessages::class,
            'nameController' => 'site',
            'admins' => [1],
            'getEmail' => function(User $user_model) {
                return $user_model->email;
            },
            'getLogo' => function($user_id) {
                return '\img\ghgsd.jpg';
            },
            'enableEmail' => false,
//            'templateEmail' => [
//                'html' => 'private-message-text',
//                'text' => 'private-message-html'
//            ],
            //тема письма
            'subject' => 'Private message'
        ],
    ],
    'modules' => [
        'admin' => [
            'class' => AdminModule::class,
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
//    $config['bootstrap'][] = 'debug';
//    $config['modules']['debug'] = [
//        'class' => 'yii\debug\Module',
//    ];
//
//    $config['bootstrap'][] = 'gii';
//    $config['modules']['gii'] = [
//        'class' => 'yii\gii\Module',
//    ];
}

return $config;
