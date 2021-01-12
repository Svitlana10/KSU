<?php

use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $content string */
?>

<header class="main-header">
    <?= Html::a(
            '<span class="logo-mini">S</span><span class="logo-lg">' .
            Yii::$app->params['appName'] .
            '</span>', Yii::$app->homeUrl, ['class' => 'logo'])
    ?>
    <nav class="navbar navbar-static-top" role="navigation">
        <div href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </div>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                        <span class="hidden-xs">Admin</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <p>
                                Admin
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
