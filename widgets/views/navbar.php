<?php



/* @var $this View */

use app\models\Show;
use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

?>
<nav class="navbar main-menu navbar-default">

    <?php // region left Sidebar ?>

<!--    <button id="openNav" class="w3-button w3-teal w3-xlarge w3-left" onclick="openNav()">&#9776;-->
<!--    </button>-->
    <div class="container">
        <div class="w3-teal">
            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" id="mySidebar" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="#">Головна</a>
                <a href="#">Виставки </a>
                <a href="#">Племенні документи</a>
                <a href="#">Експерти і інструктори</a>
                <a href="#">Чемпіони </a>
                <a href="#">Розплідники </a>
                <a href="#">Цуценята </a>
                <a href="#">Родоводи, чемпіонські сертифікати </a>
                <a href="#">Результати виставок </a>
            </div>

            <script>
                function openNav() {
                    document.getElementById("mySidenav").style.width = "250px";
                    document.getElementById("mySidebar").style.display = "block";
                    document.getElementById("openNav").style.display = 'none';
                    document.getElementById("mySidebar").style.width = "25%";
                }
                function closeNav() {
                    document.getElementById("mySidenav").style.width = "0";
                    document.getElementById("mySidebar").style.display = "none";
                    document.getElementById("openNav").style.display = "inline-block";
                }
            </script>
        </div>
        <?php //endregion   ?>

        <div class="menu-content">

            <!-- Brand and toggle get grouped for better mobile display -->

            <div class="navbar-header" style="width:20%">
                <li class="navbar-brand">

                    <a  href="/" style="width:40%; margin-left: 40%"><img src="/public/images/logo_2.png"  alt=""></a>
                </li>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">

                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>

                </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav text-uppercase">
                    <?php if(!Yii::$app->user->isGuest):
                        $user_status = Yii::$app->user->identity->status;
                        if($user_status == User::USER_STATUS_ADMIN || $user_status == User::USER_STATUS_MODERATOR) :?>
                            <li>
                                <a href="<?= Url::toRoute(['/admin'])?>" >Адміністрування</a>
                            </li>
                        <?php endif;
                    endif;?>
                </ul>
                <div class="i_con">
                    <ul class="nav navbar-nav navbar-right text-uppercase">

                        <?php if(Yii::$app->user->isGuest):?>
                            <li><a href="<?= Url::toRoute(['auth/login'])?>">Авторизуватися</a></li>
                            <li><a href="<?= Url::toRoute(['auth/signup'])?>">Зареєструватися</a></li>
                        <?php else: ?>
                            <?=  Html::beginForm(['/auth/logout'], 'post')
                            . Html::submitButton(
                                'Вийти (' . Yii::$app->user->identity->username . ')',
                                ['class' => 'btn btn-link logout', 'style'=>"padding-top:20px; margin-left: 10%; color:#ffffff;"]
                            )
                            . Html::endForm() ?>

                        <?php endif;?>
                    </ul>
                </div>
            </div>
            <!-- /.navbar-collapse -->
        </div>
    </div>
    <!-- /.container-fluid -->

</nav>
<div class="logo_part">
    <div class="container">
        <a class="logo" href="#"><img src="img/logo.png" alt=""></a>
    </div>
</div>

<section class="home_banner_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-5"></div>
            <div class="col-lg-7">
                <div class="blog_text_slider owl-carousel">
                        <div class="blog_text">
                            <div class="cat">
                                <aside class="widget">
                                    <h2 class="text-center" >Реєстрація на виставку</h2>
                                    <div class="text-center">
                                        <?php
                                        /** @var Show $show */
                                        if($show = Show::getOneRegShow()) : ?>
                                            <h3>Виставка: <?= $show->showDate ?></h3>
                                            <a href="<?= Url::toRoute(['site/register-dog', 'show' => $show->id]) ?>" class="btn-success" style="width: 50%; margin-left: 15px">Зареєструватись</a>
                                            <a href="<?= Url::toRoute(['site/view-dog', 'id' => $show->id]) ?>" class="btn-success" style="width: 50%; margin-top: 5px">Переглянути собак</a>
                                        <?php else: ?>
                                            <h4>Немає найблищих виставок</h4>
                                        <?php endif; ?>

                                    </div>
                                </aside>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>