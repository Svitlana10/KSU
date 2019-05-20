<?php

/* @var $this View */
/* @var $content string */

use app\assets\PublicAsset;
use app\widgets\Footer;
use app\widgets\Navbar;
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
<body>
<?php $this->beginBody() ?>
<div class="wrap">


</div>

<?= Navbar::widget() ?>


<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?= $content ?>
            </div>
        </div>
    </div>
</div>
<?php $this->endBody() ?>.
<?php $this->endPage() ?>
</body>

<?= Footer::widget() ?>



</html>


