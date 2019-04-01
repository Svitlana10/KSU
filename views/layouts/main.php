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

<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <img class="center-block" src="/public/images/logo_1.png" style="width: 100%; margin-bottom: 10px;" alt="">
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


