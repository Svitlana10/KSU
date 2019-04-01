<?php
/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
$this->title = $name;

use yii\helpers\Url; ?>
<main id="main" class="site-main" role="main">

    <section class="error-404 not-found text-center">
        <h1 class="404"><?= $exception->statusCode ?></h1>

        <p class="lead"><?= $exception->getMessage() ?></p>

        <a href="<?= Url::toRoute('site/index') ?>" class="btn btn-info btn-lg not-found__button">
            Повернутись на головну
        </a>


    </section><!-- .error-404 -->

</main><!-- #main -->
