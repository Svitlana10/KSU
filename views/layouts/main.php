<?php

/* @var $this View */
/* @var $content string */

use app\assets\PublicAsset;
use app\models\Show;
use app\widgets\Footer;
use app\widgets\Navbar;
use app\widgets\Sidebar;
use yii\helpers\Html;
use yii\web\View;
use yii\helpers\Url;

$show = Show::getOneRegShow();

PublicAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<link rel="icon" href="img/favicon.png" type="image/png">
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

<?= Navbar::widget() ?>

<section class="home_banner_area">
    <div class="container">
            <div class="col-lg-5"></div>
            <div class="col-lg-7">
                <div class="blog_text_slider owl-carousel">
                    <div class="blog_text">
                            <h2 class="widget-title text-uppercase text-center">Реєстрація на виставку</h2>
                            <div class="text-center">
                                <?php
                                if($show = Show::getOneRegShow()) : ?>
                                    <h3>Виставка: <?= $show->showDate ?></h3>
                                    <a href="<?= Url::toRoute(['site/register-dog', 'show' => $show->id]) ?>" class="button" style="width: 90%">Зареєструватись</a>
                                    <a href="<?= Url::toRoute(['site/view-dog', 'id' => $show->id]) ?>" class="button" style="width: 90%; margin-top: 2px">Переглянути зареєстрованих собак</a>
                                <?php else: ?>
                                    <h4>Немає найблищих виставок</h4>
                                <?php endif; ?>

                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">

            <div class="col-md-8">
                <?= $content ?>
            </div>
            <div class="col-md-4" data-sticky_column>
                <div class="primary-sidebar">
                    <?= Sidebar::widget() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endBody() ?>.
<?php $this->endPage() ?>
</body>

<?= Footer::widget() ?>



</html>
