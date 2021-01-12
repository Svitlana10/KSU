<?php
use yii\helpers\Url;
/** @var \app\models\Article $article */
$this->title = $article->title;
?>
<section class="blog_area p_120 single-post-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="main_blog_details">
                    <img class="img-fluid" src="<?= $article->getImage();?>" alt="">
                    <a  href="<?= Url::toRoute(['site/view','id'=>$article->id])?>"><h4> <?= $article->title?></h4></a>
                    <div class="user_details">
                        <div class="float-left">
                            <a <?= Url::toRoute(['site/category','id'=>$article->category->id])?>> <?= $article->category->title?></a>

                        </div>
                        <?= $article->description ?>
                        <div class="float-right">

                            <div class="media">
                                <div class="media-body">
                                    <h5><?= $article->author->username?></h5>
                                    <p>  <?= $article->getDate();?></p>
                                </div>
                                <div class="d-flex">
                                    <img src="img/blog/user-img.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>

 <?= $this->render('/partials/comment', [
     'article'=>$article,
     'comments'=>$comments,
     'commentForm'=>$commentForm
 ])?>
<!-- end main content-->