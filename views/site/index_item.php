<?php
/**
 * Created by PhpStorm.
 * User: Svitlana
 * Date: 02.04.2019
 * Time: 0:17
 */
/** @var $model \app\models\Article */
use yii\helpers\Url;
?>
<article class="post" >
    <div class="post-thumb">
        <a href="<?= Url::toRoute(['site/view', 'id'=>$model->id]);?>"><img src="<?= $model->getImage();?>" alt=""></a>

        <a href="<?= Url::toRoute(['site/view', 'id'=>$model->id]);?>" class="post-thumb-overlay text-center">
            <div class="text-uppercase text-center">View Post</div>
        </a>
    </div>
    <div class="post-content">
        <header class="entry-header text-center text-uppercase">
            <h6><a href="<?= Url::toRoute(['site/category','id'=>$model->category->id])?>"> <?= $model->category->title; ?></a></h6>
            <h1 class="entry-title"><a href="<?= Url::toRoute(['site/view', 'id'=>$model->id]);?>"><?= $model->title?></a></h1>
        </header>
        <div class="entry-content">
            <p><?= $model->description?>
            </p>

            <div class="btn-continue-reading text-center text-uppercase">
                <a href="<?= Url::toRoute(['site/view', 'id'=>$model->id]);?>" class="more-link">Continue Reading</a>
            </div>
        </div>
        <div class="social-share">
            <span class="social-share-title pull-left text-capitalize">By <?= $model->author->username; ?> On <?= $model->date ?></span>
            <ul class="text-center pull-right">
                <li><a class="s-facebook" href="#"><i class="fa fa-eye"></i></a></li><?= (int) $model->viewed?>
            </ul>
        </div>
    </div>
</article>
