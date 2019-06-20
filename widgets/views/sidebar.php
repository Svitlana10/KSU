
<?php

use app\models\Article;
use app\models\Show;
use yii\helpers\Url;
$show = Show::getOneRegShow();
?>
<body>
<section class="blog_area p_100">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                 <div class="blog_right_sidebar">
                     <aside class="single_sidebar_widget search_widget">
                         <div class="input-group">

            </div><!-- /input-group -->

        </aside>
        <div class="single_sidebar_widget author_widget">
            <h3 class="widget_title">Увага</h3>
            З 01.01.2016 РОКУ В СИСТЕМІ КСУ
            ЗАБОРОНЕНО купировка вух і хвоста!
            НАКАЗ №2 від 17.02.2016г.
           <div class="br"></div>
        </aside>
        <aside class="single_sidebar_widget popular_post_widget">
            <h3 class="widget_title">Популярні пости</h3>
            <?php
            /** @var Article $popular */
            /** @var Article $article */
            foreach($popular as $article):?>
            <div class="media post_item">

                <img class="img_" src="<?= $article->getImage()?> " href="<?= Url::toRoute(['site/view','id'=>$article->id]);?>" alt="post">
                <div class="media-body">
                    <a href="<?= Url::toRoute(['site/view','id'=>$article->id]);?>"> <?= $article->title?> </a>
                    <p><?= date("Y-m-d H:i:s", $article->created_at)?></p>
                </div>
            </img>
                </div>
            <?php endforeach;?>
            <div class="br"></div>
        </aside>
        <aside class="single_sidebar_widget post_category_widget">

            <h4 class="widget_title">Категорії</h4>
            <?php
            /** @var \app\models\Category $category */
            foreach($categories as $category):?>
            <ul class="list cat-list">

                    <a href=" <?= Url::toRoute(['site/index','category_id'=>$category->id]);?>"><?= $category->title?>
                        <?= $category->articlesCount?>
                            <?php endforeach;?>

                    </a>

            </ul>
        </aside>
    </div>
</div>
</div>
</div>
</section>
</body>







