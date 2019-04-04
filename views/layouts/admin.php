<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
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
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
        NavBar::begin([
            'brandLabel' => 'Головна',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Собаки', 'url' => ['/admin/dog/index']],
                ['label' => 'Пост', 'url' => ['/admin/article/index']],
                ['label' => 'Виставка', 'url' => ['/admin/show/index']],
                ['label' => 'Коментарі', 'url' => ['/admin/comment/index']],
                ['label' => 'Категорія', 'url' => ['/admin/category/index']],
                ['label' => 'Теги', 'url' => ['/admin/tag/index']]
            ],
        ]);
        NavBar::end();
    ?>

    <div class="main-content">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <div>

                    <?= $content ?>
                </div>
            </div>
        </div>

    </div>
</div>


<?php $this->endBody() ?>
</body>
<?php $this->endPage() ?>
<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Головна <?= date('Y') ?></p>
    </div>
</footer>

</html>
