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

<section class="blog_area p_120">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog_left_sidebar">
                    <article class="blog_style1">
                        <div class="blog_img">

                            <img class="img-fluid" href="<?= Url::toRoute(['site/view', 'id'=>$model->id]);?>" src="<?= $model->getImage();?>" alt="">
                        </div>
                        <div class="blog_text"<?= Url::toRoute(['site/view', 'id'=>$model->id]);?>>
                            <div class="blog_text_inner">
                                <div class="cat">
                                    <a class="cat_btn" href="<?= Url::toRoute(['site/category','id'=>$model->category->id])?>"> <?= $model->category->title; ?></a>
                                    <a href="#"><i class="fa fa-calendar" aria-hidden="true"></i> <?= $model->author->username; ?> On <?= $model->date ?></a>
                                    <a href="#"><i class="fa fa-comments-o" aria-hidden="true"></i> <?= (int) $model->viewed?></a>
                                </div>
                                <a href="<?= Url::toRoute(['site/view', 'id'=>$model->id]);?>"><h4><?= $model->title?></h4></a>
                                <p><?= $model->description?></p>
                                <a class="blog_btn" href="<?= Url::toRoute(['site/view', 'id'=>$model->id]);?>" >Переглянути</a>
                            </div>
                        </div>
                    </article>

            </div>
        </div>
    </div>
    </div>
</section>

