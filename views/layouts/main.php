<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\PublicAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\User;

PublicAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body id="backgr">
<?php $this->beginBody() ?>
    <div class="wrap">


    </div>

    <nav class="navbar main-menu navbar-default">
        <div class="container">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
            <div class="w3-sidebar w3-bar-block w3-card w3-animate-right" style="display:none;right:0;" id="rightMenu">

            </div>

            <div class="w3-teal">

                <button class="w3-button w3-teal w3-xlarge w3-right"  onclick="myFunction()">&#9776;

                </button>

            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
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
                }

                function closeNav() {
                    document.getElementById("mySidenav").style.width = "0";
                }

                function myFunction() {
                    var x = document.getElementById("mySidenav");
                    if (document.getElementById("mySidenav").style.width === "250px") {
                        // x.style.display = "none";
                        document.getElementById("mySidenav").style.width = "0";
                    } else {
                        document.getElementById("mySidenav").style.width = "250px";
                        // x.style.display = "block";
                    }
                }
            </script>
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
                                    <a href="<?= Url::toRoute(['/admin/default/index'])?>" >Адміністрування</a>
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


<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?= $content ?>
            </div>
            <div class="col-md-4" data-sticky_column>
                <div class="primary-sidebar">
                    <?= \app\widgets\Sidebar::widget() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endBody() ?>.
<?php $this->endPage() ?>
</body>

<?= \app\widgets\Footer::widget() ?>



</html>


