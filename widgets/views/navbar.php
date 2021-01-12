<?php



/* @var $this View */

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

?>
<header class="header_area">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container box_1620">
                <!-- Brand and toggle get grouped for better mobile display -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav">
                        <li class="nav-item active"><a class="nav-link" href="/">Головна</a></li>
<!--                        <li class="nav-item"><a class="nav-link" href="">Category</a></li>-->
<!--                        <li class="nav-item"><a class="nav-link" href="">Archive</a></li>-->
<!--                        <li class="nav-item submenu dropdown">-->
<!--                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages</a>-->
<!--                            <ul class="dropdown-menu">-->
<!--                                <li class="nav-item"><a class="nav-link" href=" ">Sinlge Blog</a></li>-->
<!--                                <li class="nav-item"><a class="nav-link" href=" ">Elements</a></li>-->
<!--                            </ul>-->
<!--                        </li>-->
                        <?php if(!Yii::$app->user->isGuest):
                            $user_status = Yii::$app->user->identity->status;
                            if($user_status == User::USER_STATUS_ADMIN || $user_status == User::USER_STATUS_MODERATOR) :?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= Url::toRoute(['/admin'])?>" >Адміністрування</a>
                            </li>
                            <?php endif; ?>
<!--                            <li class="nav-item">-->
<!--                                <a class="nav-link" href="--><?//= Url::toRoute(['/site/messenger'])?><!--" >Мессенджер</a>-->
<!--                            </li>-->
                        <?php endif;?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right header_social ml-auto">
                        <?php if(Yii::$app->user->isGuest):?>
<!--                            <li><a href="--><?//= Url::toRoute(['/auth/login'])?><!--">Авторизуватися</a></li>-->
<!--                            <li><a href="--><?//= Url::toRoute(['/auth/signup'])?><!--">Зареєструватися</a></li>-->
                        <?php else: ?>
                            <li>
                                <?=  Html::beginForm(['/auth/logout'], 'post')
                                . Html::submitButton(
                                    'Вийти',
                                    ['class' => 'btn btn-link logout', 'style' => 'color: #009789']
                                )
                                . Html::endForm() ?>

                            </li>
                        <?php endif;?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>

    <?php // region left Sidebar ?>


