<?php

/* @var $this View */
/* @var $content string */

use app\assets\PublicAsset;
use app\widgets\Footer;
use app\widgets\Navbar;
use app\widgets\Sidebar;
use yii\helpers\Html;
use yii\web\View;

PublicAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<link rel="icon" href="img/favicon.png" type="image/png">
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body id="backgr">
<?php $this->beginBody() ?>
<div class="wrap">


</div>

<?= Navbar::widget() ?>

<section class="home_banner_area">ner
    <div class="container">
        <div class="row">
            <div class="col-lg-5"></div>
            <div class="col-lg-7">
                <div class="blog_text_slider owl-carousel">
                    <div class="item">
                        <div class="blog_text">
                            <div class="cat">
                                <a class="cat_btn" href="#">Gadgets</a>
                                <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> March 14, 2018</a>
                                <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> 05</a>
                            </div>
                            <a href="#"><h4>Nest Protect: 2nd Gen Smoke + CO Alarm</h4></a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                            <a class="blog_btn" href="#">Read More</a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="blog_text">
                            <div class="cat">
                                <a class="cat_btn" href="#">Gadgets</a>
                                <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> March 14, 2018</a>
                                <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> 05</a>
                            </div>
                            <a href="#"><h4>Nest Protect: 2nd Gen Smoke + CO Alarm</h4></a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                            <a class="blog_btn" href="#">Read More</a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="blog_text">
                            <div class="cat">
                                <a class="cat_btn" href="#">Gadgets</a>
                                <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> March 14, 2018</a>
                                <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> 05</a>
                            </div>
                            <a href="#"><h4>Nest Protect: 2nd Gen Smoke + CO Alarm</h4></a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
                            <a class="blog_btn" href="#">Read More</a>
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
